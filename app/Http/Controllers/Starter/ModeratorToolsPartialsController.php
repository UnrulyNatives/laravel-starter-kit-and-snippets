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
use App\Models\Electoralcandidate;

use Sunra\PhpSimple\HtmlDomParser;

class ModeratorToolsPartialsController extends Controller
{

    public function __construct() {
        $this->middleware('moderators');

        // $this->middleware('admins', ['only' => array('recalc_party_membership')]);

    }

    public function index() {

        //


    }



public function change_participants_status_value($itemkind,$itemid,$newval='1') {


    if($itemkind == 'events') {
        $newstatus = Event::find($itemid);
        $newstatus->participants_status = $newval;
        $newstatus->save();

    }

    return "status zmieniony na ".$newval;
}

public function change_field_value($itemkind,$field,$itemid,$newval='1') {



   $itemtype = str_singular($itemkind);
    $class_name = ucfirst($itemtype);
    $name = "App\\Models\\" . $class_name;
    $class = new $name;

    if (class_exists($name) && get_parent_class($class) == 'Illuminate\Database\Eloquent\Model') {

        $object = $class->find($itemid);
        $object->$field = $newval;
        $object->save();
        return "Pole ".$field." zmienione na ".$newval;

    } else {
         return "Needs more developing. See BB #675";
    }



}


public function delete_distr_cand($district) {

    $object = Electoralcandidate::where('electoraldistrict_id', $district)->delete();


    return "Wszyscy kandydaci z dystryktu usunięci z bazy ";
}



public function elaborate_object($itemkind, $id=null) {


        $ent = array('' => 'Podmiot...') + Entity::orderBy('id', 'desc')->pluck('name', 'id')->all();

        $sptype = array(null => 'Wybierz typ zachowania...', '1' => 'Zachowanie', '2' => 'Słowa', '4' => 'Działanie');
        $eve = array('' => 'Zdarzenie...') + Event::orderBy('id', 'desc')->pluck('name', 'id')->all();

        $que = array('' => 'Pytanie...') + Question::where('status',5)->orderBy('id', 'desc')->pluck('question_to_entity', 'id')->all()  + Question::where('status',1)->orderBy('id', 'desc')->pluck('question_to_entity', 'id')->all();
        $mot = array('99' => 'Motywacja..') + Entitystandpointmotive::orderBy('id', 'asc')->pluck('name', 'id')->all();
        $rol = array('99' => 'Rola..') + Entitystandpointrole::orderBy('id', 'asc')->pluck('name', 'id')->all();
        $commo = array('' => 'Produkt/marka') + Commodity::orderBy('id', 'asc')->pluck('name', 'id')->all();
        $sta = array('' => 'Stanowisko innego podmiotu') + Entitystandpoint::orderBy('id', 'desc')->limit(30)->pluck('name', 'id')->all();
        $tags = Tag::orderBy('name', 'asc')->pluck('name', 'name')->all();


    $object = Electoralcandidate::where('electoraldistrict_id', $district)->delete();

        return View::make('entitystandpoints.elaborate', compact('object', 'que', 'eve', 'mot', 'rol', 'sptype','commo', 'sta','tags'))->with('task', 'edit')->with('itemkind', 'entitystandpoints');
}




}
