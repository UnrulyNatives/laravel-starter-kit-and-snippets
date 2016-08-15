<?php
namespace App\Http\Controllers;

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
use Illuminate\Cookie\CookieJar;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use App\Models\Userattitude;
use App\Models\Exemplarattitude;
use App\Models\Action;
use App\Models\Entity;
use App\Models\Exemplar;
use App\Models\Question;
use App\Models\Topic;
use App\Models\Event;
use App\Models\Country;
use App\Models\Commodity;
use App\Models\Ingredient;
use App\Models\Entitystandpoint;
use App\Models\Capacitytype;
use App\Models\Itemtype;
use App\Models\Taskgroup;
use App\Models\Widget;
use App\Models\UserWorkspace;
use App\Models\Entityrelation;
use App\Models\Tactic;
use App\Models\Counteraction;
use Lanz\Commentable\Comment;
use App\Models\Related;
use App\Models\Caretaken;
use App\Models\Usersetting;
use App\Models\Communique;
use App\Models\Communiquetype;
use App\Models\Changelog;
use App\Models\Sitestat;
use App\User;
use App\Models\Role;
use App\Models\Comms;
use App\Models\EntityCommodity;
use App\Models\Task;
use App\Models\Entitycapacitytype;
use App\Helpers\SitewideHelper;
use Sunra\PhpSimple\HtmlDomParser;

class AdminToolsPartialsController extends Controller
{

    public function __construct() {
        $this->middleware('moderators', ['except' => array('index') ]);

        // $this->middleware('admins', ['only' => array('recalc_party_membership')]);

    }

    public function index() {

        //


    }

    public function manage_relations_switch_ceased($entityrelationid) {

        $perform = Input::get('perform');

        $object = Entityrelation::find($entityrelationid);

        $currentval = $object->ceased;

        if ($currentval == '0') {
            $reversedval = '1';
        }
        if ($currentval == '1') {
            $reversedval = '0';
        }
        $object->ceased = $reversedval;
        $object->save();

        return View::make('admin.partials.partial_switch_ceased', compact('entityrelationid', 'reversedval', 'currentval'));
    }

    public function manage_relations_fill_a_field($field, $entityrelationid) {

        $content_to_use = Input::get('content');

        $object = Entityrelation::find($entityrelationid);

        $currentval = $object->ceased;

        if ($field == 'end_confirmation_URL') {
            $object->end_confirmation_URL = $content_to_use;
            // $newvalue = $object->end_confirmation_URL;
        }
        if ($field == 'confirmation_URL') {
            $object->confirmation_URL = $content_to_use;
            // $newvalue = $object->confirmation_URL;
        }

        $object->save();
            $newvalue = $content_to_use;

        return View::make('admin.partials.partial_manage_relations_fill_a_field', compact('entityrelationid', 'newvalue', 'field'));
    }

    public function manage_relations_update_a_field($field, $entityrelationid) {


        sleep(1);
        $object = Entityrelation::find($entityrelationid);
        $current_value = $object->$field;

        return $object->$field;
    }


public function ajax_get_entity_duplicate($sourceid=null,$targetid=null) {

    $source = Entity::find($sourceid);
    $target = Entity::find($targetid);

    return View::make('admin.partials.ajax_get_entity_duplicate', compact('source','target','sourceid','targetid'));
}




public function transfer_duplicate_data($datatype,$sourceid,$targetid) {


            // transfering Entitystandpoints
            if($datatype == 'entitystandpoints') {

                $get_source_items = Entitystandpoint::where('entity_id',$sourceid)->get();
                foreach ($get_source_items as $gss) {

                    $update = Entitystandpoint::find($gss->id);
                    $update->entity_id = $targetid;
                    $update->save();
                }

            }


            // transfering Relations in which Source is Child
            if($datatype == 'entityrelations') {

                // just for the sake of returned output
                $total_initial_count = Entityrelation::where('entitychild_id',$sourceid)->orWhere('entityparent_id',$sourceid)->get();

                // transfering first type
                $get_source_items = Entityrelation::where('entityparent_id',$sourceid)->get();
                foreach ($get_source_items as $gsi) {

                    $update = Entityrelation::find($gsi->id);
                    $update->entityparent_id = $targetid;
                    $update->save();
                }
                // transfering first type
                $get_source_items = Entityrelation::where('entitychild_id',$sourceid)->get();
                foreach ($get_source_items as $gsi) {

                    $update = Entityrelation::find($gsi->id);
                    $update->entitychild_id = $targetid;
                    $update->save();
                }
                // now getting the count again
                $get_source_items = $total_initial_count;

            }



            // transfering RELATED
            if($datatype == 'relateds') {

                $get_source_items = Related::where('itemkind','entities')->where('item_id', $sourceid)->get();
                foreach ($get_source_items as $gsi) {

                    $update = Related::find($gsi->id);
                    $update->item_id = $targetid;
                    $update->save();
                }

            }


            // transfering COMMENTS
            if($datatype == 'comments') {

                $get_source_items = Comms::where('commentable_type','entity')->where('commentable_id', $sourceid)->get();
                foreach ($get_source_items as $gsi) {

                    $update = Comms::find($gsi->id);
                    $update->commentable_id = $targetid;
                    $update->save();
                }

            }


            // transfering COMMODITY_OWNERSHIP
            if($datatype == 'commo_own') {

                $get_source_items = EntityCommodity::where('entity_id',$sourceid)->get();
                foreach ($get_source_items as $gsi) {

                    $update = EntityCommodity::find($gsi->id);
                    $update->entity_id = $targetid;
                    $update->save();
                }

            }

            // User attitudes
            if($datatype == 'user_att') {

                $get_source_items = Userattitude::where('item_id',$sourceid)->where('item_type','entity')->get();
                foreach ($get_source_items as $gsi) {

                    $update = Userattitude::find($gsi->id);
                    $update->item_id = $targetid;
                    $update->save();
                }

            }

            // Exemplar attitudes
            if($datatype == 'exemplar_att') {

                $get_source_items = Exemplarattitude::where('item_id',$sourceid)->where('item_type','entity')->get();
                foreach ($get_source_items as $gsi) {

                    $update = Exemplarattitude::find($gsi->id);
                    $update->item_id = $targetid;
                    $update->save();
                }

            }


          // Exemplar actions
            if($datatype == 'actions') {

                $get_source_items = Action::where('item_id',$sourceid)->where('item_type','entity')->get();
                foreach ($get_source_items as $gsi) {

                    $update = Action::find($gsi->id);
                    $update->item_id = $targetid;
                    $update->save();
                }

            }


          // Exemplar counteractions
            if($datatype == 'counteractions') {

                $get_source_items = Counteraction::where('item_id',$sourceid)->where('item_type','entity')->get();
                foreach ($get_source_items as $gsi) {

                    $update = Counteraction::find($gsi->id);
                    $update->item_id = $targetid;
                    $update->save();
                }

            }


          //  communiques
            if($datatype == 'communiques') {

                $get_source_items = Communique::where('item_id',$sourceid)->where('item_type','entity')->get();
                foreach ($get_source_items as $gsi) {

                    $update = Communique::find($gsi->id);
                    $update->item_id = $targetid;
                    $update->save();
                }

            }




          //  caretakens
            if($datatype == 'caretakens') {

                $get_source_items = Caretaken::where('item_id',$sourceid)->where('item_type','entity')->get();
                foreach ($get_source_items as $gsi) {

                    $update = Caretaken::find($gsi->id);
                    $update->item_id = $targetid;
                    $update->save();
                }

            }



          //  tasks
            if($datatype == 'tasks') {

                $get_source_items = Task::where('item_id',$sourceid)->where('item_type','entity')->get();
                foreach ($get_source_items as $gsi) {

                    $update = Task::find($gsi->id);
                    $update->item_id = $targetid;
                    $update->save();
                }

            }







    return "przeniesiono ".$datatype." : ".$get_source_items->count();
    // return View::make('admin.partials.transfer_duplicate_data', compact('source','target','sourceid','targetid'));
}





    public function transfer_entity_att($attribute,$sourceid,$targetid) {

        $src_entity = Entity::find($sourceid);
        $tar_entity = Entity::find($targetid);


        if($attribute == 'avatar_copyright') {

            $get_value = $src_entity->avatar_copyright;

            $tar_entity->avatar_copyright = $get_value;
        }


        if($attribute == 'avatar') {

            $get_value = $src_entity->avatar;

            $tar_entity->avatar = $get_value;
        }

        if($attribute == 'avatar_credit') {

            $get_value = $src_entity->avatar_credit;

            $tar_entity->avatar_credit = $get_value;
        }


        if($attribute == 'website_URL') {

            $get_value = $src_entity->website_URL;

            $tar_entity->website_URL = $get_value;
        }


        if($attribute == 'wiki_URL') {

            $get_value = $src_entity->wiki_URL;

            $tar_entity->wiki_URL = $get_value;
        }



        if($attribute == 'feedback_facebook') {

            $get_value = $src_entity->feedback_facebook;

            $tar_entity->feedback_facebook = $get_value;
        }




        if($attribute == 'acronym') {

            $get_value = $src_entity->acronym;

            $tar_entity->acronym = $get_value;
        }




        if($attribute == 'description') {

            $get_value = $src_entity->description;

            $tar_entity->description = $get_value;
        }



        if($attribute == 'name_last') {

            $get_value = $src_entity->name_last;

            $tar_entity->name_last = $get_value;
        }



        if($attribute == 'inception_year') {

            $get_value = $src_entity->inception_year;

            $tar_entity->inception_year = $get_value;
        }


        if($attribute == 'date_end_year') {

            $get_value = $src_entity->date_end_year;

            $tar_entity->date_end_year = $get_value;
        }





        $tar_entity->save();



        return "przeniesiono ";
        // return View::make('admin.partials.transfer_duplicate_data', compact('source','target','sourceid','targetid'));
    }




    public function transfer_entity_capacities($sourceid,$targetid) {

        $src_entity = Entity::find($sourceid);
        $tar_entity = Entity::find($targetid);





                $get_source_capacities = Entitycapacitytype::where('entity_id',$sourceid)->get();

                foreach ($get_source_capacities as $gsi) {

                    $get_target_capacity = Entitycapacitytype::where('entity_id',$targetid)
                        ->where('capacitytype_id',$gsi->capacitytype_id)->first();
                    if(!$get_target_capacity) {
                        $gsi->entity_id = $targetid;
                        $gsi->save();
                    }


                }

        return "capacity przeniesiono ";

}



    public function managerelations_ajax_update()
    {
        //check if its our form
        if (Session::token() !== Input::get('_token')) {
            return Response::json(array('msg' => 'Unauthorized attempt to create option'));
        }


        $relation_id = Input::get('relation_id');
        // $new_translation = Input::get('meaning_polish');
        // $new_translation = 'nowe_tłumaczenie'.rand(1,19);
        $date_start_year = Input::get('date_start_year');
        $date_end_year = Input::get('date_end_year');
        $confirmation_URL = Input::get('confirmation_URL');
        $end_confirmation_URL = Input::get('end_confirmation_URL');


        $object = Entityrelation::find($relation_id);
        $object->date_start_year = $date_start_year;
        $object->date_end_year = $date_end_year;
        $object->confirmation_URL = $confirmation_URL;
        $object->end_confirmation_URL = $end_confirmation_URL;

        $object->save();
        $LastInsertId = $object->id;



        $response = array('status' => 'success', 'msg' => 'xx-'.rand(20,40).'id-'.$relation_id.' zmieniono dane relacji!', 'relation_id' => $relation_id, 'date_start_year' => $date_start_year);

        return Response::json($response);
    }

    public function regenerate_name_from_ext_link($modelname, $modelid,$needmanual = 0)
    {
        $modelname_full = "App\\Models\\" .$modelname;
        if($modelname == 'Event') {
            $linkcolumnname = 'confirmation_URL';
        }
        if($modelname == 'Related') {
            $linkcolumnname = 'URL';
        }
        if($modelname == 'Action') {
            $linkcolumnname = 'web_initiator_action';
        }
        if($modelname == 'Counteraction') {
            $linkcolumnname = 'credit_URL';
        }

            $object = $modelname_full::find($modelid);
            $link = $object->$linkcolumnname;
            try {

                // Revel's privete function, now a helper
                // $page_title = $this->_get_url_title($page_url);
                $page_title = SitewideHelper::parseTitle($link);
            } catch(ErrorException $e) {
                return trans('messages.somethings_wrong');

            }
            if($needmanual == 0) {
                $object->name = ($page_title != '') ? $page_title : trans('messages.needs_manual_fix');
            } else {
                $object->name = trans('messages.needs_manual_fix');
            }
            $object->save();
            return "Regenrated!";
    }


    public function add_http_to_external_link($modelname, $modelid)
    {
        $modelname_full = "App\\Models\\" .$modelname;
        if($modelname == 'Event') {
            $linkcolumnname = 'confirmation_URL';
        }
        if($modelname == 'Related') {
            $linkcolumnname = 'URL';
        }
        if($modelname == 'Action') {
            $linkcolumnname = 'web_initiator_action';
        }
        if($modelname == 'Counteraction') {
            $linkcolumnname = 'credit_URL';
        }

            $object = $modelname_full::find($modelid);

            $link = $object->$linkcolumnname;
        // Peter added this to make sure the URL contains the http:// string
        // http://www.easylaravelbook.com/blog/2015/03/31/sanitizing-input-using-laravel-5-form-requests/
        if (preg_match("#https?://#", $link) === 0) {
            $object->$linkcolumnname = 'http://' . $link;
            $object->save();
        }



        return "Prefix added!";
    }


    public function reload_name_url_fields($modelname, $modelid)
    {
        if($modelname == 'Event') {
            $linkcolumnname = 'confirmation_URL';
            $object = Event::find($modelid);
        }

        if($modelname == 'Related') {
            $linkcolumnname = 'URL';
            $object = Related::find($modelid);
        }
        return '<h3>Field name:</h3> '.$object->name.'<h3> URL: '.$object-> $linkcolumnname.'.</h3>';
    }


    public function regenerate_a_slug($modelname, $modelid)
    {
        $modelname_full = "App\\Models\\" .$modelname;


            $object = $modelname_full::find($modelid);
            $object->save();


        return 'Slug regenerated: '.$object->slug.'.';
    }


}
