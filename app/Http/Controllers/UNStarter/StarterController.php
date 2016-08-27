<?php

namespace App\Http\Controllers\UNStarter;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class StarterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    


    public function packages()
    {
        $user= Auth::user();
        return view('unstarter.packages', compact('user'));
    }

    public function minitools()
    {
        $user= Auth::user();
        return view('unstarter.minitools', compact('user'));
    }

    public function snippets()
    {
        $user= Auth::user();
        return view('unstarter.snippets', compact('user'));
    }

    public function landing()
    {
        $object = User::get();
        return view('unstarter.landing', compact('object'));
    }
    public function initial_setup()
    {
        $object = User::get();
        return view('unstarter.initial_setup', compact('object'));
    }
}
