<?php

namespace App\Http\Controllers\Starter;

use DB;
use View;
use Auth;
use Redirect;
use Input;
use Session;
use Theme;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\User;
use App\Models\Setting;

use App\Http\Controllers\Controller;

class UserWorkspacesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth', ['except' => array('services')]);


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard_client($clientid = null)
    {
        // return view('home');
        // $object = Client::where('user_id', Auth::id())->first();
        // $object = Client::where('user_id', Auth::id())->first();

        // check if client assigned to a new user
            $object = DB::table('client_user')->where('user_id', Auth::id())->first();
            if(!$object) {
                return Redirect::to('przydziel-klienta');
            }

        if($clientid == null) {
            $object = DB::table('client_user')->where('user_id', Auth::id())->first();
        } else {
            $object = DB::table('client_user')->where('user_id', Auth::id())->where('client_id', $clientid)->first();
        }



        $object = $object->client_id;
        // dd($object);
        $object = Client::find($object);
        $user = User::find(Auth::id());

        $client = DB::table('client_user')->where('user_id', Auth::id())->where('client_id', $clientid)->first();
        if(!$client && $clientid != null) {
            return "To nie jest twój klient";
        }
        if($client) {
           $client = Client::find($client->client_id);
            
        }
        // dd($client);
        // dd($user);
        return View::make('clients.dashboard_clients', compact('object','user','client'))
            ->with('itemkind', 'clients')
            ->with('task', 'dashboard');
    }


    public function assign_client_to_user()
    {
        $newclient = Input::get('create_client_same_name');
        if($newclient == '1') {

            $object = new Client;
            $object->user_id = Auth::id();
            $object->agent_id = 5;
            $object->name = Auth::user()->name;
            $object->save();

            $object2 = new ClientUser;
            $object2->client_id = $object->id;
            $object2->user_id = Auth::id();
            $object2->role_id = '3';
            $object2->save();

            return redirect('settings');
        }


        $is_expected = Client::where('expected_email', Auth::user()->email)->first();

        return View::make('userworkspace.assign_client_to_user', compact('object','user','client','is_expected'))
            ->with('itemkind', 'userworkspaces')
            ->with('task', 'assignclient');
    }

    public function settings()
    {
        $title = "Kailong Strona startowa";
        $user = User::find(Auth::id());

        return View::make('userworkspace.settings', compact('title','user'))
            ->with('itemkind', 'userworkspaces')
            ->with('task', 'settings');
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


    public function modus_operandi()
    {
        $title = "Kailong Strona startowa";

        return View::make('pages.modus_operandi', compact('title','entities','itemkind','exemplar'))
            ->with('itemkind', 'pages')
            ->with('task', 'landingpage');
    }


    public function set_theme($themeName) {

        // for testing purpose I ignore the variable and hardcode the theme's name
        // \Theme::set('Seldon'); //  just in case I test both with and without backslash
        // Theme::set('Seldon');   // as the namespaces in L5 are major pain

        // \Theme::set('Seldon');

        // dd($themeName);
            Theme::set($themeName);
        // Is $themeName valid?
        if (Theme::find($themeName)) {
            Theme::set($themeName);
            // Cookie::forever('themeName', $themeName);
            Session::forget('themeName');
            Session::put('themeName', $themeName);

            // Cookie::forever('themeName', 'Fawkes')

            return Redirect::back()->withCookie(cookie()->forever('theme-name', $themeName));

            // TO DZIAŁAŁO OK:
            // return Redirect::to('/')->withCookie(cookie()->forever('themeName', $themeName));
            // this is the only way I am able to create a cookie. Facade DON'T WORK!

        }

        return Redirect::back();
         // my error page


    }





    public function sync_available_settings($id) {

        $object = User::find($id);

        $usersettings = Setting::pluck('id')->all();

        // dd($activities);
            $object->usersettings()->sync($usersettings);

        // foreach([1,2,3] as $na) {
        //     $object->activities()->sync($na, null);

        // }

        $object->save();

        return Redirect::to('routines/'. $id);
    }

    public function complete_activity($routineid, $activityid) {

        // $date = new \DateTime;
        // $object = Routine::find($routineid)->activities()->updateExistingPivot($activityid, array('done_at' => $date));

        // http://stackoverflow.com/questions/36809209/manytomany-relation-how-update-attribute-in-pivot-table/36818044#36818044
        $routine = Routine::find($routineid);
        $activity = $routine->activities()->find($activityid);
        $done_at = is_null($activity->pivot->done_at) ? new \DateTime : null;

        $routine->activities()->updateExistingPivot($activityid, compact('done_at'));



        return 'done!';
    }




}
