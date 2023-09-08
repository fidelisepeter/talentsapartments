<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lawyer;
use setasign\Fpdi\Fpdi;
// use setasign\Fpdi\Tfpdf\Fpdi;

use App\Models\BedSpace;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use function App\View\Components\send_mail;
use function PHPUnit\Framework\throwException;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = User::find(Auth::id());
        if ($currentUser->hasRole('Lawyer')) {

            $users = User::where('role', 'student')->get();
            $documents = $currentUser->lawyer->documents();
           
            return view('pages.document.users')->with([
                'documents' => $documents,
                'users' => $users,
            ]);
        } else {
            $lawyers = Lawyer::all();
            $documents = Documents::all();
            return view('pages.document.index')->with([
                'documents' => $documents,
                'lawyers' => $lawyers,
            ]);
        }
    }

    public function user_list()
    {

        $currentUser = User::find(Auth::id());
        if ($currentUser->hasRole('Lawyer')) {

            $residents = BedSpace::whereNotNull('user_id')->get();

            $users = User::where('role', 'student')->get();
            $documents = $currentUser->lawyer->documents();
            
            return view('pages.document.users')->with([
                'documents' => $documents,
                'residents' => $residents,
            ]);
        } else {
            $lawyers = Lawyer::all();
            $documents = Documents::all();
            return view('pages.document.index')->with([
                'documents' => $documents,
                'lawyers' => $lawyers,
            ]);
        }
    } 

    public function agreement_forms()
    {

        $currentUser = User::find(Auth::id());
        if ($currentUser->hasRole('Lawyer')) {
            $residents = BedSpace::whereNotNull('user_id')->get();

            $users = User::where('role', 'student')->get();
            $documents = $currentUser->lawyer->agreement_forms();
            
            return view('pages.document.users-agreement-forms')->with([
                'documents' => $documents,
                'residents' => $residents,
            ]);
        } 
    }

    public function assigned_documents()
    {
        // dd('dfghjk');
        $currentUser = User::find(Auth::id());
        $documents = $currentUser->lawyer->documents();
        
        return view('pages.document.assigned')->with([
            'documents' => $documents,
            // 'yusers' => $users,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new Document.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $supervisors = User::where('role', '!=', 'student')->get();
        // $roles = Role::all();
        // $departments = Department::all();
        $lawyers = Lawyer::all();
        return view('pages.document.create')->with([
            'lawyers' => $lawyers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        if ($request->file) {

            request()->validate([
                'file' => 'required|file|mimes:pdf',
            ]);

            $file_title = str_replace(' ', '-', $request->title . '-' . $request->type) . '.pdf';
            $request->file->storeAs('documents', $file_title, 'public_uploads');
        }

        $document_path = 'documents/' . $file_title;



        $document = Documents::create([
            'title' => $request->title,
            'type' => $request->type,
            'has_signature' => $request->has_signature == 'on' ? true : false,
            'signature_config' => $request->signature_config,
            'has_stamp' => $request->has_stamp == 'on' ? true : false,
            'stamp_config' => $request->stamp_config,
            'has_user_name' => $request->has_user_name == 'on' ? true : false,
            'user_name_config' => $request->user_name_config,
            'has_lawyer_name' => $request->has_lawyer_name == 'on' ? true : false,
            'lawyer_name_config' => $request->lawyer_name_config,
            'show_signed_date' => $request->show_signed_date == 'on' ? true : false,
            'signed_date_config' => $request->signed_date_config,
            'lawyers_assigned' => json_encode($request->lawyers_assigned),
            'description' => $request->description,
            'attachments' => $request->attachments,
            'document_path' => $document_path,
            'year' => DB::table('settings')->value('current_year'),
        ]);

        if($request->lawyers_assigned){

            $lawyers_assigned = $request->lawyers_assigned ?? [];
            foreach ($lawyers_assigned as $lawyer_id) {
                $lawyer = Lawyer::where('id', $lawyer_id)->first();
    
    
                // print($lawyer->new_document_email_notification);
                if ($lawyer->new_document_email_notification == true) {
                    # code...
                    // dd($lawyer->name());
                    $input = ['[first_name]', '[last_name]', '[document_title]', '[document_type]', '[document_url]'];
                    $outfilled = [$lawyer->get->first_name, $lawyer->get->last_name, $request->title, $request->type, url($document_path)];
                    $message =  str_replace($input, $outfilled,  DB::table('settings')->value('lawyer_new_document_email'));
    
                    send_mail($lawyer->name(), $lawyer->get->email, 'New Document Notification', $message);
                }
                # code...
            }

        }

        

        return redirect('/document/' . $document->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  obj  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Documents $document)
    {
        // dd(Role::findByName(str_replace('-', ' ', $role)));


        $lawyers = Lawyer::all();
        return view('pages.document.view')->with([
            'lawyers' => $lawyers,
            'document' => $document,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  obj  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Documents $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Documents $document)
    {
        $document->update([
            'title' => $request->title,
            'type' => $request->type,
            'has_signature' => $request->has_signature == 'on' ? true : false,
            'signature_config' => $request->signature_config,
            'has_stamp' => $request->has_stamp == 'on' ? true : false,
            'stamp_config' => $request->stamp_config,
            'has_user_name' => $request->has_user_name == 'on' ? true : false,
            'user_name_config' => $request->user_name_config,
            'has_lawyer_name' => $request->has_lawyer_name == 'on' ? true : false,
            'lawyer_name_config' => $request->lawyer_name_config,
            'show_signed_date' => $request->show_signed_date == 'on' ? true : false,
            'signed_date_config' => $request->signed_date_config,
            'lawyers_assigned' => json_encode($request->lawyers_assigned),
            'description' => $request->description,
            'attachments' => $request->attachments,
        ]);
        return redirect()->back()->with('success', 'Document updated successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */


    public function update_user_document(Request $request, Documents $document, User $user)
    {
        $user->signed_documents->update([
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success', 'Document updated successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */
    public function resident_documents(User $user)
    {
        $documents = Documents::all();
        return view('pages.resident_documents.view')->with([
            'documents' => $documents,
            // 'permissions' => $permissions,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */
    public function user_documents(User $user)
    {
       
        $currentUser = User::find(Auth::id());
        $documents = $currentUser->lawyer->documents();
        return view('pages.document.users-documents')->with([
            'user' => $user,
            'documents' => $documents,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */
    public function resident_document(User $user, Documents $document)
    {


        return view('pages.resident_document.view')->with([
            'document' => $document,
            'user_id' => $user->id,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */
    public function user_document(User $user, Documents $document)
    {
        // dd('jhjb');
        $currentUser = User::find(Auth::id());
        $lawyers_assigned = json_decode($document->lawyers_assigned);
        // dd($lawyers_assigned);

        // dd($document->lawyers_assigned);
        if (in_array($currentUser->lawyer->id, $lawyers_assigned)) {

            return view('pages.document.preview')->with([
                'document' => $document,
                'user' => $user,

            ]);
        } else {
            abort(404);
        }
    }

    public function user_agreement_forms(User $user)
    {
        // $documents = Documents::all();
        $currentUser = User::find(Auth::id());
        $documents = $currentUser->lawyer->agreement_forms();
        return view('pages.document.users-agreement-documents')->with([
            'user' => $user,
            'documents' => $documents,
            // 'permissions' => $permissions,

        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */
    public function update_user_data(Request $request, Documents $document, User $user)
    {

        // dd($request->all());
        if ($request->action == 'on') {
            // dd($user->signed_documents()->where('document_id', $document->id)->get());

            if ($user->signed_documents()->where('document_id', $document->id)->first() != null) {
                //merge
                $signed_documents = $user->signed_documents()->where('document_id', $document->id);
                $data = json_decode($signed_documents->value($request->type), true);

                if ($data != null) {

                    $new_data =   [
                        'type' => $request->type,
                        'page' => $request->page,
                        'x' => $request->x,
                        'y' => $request->y,
                    ];



                    $not_same = false;
                    foreach ($data as $old_data) {

                        if (
                            $new_data['type'] == $old_data['type'] &&
                            $new_data['page'] == $old_data['page'] &&
                            $new_data['x'] == $old_data['x'] &&
                            $new_data['y'] == $old_data['y']
                        ) {
                            // Data are  the same ingore
                            // $data = $data;
                            return redirect()->back()->with('success', 'Settings already Saved');
                            $not_same = false;
                        } else {

                            // Data are not the same add to array
                            $not_same = true;
                        }
                    }

                    if ($not_same == true) {
                        $data[] = $new_data;
                    }
                } else {

                    $data[] =   [
                        'type' => $request->type,
                        'page' => $request->page,
                        'x' => $request->x,
                        'y' => $request->y,
                    ];
                }



                //check if all data is completed 
                //lets search in document config
                //we will remove the last letter s and replace with _config to get the specific config file
                if ($request->type == 'names') {
                    $document_config = 'lawyer_name_config';
                } else {
                    $document_config = substr_replace($request->type, "", -1) . '_config';
                }


                // now let get the from from the document table
                // $document = $signed_documents->first()->document();
                $document_config_column_data = json_decode($document->$document_config, true);
                // dd($document_config_column_data);
                //lets check if all data from the document are ready
                $exits = 0;
                foreach ($document_config_column_data as $config_column_data) {

                    //$config_column_data['type']


                    // echo $config_column_data['page'];

                    $reData = [];

                    foreach ($data as $check) {
                        if (
                            $config_column_data['page'] == $check['page'] &&
                            $config_column_data['x'] == $check['x'] &&
                            $config_column_data['y'] == $check['y']
                        ) {
                            
                            //Recollect the data and make sure only the once on document is remaining
                            //this will delete sign part that has been deleted or updated from main document

                            $reData[] =   [
                                'type' => $check['type'],
                                'page' => $check['page'],
                                'x' => $check['x'],
                                'y' => $check['y'],
                            ];

                            $exits++;
                            // Data are  the same ingore

                        }
                    }
                }

                $status = 'pending';






                // echo 'exit: '.$exits.'D: '.count($document_config_column_data);

                


                // dd($user);


                if (count($document_config_column_data) == $exits) {
                    // echo 'all data from document config are in this table';
                    $status = 'completed';
                } else {
                    // echo 'oooh we are not sure ';
                    $status = 'pending';
                }



                $signed_documents->update([
                    'document_id' => $document->id,
                    'lawyer_id' => Auth::id(),
                    $request->type => json_encode($reData),
                    $request->type . '_status' => $status,
                ]);

                // print_r($document_config_column_data);
                // print_r($data);
                // print_r($reData);
                // echo 'data update with status '.$status;
                if ($status == 'completed') {
                    return redirect()->back()->with('success', 'Settings Saved, and all ' . $request->type . ' has been completed');
                } else {
                    return redirect()->back()->with('success', 'Settings Saved');
                }
            } else {

                //else create new data

                $data[] = [
                    'type' => $request->type,
                    'page' => $request->page,
                    'x' => $request->x,
                    'y' => $request->y,
                ];

                //check if all data is completed 
                //lets search in document config
                //we will remove the last letter s and replace with _config to get the specific config file

                if ($request->type == 'names') {
                    $document_config = 'lawyer_name_config';
                } else {
                    $document_config = substr_replace($request->type, "", -1) . '_config';
                }
                // now let get the from from the document table
                // $document = $signed_documents->first()->document();
                $document_config_column_data = json_decode($document->$document_config, true);

                $exits = 0;

                //lets check if all data from the document are ready
                // dd($document->$document_config);
                foreach ($document_config_column_data as $config_column_data) {

                    //$config_column_data['type']


                    // echo $config_column_data['page'];

                    foreach ($data as $check) {
                        if (
                            $config_column_data['page'] == $check['page'] &&
                            $config_column_data['x'] == $check['x'] &&
                            $config_column_data['y'] == $check['y']
                        ) {
                            $exits++;
                            // Data are  the same ingore

                        }
                    }
                }

                $status = 'pending';

                if (count($document_config_column_data) == $exits) {
                    // echo 'all data from document config are in this table';
                    $status = 'completed';
                } else {
                    // echo 'oooh we are not sure ';
                    $status = 'pending';
                }



                $user->signed_documents()->create([
                    'document_id' => $document->id,
                    'lawyer_id' => Auth::id(),
                    $request->type => json_encode($data),
                    $request->type . '_status' => $status,
                    'year' => DB::table('settings')->value('current_year'),
                ]);

                // echo 'data created with status '.$status;
                if ($status == 'completed') {
                    return redirect()->back()->with('success', 'Settings Saved, and all ' . $request->type . ' has been completed');
                } else {
                    return redirect()->back()->with('success', 'Settings Saved');
                }
            }
        } else {
            // dd($request->all());

            if ($user->signed_documents()->where('document_id', $document->id)->first() != null) {
                //merge
                $signed_documents = $user->signed_documents()->where('document_id', $document->id);
                $data = json_decode($signed_documents->value($request->type), true);

                $new_data = [];
                foreach ($data as $key => $value) {
                    if (
                        $request->page == $value['page'] &&
                        $request->x == $value['x'] &&
                        $request->y == $value['y']
                    ) {
                        
                        
                        // echo 'time to remove key: '.$key;
                        unset($data[$key]);
                        
                        // $new_data[] = [
                        //     'page' => $value['page'],
                        //     'x' => $value['x'],
                        //     'y' => $value['y'],
                        // ];
                    }
                }
                // print_r([
                //     'page' => $request->page,
                //     'x' => $request->x,
                //     'y' => $request->y,
                // ]);
                // print_r($data);
                $new_data = array_values($data);
               
                // print_r($new_data);
                $signed_documents->update([
                    'document_id' => $document->id,
                    'lawyer_id' => Auth::id(),
                    $request->type => json_encode($new_data),
                    $request->type . '_status' => 'pending',
                ]);

                return redirect()->back()->with('success', 'Settings Saved');
            }else{
                return redirect()->back()->with('success', 'No Settings was saved');
            }
            // echo 'time to remove';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Documents $document)
    {
        // dd($document);
        $document->delete();
        return redirect('/document')->with('success', 'Document has been deleted');
    }

    public function print(Documents $document, User $user)
    {
        $filePath = public_path("Gmail.pdf");
        $output_file_path = public_path($user->first_name . '-' . $user->middle_name . '-' . $user->last_name . '-' . $document->title . '-' . $document->type . ".pdf");
        $this->fillPDFFile($document, $user);

        $outputFilePath = public_path("sample_output.pdf");


        return response()->file($output_file_path);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fillPDFFile($document, $user)
    {

        $data = [];



        $signed_documents = $user->signed_documents()->where('document_id', $document->id);

        

        $file = public_path($document->document_path);
        // dd($file);
        $output_file_path = public_path($user->first_name . '-' . $user->middle_name . '-' . $user->last_name . '-' . $document->title . '-' . $document->type . ".pdf");
        $lawyer = $signed_documents->value('lawyer_id') !== null ? User::where('id', $signed_documents->value('lawyer_id'))->first()->lawyer : [];

        // dd($lawyer)
        $lawyer_stamp = isset($lawyer->stamp) ? asset($lawyer->stamp) : asset('document-files/demo-stamp.jpg');
        $lawyer_signature = isset($lawyer->signature) ? asset($lawyer->signature) : asset('document-files/demo-signature.png');



        if ($document->has_signature) {
            $data['signature'] = json_decode($signed_documents->value('signatures'), true);
        }

        if ($document->has_stamp) {
            $data['stamp'] = json_decode($signed_documents->value('stamps'), true);
        }

        if ($document->has_lawyer_name) {
            $data['lawyer_name'] = json_decode($signed_documents->value('names'), true);
        }

        if ($document->has_user_name) {
            $data['user_name'] = json_decode($document->user_name_config, true);
        }

        if ($document->show_sign_date) {
            $data['date'] = json_decode($document->signed_date_config, true);
        }

        $signed_date = $signed_documents->value('signed_date');

        $count_of_data = count($data);
        $data = json_decode(json_encode($data));

        if ($count_of_data !== 0) {

            $fpdi = new Fpdi();
            $count = $fpdi->setSourceFile($file);

            for ($i = 1; $i <= $count; $i++) {

               

                $template = $fpdi->importPage($i);
                $size = $fpdi->getTemplateSize($template);
                // dd(array($size['width'], $size['height']));
                $fpdi->AddPage($size['orientation'], array(210, 282));
                $fpdi->useTemplate($template);
                $fpdi->SetFont("helvetica", "", 12);

                if (isset($data->signature)) {
                    foreach ($data->signature as $values) {
                        if ($i == $values->page) {
                            
                            $fpdi->Image($lawyer_signature, $values->x, $values->y);
                        }
                    }
                }
                
                if (isset($data->stamp)) {
                    foreach ($data->stamp as $values) {
                        if ($i == $values->page) {
                            $fpdi->Image($lawyer_stamp, $values->x, $values->y);
                        }
                    }
                }
                
                if (isset($data->lawyer_name)) {
                    foreach ($data->lawyer_name as $values) {
                        if ($i == $values->page) {
                            $fpdi->Text($values->x, $values->y, $lawyer->name());
                        }
                    }
                }

                if (isset($data->user_name)) {
                    foreach ($data->user_name as $values) {
                        if ($i == $values->page) {
                            // print_r($values);
                            $fpdi->Text($values->x, $values->y, $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name);
                        }
                    }
                }

                if (isset($data->date)) {
                    foreach ($data->date as $values) {
                        if ($i == $values->page) {
                            // print_r($values);
                            $fpdi->Text($values->x, $values->y, Carbon::parse($signed_date)->format('d/m/Y'));
                        }
                    }
                }

                // foreach ($data as $value) {

                //     if ($i == $value['page']) {
                //         $fpdi->SetFont("helvetica", "", 8);
                //         $fpdi->SetTextColor(153, 0, 153);
                //         // $fpdi->SetXY($data->x, $data->y);
                //         $left = $value['x'];
                //         $top = $value['y'];
                //         $text = "itsolutionstuff.com";
                //         $text = "THIS IS THE TEXT ON PAGE ".$value['page'];
                //         $fpdi->Text($left, $top, $text);
                //         // $fpdi->Write(60, 'A simple concatenation demo with FPDI');


                //         // $fpdi->Image("https://www.itsolutionstuff.com/assets/images/footer-logo.png", 40, 90);
                //     }
                // }
            }
        }


        return $fpdi->Output($output_file_path, 'F');
    }
}
