<?php

namespace App\Http\Controllers\UNStarter;

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

        return View::make('unstarter.admin.dashboard_admintools', compact('object'))->with('task', 'view')->with('itemkind', 'users');
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


        return View::make('unstarter.admin.tools.remove_status_null', compact('object','perform','affected','itemstobeacteduponbefore','itemstobeacteduponafter'))->with('task', 'view')->with('itemkind', 'userlogs');
    }


    public function user_track($id=null) {

        $object = User::find($id);
        if(!$object) {
            $object = User::find(Auth::id());
        }

        return View::make('unstarter.admin.tools.user_track', compact('object'))->with('task', 'view')->with('itemkind', 'userlogs');
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



    public function resluggify($itemkind) {


        $itemtype = str_singular($itemkind);

        //getting Class name
        $class_name = ucfirst($itemtype);
        $name = "App\\Models\\" . $class_name;
        $class = new $name;

        
        if (class_exists($name) && get_parent_class($class) == 'Illuminate\Database\Eloquent\Model') {
            $model = $class->get();
        }



        foreach ($model as $o) {
            $o->save();
        }

        return 'Slugs in model '.$itemkind.' regenerated! Items affected: '.$model->count();
        // return Redirect::back();
    }



    public function regenerate_model_name($itemkind='relateds') {

        //get from URL variables
        $field2change = 'name';
        $matchcontent = Input::get('matchcontent');
        $newcontent = Input::get('newcontent');

        if(!isset($matchcontent)) {
            $matchcontent = 'bb';
        }
        if(!isset($newcontent)) {
            $newcontent = 'ccc';
        }


        $itemtype = str_singular($itemkind);

        //getting Class name
        $class_name = ucfirst($itemtype);
        $name = "App\\Models\\" . $class_name;
        $class = new $name;




        
        if (class_exists($name) && get_parent_class($class) == 'Illuminate\Database\Eloquent\Model') {
            $model = $class->where($field2change,$matchcontent)
                ->get();

            // the action itself:
            $itemstobeactedupon = $class->where($field2change,$matchcontent)->count();
            // $itemstobeacteduponbefore = \App\Models\Related::where('name','')->count();




            $acteduponarray = $class->where($field2change,$matchcontent)
                // ->limit(20)
                ->pluck('id');
            $affected = $acteduponarray->count();

            // doing the job!
            $perform = Input::get('perform');
            if(isset($perform) && $perform==1) {

                // the action itself:
                $itemstobeacteduponbefore = $class->where($field2change,$matchcontent)->count();
                // $actedupon = $class->destroy($acteduponarray);
                $objects = $class->whereIn('id', $acteduponarray)
                    // ->limit(20)
                    ->get(); 


                echo "List of items changed: <br>";
                foreach($objects as $o) {


                    // if possible, retrieve page title and use it as event name
                    $page_url = $o->URL;
                    try {

                        // Revel's privete function, now a helper
                        // $page_title = $this->_get_url_title($page_url);
                        $page_title = \App\Helpers\SitewideHelper::parseTitle($page_url);
                        // dd($page_title);
                    } catch(ErrorException $e) {
                        return Redirect::back()->withInput()->withErrors(['error accessing url']);
                         // TO DO: fix error msg
                    }
                    // hot fix for L5.3 BB #952
                    $page_title2 = substr($page_title,0,150).'...';

                    echo $page_title;

                    if(isset($page_title2) && $page_title2 !='') {
                        $o->name = $page_title2;
                        
                    } else {
                        $o->name = '';
                        
                    }
                    $o->save();
                    echo 'Changed: '.$o->id.'<br>';
                    echo $o->URL;

                }


                $itemstobeacteduponafter = $class->where('name',$matchcontent)->count();

                // $affected = count($acteduponarray);
            }

        }

        // foreach ($model as $o) {
        //     $o->save();
        // }


        return View::make('unstarter.admin.tools.regenerate_model_name', compact('object','model','itemstobeactedupon','itemstobeacteduponbefore','itemstobeacteduponafter','class','field2change','matchcontent','newcontent','perform','affected','acteduponarray'))->with('task', 'view')->with('itemkind', 'userlogs');

        // return 'Slugs in model '.$itemkind.' regenerated! Items affected: '.$model->count();
        // return Redirect::back();
    }



    public function server_status() {


        return View::make('unstarter.admin.tools.server_status', compact('object','usr'))
        ->with('task', 'server_status')
        ->with('itemkind', 'admintool');
    }



}
