<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is.admin']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // \Carbon\Carbon::
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // 'photo' => 'required|file|mimes:pdf',
        ]);

        $photo = NULL;


        if ($file = $request->file('photo')) {

            $filesName = $request->photo->hashName();
            
            $request->photo->storeAs('products', $filesName, 'public_uploads');
           $photo = url('/products/' . $filesName);
        }

        $uid = rand(10000000, 99999999);
        DB::table('products')->insert([
            'uid' => $uid,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'photo' => $photo,
            'user_id' => Auth::user()->id
        ]);
        
        return redirect()->back()->with('success', 'Upload successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return view('pages.product-update')->with('product', DB::table('products')->where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // request()->validate([
        //     'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //         // 'photo' => 'required|file|mimes:pdf',
        // ]);

        $photo = DB::table('products')->where('id', $id)->value('photo');


        if ($file = $request->file('photo')) {

            $filesName = $request->photo->hashName();
            
            $request->photo->storeAs('products', $filesName, 'public_uploads');
           $photo = url('/products/' . $filesName);
        }
        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'photo' => $photo,
        ]);
        
        return redirect('/all-products')->with('success', 'Update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'deleted successfully');
    }
}
