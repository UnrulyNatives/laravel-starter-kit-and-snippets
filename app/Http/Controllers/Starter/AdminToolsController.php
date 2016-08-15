<?php
namespace App\Http\Controllers\Starter;

use DB;
use Session;
use Redirect;
use Cookie;
use View;
use HTML;
use Auth;
use Input;
use Image;
use Response;
use Theme;
use Mail;
use Artisan;
use Illuminate\Cookie\CookieJar;



use App\Models\Changelog;
use App\Models\Sitestat;

use App\User;
use App\Helpers\SitewideHelper;
use Sunra\PhpSimple\HtmlDomParser;
use App\Http\Controllers\Controller;

class AdminToolsController extends Controller
{

    public function __construct() {
        // $this->middleware('moderators', ['only' => array('refine_relations', 'recalc_party_membership') ]);

        // $this->middleware('admins', ['only' => array('recalc_party_membership')]);
        // $this->middleware('admins', ['except' => array('mailgun') ]);
    }




    public function dashboard_admintools() {

        $object = User::orderBy('created_at', 'desc')->get();

        return View::make('starter.admin.dashboard_admintools', compact('object'))->with('task', 'view')->with('itemkind', 'users');
    }




    public function remove_status_null($itemkind=null) {


        if($itemkind != null) {
            
            $itemtype = str_singular($itemkind);

            //getting Class name
            $class_name = ucfirst($itemtype);
            $name = "App\\Models\\" . $class_name;
            $class = new $name;

            
            if (class_exists($name) && get_parent_class($class) == 'Illuminate\Database\Eloquent\Model') {
                $object = $class->where('status',null)->get();
            }

            // doing the job!
            $perform = Input::get('perform');
            if(isset($perform) && $perform=1) {
                $acteduponarray = $class->where('status',null)->pluck('id');
                $affected = $acteduponarray->count();

                // the action itself:
                $itemstobeacteduponbefore = $class->where('status',null)->count();
                // $actedupon = $class->destroy($acteduponarray);
                $class->whereIn('id', $acteduponarray)->delete(); 
                $itemstobeacteduponafter = $class->where('status',null)->count();

                // $affected = count($acteduponarray);
            }

        }


        return View::make('starter.admin.tools.remove_status_null', compact('object','perform','affected','itemstobeacteduponbefore','itemstobeacteduponafter'))->with('task', 'view')->with('itemkind', 'userlogs');
    }


    public function user_track($id=null) {

        $object = User::find($id);
        if(!$object) {
            $object = User::find(Auth::id());
        }

        return View::make('starter.admin.tools.user_track', compact('object'))->with('task', 'view')->with('itemkind', 'userlogs');
    }



    public function assign_roles($user=null, $role=null)
    {


        // if($user!=null && $role !=null) {
        //     $user = User::find($user);
            
        //     if($user->hasRole($role)) {
        //         $user->removeRole($role);
        //         return 'Role revoked!';
        //     }
        //     $user->assignRole($role);
        //     return "Granted successfuly!";
        // } else {

        //     $roles = Role::get();
        //     if($user==null) {
        //         $users= User::get();
        //     }

        //     return View::make('starter.admin.tools.assign_roles', compact('object','roles','user','users'))->with('task', 'view')->with('itemkind', 'userroles');        

        // }
        // return 'OK!';
        // $role = Role::create(['name' => 'developer']);
        // $role = Role::create(['name' => 'caretaker']);
        // $role = Role::create(['name' => 'moderator']);
        // $role = Role::create(['name' => 'client']);
        // $role = Role::create(['name' => 'agent']);
        // Auth::user()->assignRole('developer', 'caretaker','moderator','client','agent');

        // if (!Auth::user()->hasRole('admin')) {
        //    return '403';
        // } else {
        //     return "ma już rolę!";
        // }


    }

}
