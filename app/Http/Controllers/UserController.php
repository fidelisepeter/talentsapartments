<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use function App\View\Components\send_mail;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is.admin']);
    }

    public function users()
    {
        $viewingYear = DB::table('settings')->value('viewing_year');
        
        
            $users = DB::table('users')->where('role', 'student')->where('year', $viewingYear)->orderBy('id', "DESC")->get();
            return view('pages.users')->with(['users'=>$users]);
       
    }

    // public function users()
    // {
    //     $viewingYear = DB::table('settings')->value('viewing_year');
        
    //     if (request()->input('search')) {
    //         request()->validate([
    //             'search'=>'required|min:2'
    //          ]);

    //         $search_text = request()->input('search');
    //         $users = DB::table('users')
    //                     ->where('year', $viewingYear)
    //                     ->where('role', 'student')
    //                     ->Where('first_name', 'LIKE', '%'.$search_text.'%')
    //                     ->orWhere('middle_name', 'LIKE', '%'.$search_text.'%')
    //                     ->orWhere('last_name', 'LIKE', '%'.$search_text.'%')
    //                     ->simplePaginate(1);
    //         $users->appends(request()->all());
    //         return view('pages.users')->with(['users'=>$users]);
    //     // dd( $users);
    //     } else {
    //         $users = DB::table('users')->where('role', 'student')->where('year', $viewingYear)->orderBy('id', "DESC")->simplePaginate(10);
    //         return view('pages.users')->with(['users'=>$users]);
    //     }
    // }

    public function administrators()
    {
        $users = DB::table('users')->where('id', '!=', Auth::id())->where('role', '!=', 'student')->orderBy('id', "DESC")->simplePaginate(10);
        return view('pages.administrators')->with(['users'=>$users]);
    }
}
