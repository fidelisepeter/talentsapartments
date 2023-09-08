<?php

namespace App\Http\Controllers;

use App\Models\PurchasedItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use function App\View\Components\send_mail;
use function App\View\Components\sendGurantorForm;
use function App\View\Components\createNotification;

class ComplainController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'is.admin']);
    }

    public function complains()
    {
        return view('pages.complains');
    }

    public function complain($id)
    {

        $complain = DB::table('complaints')->where('id', $id ?? '')->first();
        $tenant = User::where('id', $complain->user_id)->first();
        
        if ($complain) {
            if (DB::table('tasks')->where('task_of', $complain->id)->value('attendant') == Auth::user()->id || Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->can('view-complaints') || Auth::user()->hasRole(DB::table('settings')->value('complaints_management_role'))) {
                return view('pages.complain')->with('complaint', $complain);
            } else {
                return redirect('complaints')->with('error', 'You are not assigned to that task');
            }
        } else {
            return redirect('complaints')->with('error', 'Sorry can not access that content');
        }
    }

    public function task_completed(Request $request)
    {
        $task = DB::table('tasks')->where('id', $request->input('task_id'))->update([
            'status' => 'completed',
        ]);
        return redirect()->back();
    }

    public function remove_all_items(Request $request, $id)
    {
        $tasks = DB::table('tasks')->where('task_of', $id)->first();
        DB::table('purchased_items')->where('task_id', $tasks->id)->delete();
        return redirect()->back()->with('success', 'Items Removed');
    }

    public function update_items(Request $request, $id)
    {

        $tasks = DB::table('tasks')->where('task_of', $id)->first();
        $items = $request->items;

        
        DB::table('purchased_items')->where('task_id', $tasks->id)->delete();
        foreach ($items as $item) {
            $inventory = DB::table('inventories')->where('id', $item['department'])->first();
            $data['task_id'] = $tasks->id;
            $data['inventory_id'] = $inventory->id;
            $data['quantity'] = $item['quantity'];
            $data['cost'] = $item['quantity'] * $inventory->cost;
            $data['description'] = $item['description'];
            $data['labour'] = $item['labour'];
            $data['used_by'] =  Auth::id();

            DB::table('purchased_items')->insert($data);
            $itemArray[] = $data;
        }

        //    dd($itemArray);
        return redirect()->back()->with('success', 'Items Updated');
    }

    public function assign(Request $request)
    {
        $check = DB::table('tasks')->where('task_of', $request->input('task_of'))->get();
        if (count($check) == 0) {
            $task = DB::table('tasks')->insert([
                'user_id' => $request->input('user_id'),
                'task_of' => $request->input('task_of'),
                'attendant' => $request->input('attendant'),
                'year' => DB::table('settings')->value('current_year'),
            ]);
        } else {
            $task = DB::table('tasks')->where('task_of', $request->input('task_of'))->update([
                'attendant' => $request->input('attendant'),
                'year' => DB::table('settings')->value('current_year'),
            ]);
        }

        $complian = DB::table('complaints')->where('id', $request->input('task_of'))->first();
        $tenant = User::where('id', $complian->user_id)->first();
       
        $tenantFullname = $tenant->first_name.' '.$tenant->last_name;
        $roomType = $tenant->bedspace->room->name;
        $room_number = $tenant->bedspace->room_number.' '.$tenant->bedspace->name;
        $url = url('/complaint/' . $request->input('task_of'));

        //Message
        $message = "Hello! A new task has been assigned to you <br>";
        $message .= "Click the link below to view <br><br>";
        $message .= "Tenant Name: ".$tenantFullname."<br>";
        $message .= "Room Type: ".$roomType."<br>";
        $message .= "Room Number: ".$room_number."<br>";
        $message .= 'Link: <a target"_blank" href="'.$url.'">'.$url.'</a>';

        // $message .= url('/complaint/' . $request->input('task_of'));
        $user = User::where('id', $request->input('attendant'))->first();
        send_mail($user->first_name, $user->email, 'New Task', $message);
        // send_mail(Auth::user()->first_name, Auth::user()->email, 'Talents Apartment Application', $message);
        DB::table('user_notifications')->insert([
            'user_id' => $request->input('user_id'),
            'title' => 'Your complain has been assigned to ' . DB::table('users')->where('id', $request->input('attendant'))->value('first_name') . ' ' . DB::table('users')->where('id', $request->input('attendant'))->value('last_name'),
            'message' => 'Your complain has been assigned to ' . DB::table('users')->where('id', $request->input('attendant'))->value('first_name') . ' ' . DB::table('users')->where('id', $request->input('attendant'))->value('last_name'),
            'status' => 'unread',
            'year' => DB::table('settings')->value('current_year')
        ]);


        return redirect()->back();
    }
}
