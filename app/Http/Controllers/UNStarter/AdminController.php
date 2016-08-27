<?php

namespace App\Http\Controllers\UNStarter;

use Activity;
use View;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Lead;
use App\User;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('admins');

    }

    public function index()
    {
        $title = "Supervisor panel";
        $object = User::get();
        // Activity::log('Admin panel was displayed!');
        // $x = activity()->log('Look, I logged something');
        // return 'OK!';
        return View::make('unstarter.admin.index', compact('title','object','itemkind','leads'))
            ->with('itemkind', 'admin')
            ->with('task', 'supervisor');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function clients()
    {
        // return view('home');
        $object = Client::get();

        return View::make('admin.dashboard_clients', compact('object'))
            ->with('itemkind', 'clients')
            ->with('task', 'dashboard');
    }




    public function dashboard()
    {
        $title = "Kailong Strona startowa";

        return View::make('pages.dashboard', compact('title','entities','itemkind','exemplar'))
            ->with('itemkind', 'pages')
            ->with('task', 'landingpage');
    }


    public function contact()
    {
        $title = "Kailong Strona startowa";

        return View::make('pages.contact', compact('title','entities','itemkind','exemplar'))
            ->with('itemkind', 'pages')
            ->with('task', 'contact');
    }


    public function services()
    {
        $title = "Kailong Strona startowa";

        return View::make('pages.services', compact('title','entities','itemkind','exemplar'))
            ->with('itemkind', 'pages')
            ->with('task', 'landingpage');
    }

    public function modus_operandi()
    {
        $title = "Kailong Strona startowa";

        return View::make('pages.modus_operandi', compact('title','entities','itemkind','exemplar'))
            ->with('itemkind', 'pages')
            ->with('task', 'landingpage');
    }






    public function dashboard_users() {

        $object = User::orderBy('created_at', 'desc')->get();

        return View::make('admin.dashboard_users', compact('object'))->with('task', 'view')->with('itemkind', 'users');
    }




}
