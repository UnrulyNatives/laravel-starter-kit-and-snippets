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
use App\Models\Electoralcandidate;

use App\Models\Changelog;
use App\Models\Sitestat;
use App\User;
use App\Models\Role;

use Sunra\PhpSimple\HtmlDomParser;

class ModeratorToolsController extends Controller
{

    public function __construct() {
        $this->middleware('moderators', ['only' => array('refine_relations', 'recalc_party_membership') ]);

        // $this->middleware('admins', ['only' => array('recalc_party_membership')]);
        $this->middleware('admins', ['only' => array('mailgun') ]);
    }

    public function index() {

        //


    }

    public function userroles() {

        $usr = User::get();

        return View::make('admin.userroles', compact('usr'))->with('task', 'view')->with('itemkind', 'userroles');
    }

    public function dashboard_users() {

        $object = User::orderBy('created_at', 'desc')->get();

        return View::make('admin.dashboard_users', compact('object'))->with('task', 'view')->with('itemkind', 'users');
    }

    public function userroles_grant($user_id) {

        $rol = DB::table('roles')->pluck('name', 'id');
        $item = User::find($user_id);
        return View::make('admin.userroles_grant', compact('rol', 'item'))->with('task', 'view')->with('itemkind', 'stats');
    }

    public function userroles_store() {

        $input = Input::all();

        $date = new \DateTime;

        $excerpt_attrs = [
        'created_at' => $date,
        'updated_at' => $date];
        $excerpt_data = array_fill_keys(array_values(Input::get('Roles', [])), $excerpt_attrs);
        DB::transaction(function () use ($input, $excerpt_data) {

            $excerpt = User::find($input['id']);
            $excerpt->save();
            $excerpt->roles()->sync($excerpt_data);
        });

        $LastInsert = $input['id'];
        return Redirect::to('userroles/grant/' . $LastInsert);
    }

    public function userskills_grant($userid) {

        $ski = DB::table('skills')->pluck('name', 'id');
        $item = User::find($userid);

        return View::make('admin.userskills_grant', compact('ski', 'item'))->with('task', 'view')->with('itemkind', 'skills');
    }

    public function userskills_store() {

        $input = Input::all();

        $date = new \DateTime;

        $excerpt_attrs = [
        'created_at' => $date,
        'updated_at' => $date];
        $excerpt_data = array_fill_keys(array_values(Input::get('Skills', [])), $excerpt_attrs);
        DB::transaction(function () use ($input, $excerpt_data) {

            $excerpt = User::find($input['id']);
            $excerpt->save();
            $excerpt->skills()->sync($excerpt_data);
        });

        $LastInsert = $input['id'];
        return Redirect::to('volunteers');
    }

    public function recheck_wykop_related() {

        $object = Event::get();

        foreach ($object as $o) {

            // sprawdzenie, czy $o->confirmation_URL ma wykop
            // jeśli ma, to $wcheck = 1;
            if ($wcheck === 1) {

                // !!! weź URL wykopaliska  $wykopURL =
                //

                //check if this Related URL is alread submitted
                $related = Related::where('URL', $wykopURL)->where('item_id', $o->id)->where('itemkind', 'events')->first();

                if (!related) {
                    $related = new Related;
                    $related->item_id = $o->id;
                    $related->itemkind = 'events';
                    $related->URL = $wykopURL;
                    $related->name = 'dyskusja na Wykop.pl';
                    $related->save();
                }
            }
        }

        return Redirect::back();
    }

    public function resluggify($itemkind) {



        $itemtype = str_singular($itemkind);

        //getting Class name
        $class_name = ucfirst($itemtype);
        $name = "App\Models\\" . $class_name;
        $class = new $name;


        if (class_exists() && get_parent_class($class) == 'Illuminate\Database\Eloquent\Model') {
            $object = $class->get();
        }

        foreach ($object as $o) {
            $o->save();
        }

        return Redirect::back();
    }

    public function the_sejm() {

        // !!
        $zlodzieje_filename = 'wynik.csv';
         // TU MI POMÓŻ. Jak zmienić zawartość pliku do arraya, który da się wciągnąć do MySQL poniższym kodem, który zacząłem pisać?

        $csvconfig = new LexerConfig();
        $csvlexer = new Lexer($csvconfig);
        $csvinterpreter = new Interpreter();

        $interpreter->addObserver(function (array $zlodziej) {

            $new_entity = new Entity;

            $new_entity->name = $zlodziej[0];
             // nazwa zwyczajowa
            $new_entity->name_full = $zlodziej[0];
             // nazwa pełna

            // !! wyciągam nazwisko
            $surname = explode(' ', trim($zlodziej[0]));
            $new_entity->name_last = $surname[0];

            // $myvalue = 'Test me more';
            // $arr = explode(' ',trim($myvalue));
            // echo $arr[0]; // will print Test
            //
            // $words=str_word_count($myvalue, 1);
            // echo $words[0];

            // !! wyciągam imiona kasując nazwisko http://stackoverflow.com/a/6823177/4209866
            $new_entity->name_first = strstr($zlodziej[0], " ");

            $new_entity->descrption = 'Wykształcenie: ' . $zlodziej['wyksztalcenie'] . ', ukończone szkoły: ' . $zlodziej['ukonczone_szkoly'] . ', wykonywany zawód: ' . $zlodziej['zawod'];

            // to trzeba dokończyć, UGH!!!

            // - rok z daty urodzenia --> founding_year
            $new_entity->founding_year = mb_substr($zlodziej['data_miejsce_urodzenia'], 0, 4);

            $new_entity->descrption = '5';
             // to oznacza osobę fizyczną
            $new_entity->save();
            $LastInsert = $new_entity->id;

            //
            // **Entitystatus**
            $new_st = new Entitystatus;

            // !!
            $new_st->date_inception = $zlodziej[date_born];
            $new_st->save();

            // tabela pivot **entity_capacitytypes**
            //

            $new_capacity = new Entitycapacity;
            $new_capacity->entity_id = $LastInsert;
            $new_capacity->capacitytype_id = '2';
             // (tag opisujący postać jako posła)
            $new_capacity->save();

            $new_capacity = new Entitycapacity;
            $new_capacity->entity_id = $LastInsert;
            $new_capacity->capacitytype_id = '6';
             // (tag opisujący postać jako posła)
            $new_capacity->save();

            $new_capacity = new Entitycapacity;
            $new_capacity->entity_id = $LastInsert;
            $new_capacity->capacitytype_id = '17';
             // (tag opisujący postać jako posła)
            $new_capacity->save();

            // transakcja z pivot table entity_capacitytypes - dodać każdemu posłowi te capacities: poseł, polityk, poseł 7 kadencji, to odpowiednio 2,6 i 17
            //

            // **Related**
            $new_related = new Related;
            $new_related->itemkind = 'entities';
            $new_related->item_id = $LastInsert;

            // !!
            $new_related->URL = $zlodziej[URL];
             // !! STRONA W SEJM.GOV.PL Link do strony posła np. http://www.sejm.gov.pl/sejm7.nsf/posel.xsp?id=001&type=A

            $new_related->name = 'Profil posła w sejmie';
            $new_related->save();

            // -

            // **Entityrelation**  (table entity_entities) Dodajemy relację z partią, z której listy startował

            // Do modelu Entityrelation  tabela entity_entities
            $new_relation = new Entityrelation;

            $new_relation->entitychild_id = $LastInsert;

            // !!
            $new_relation->date_discovery = $zlodziej[date_election];
             //  Wybrany dnia: **09-10-2011** --> ta data powinna trafić do entity_entities.date_discovery (nie jest to data powstania relacji, ale "najwcześniejsza znana" - to wystarczy, żeby relacja zaczęła działać, a rzeczywistą datę dołączenia do partii to już użytkownicy-ochotnicy wrzucą na biegu, jak portal zacznie być używany przez szersze grono userów)

            // !!
            $new_relation->entityparent_id = $zlodziej[lista_ID];

            // - Lista: **Prawo i Sprawiedliwość** --> trzeba jakoś przekształcić nazwy partii,w tym i tch już nie istniejących na numery odpowiadające tym ugrupowaniom, a której już są w bazie.
            // JAK TO NAJLEPIEJ ZROBIć??
            // "Solidarność-80"
            // Konfederacja Polski Niepodległej
            // Kongres Liberalno-Demokratyczny
            // Liga Polskich Rodzin
            // NSZZ "Solidarność"
            // Partia Chrześcijańskich Demokratów
            // Platforma Obywatelska
            // Polska Partia Przyjaciół Piwa
            // Polski Związek Zachodni
            // Polskie Stronnictwo Ludowe
            // Porozumienie Obywatelskie Centrum
            // Prawo i Sprawiedliwość
            // Ruch Odbudowy Polski
            // Samoobrona
            // Samoobrona Rzeczpospolitej Polskiej
            // Sojusz Lewicy Demokratycznej
            // Unia Demokratyczna
            // Unia Polityki Realnej
            // Unia Pracy
            // Unia Wolności
            // Wielkopolska Unia Socjaldemokratyczna

            // ---> jeśli w innych rekordach jest cokolwiek innego, nie interesuje nas to, bo to tylko koalicje doraźne.

            $new_relation->entityparent_id = $parent;

            // !! - new field in CSV needed
            $new_relation->confirmation_URL = $zlodziej[URL];

            // - Link do strony posła np. http://www.sejm.gov.pl/sejm7.nsf/posel.xsp?id=001&type=A --> do .confirmation_URL

            $new_relation->save();
        });

        $csvlexer->parse($zlodzieje_filename, $csvinterpreter);

        // koniec!!!
        return Redirect::back();
    }

    public function storeChangelogEntry() {
    }

    public function view_stats() {
        $sitestats = Sitestat::orderBy('id', 'desc')->paginate(20);

        return View::make('admin.stats', compact('sitestats'))->with('task', 'view')->with('itemkind', 'stats');
    }

    public function generateStats() {

        $date = new \DateTime;

        // var_dump($date) ;
        $count_users = User::count();

        // var_dump($CountUsers) ;
        $count_events = Event::count();

        // var_dump($CountEvents) ;
        $count_questions = Question::count();
        $count_entities = Entity::count();
        $count_entityrelations = Entityrelation::count();
        $count_standpoints = Entitystandpoint::count();
        $count_topics = Topic::count();
        $count_widgets = Widget::count();
        $count_commodities = Commodity::count();
        $count_ingredients = Ingredient::count();
        $count_actions = Action::count();
        $count_exemplars = Exemplar::count();
        $count_taskgroups = Taskgroup::count();
        $count_tactics = Tactic::count();
        $count_counteractions = Counteraction::count();

        // dd($count_users);

        // DB::table('stats')->insert(array(
        //         'count_users' => $count_users,
        //         'count_events' => $count_events,
        //         'count_questions' => $count_questions,
        //         'count_entities' => $count_entities,
        //         'count_entityrelations' => $count_entityrelations,
        //         'count_standpoints' => $count_standpoints,
        //         'count_topics' => $count_topics,
        //         'count_widgets' => $count_widgets,
        //         'count_commodities' => $count_commodities,
        //         'count_ingredients' => $count_ingredients,
        //         'count_actions' => $count_actions,
        //         'count_exemplars' => $count_exemplars,
        //         'count_taskgroups' => $count_taskgroups,
        //         'count_tactics' => $count_tactics,
        //         'count_counteractions' => $count_counteractions,
        //         'created_at' => $date
        //     ));

        $newsitestat = new Sitestat;
        $newsitestat->count_users = $count_users;
        $newsitestat->count_events = $count_events;
        $newsitestat->count_questions = $count_questions;
        $newsitestat->count_entities = $count_entities;
        $newsitestat->count_entityrelations = $count_entityrelations;
        $newsitestat->count_standpoints = $count_standpoints;
        $newsitestat->count_topics = $count_topics;
        $newsitestat->count_widgets = $count_widgets;
        $newsitestat->count_commodities = $count_commodities;
        $newsitestat->count_ingredients = $count_ingredients;
        $newsitestat->count_actions = $count_actions;
        $newsitestat->count_exemplars = $count_exemplars;
        $newsitestat->count_taskgroups = $count_taskgroups;
        $newsitestat->count_tactics = $count_tactics;
        $newsitestat->count_counteractions = $count_counteractions;

        $newsitestat->save();
        $LastInsertId = $newsitestat->id;

        return Redirect::to('stats')->with('communique', 'Nowe statystyki wygenerowane!');
    }



    public function merge_duplicates($sourceid = null,$targetid = null) {

        $ent = array('' => 'Podmiot...') + Entity::orderBy('name', 'asc')->pluck('name', 'id')->all();

        $source = Entity::find($targetid);

        // finding duplicates to the parent:
        //
        // strip name of the text in brackets
        // http://stackoverflow.com/questions/1336672/php-remove-brackets-contents-from-a-string
        //
        $name_stripped = trim(preg_replace('/\s*\([^)]*\)/', '', $source->name));
        $dupl = Entity::where('name', 'LIKE', '%' . $name_stripped . '%')->get();
        $dup = Entity::where('name', 'LIKE', '%' . $name_stripped . '%')->pluck('name', 'id')->all();

        if ($dupl->count() == 1) {

            foreach ($dupl as $d) {

                $target = Entity::find($d->name);
            }
        }

        return View::make('admin.tools.merge_manager', compact('ent', 'source','sourceid', 'target', 'targetid', 'dup', 'dupl'))->with('task', 'merge')->with('itemkind', 'entities');
    }



    public function migrate_duplicates() {

        $input = Input::all();

        $target_id = $input['migration_target_id'];
        $source_id = $input['migration_source_id'];

        if ($target_id == '0' || $target_id == '' || $source_id == '0' || $source_id == '') {
            return 'wpisz docelowy podmiot';
        }

        // dd($target_id);
        // relations where source is the child

        if (isset($input['relations']) && $input['relations'] == 1) {

            $migrate1 = Entityrelation::where('entitychild_id', $source_id)->get();

            foreach ($migrate1 as $o) {

                $o->entitychild_id = $target_id;
                $o->save();
            }

            // relations where source is the parent

            $migrate2 = Entityrelation::where('entityparent_id', $source_id)->get();

            foreach ($migrate2 as $o) {

                $o->entityparent_id = $target_id;
                $o->save();
            }
        }

        // entitystandpoints
        if (isset($input['entitystandpoints']) && $input['entitystandpoints'] == 1) {

            $migrate3 = Entitystandpoint::where('entity_id', $source_id)->get();
            foreach ($migrate3 as $o) {
                $o->entity_id = $target_id;
                $o->save();
            }
        }

        // comments
        if (isset($input['comments']) && $input['comments'] == 1) {

            $migrate4 = Comment::where('commentable_type', 'entity')->where('commentable_id', $source_id)->get();
            $migrate4->commentable_id = $target_id;
            $migrate4->save();
        }

        // comments
        if (isset($input['relateds']) && $input['relateds'] == 1) {

            $migrate5 = Related::where('itemkind', 'entities')->where('item_id', $source_id)->get();
            $migrate5->item_id = $target_id;
            $migrate5->save();
        }

        //exemplarattitudes
        //userattitudes
        if (isset($input['attitudes']) && $input['attitudes'] == 1) {

            // TO DO !!!!!!!!!
            $migrate6 = Userattitude::where('item_type', 'entity')->where('item_id', $source_id)->get();
            $migrate6->item_id = $target_id;
            $migrate6->entity_id = $target_id;
            $migrate6->save();

            $migrate7 = Exemplarattitude::where('item_type', 'entity')->where('item_id', $source_id)->get();
            $migrate7->item_id = $target_id;
            $migrate7->entity_id = $target_id;
            $migrate7->save();
        }

        // TO DO !!!!!!!!!

        $ent = array('' => 'Podmiot...') + Entity::orderBy('name', 'asc')->pluck('name', 'id')->all();

        $target = Entity::find($target_id);
        $source = Entity::find($source_id);

        Session::flash('target', $target);
        Session::flash('source', $source);

        // dd($target);

        return redirect::to('merge_duplicates/' . $target_id);
    }

    public function dashboard_relations() {

        // $object = Entity::entitiesWithMultipleActivePartyMembership()->with('activePartyMembership')->paginate(30);
        $object = Entity::entitiesWithMultipleActivePartyMembership()->paginate(30);

        $capacities = Capacitytype::where('entities', '1')->get();

        return View::make('admin.dashboard_relations', compact('object', 'capacities'))->with('task', 'view')->with('itemkind', 'entities');
    }

    public function refine_relations($entityid = 'x') {

        $set_status = Input::get('set_status');

        $ent = array('' => 'Podmiot nadrzędny to...') + Entity::orderBy('name', 'asc')->pluck('name', 'id')->all();

        if ($entityid != 'x') {
            $object = Entity::find($entityid);

            if (isset($object) && $object->avatar == '') {
                $avatar = '_empty_entities.jpg';
            }
            else {
                $avatar = $object->avatar;
            }

            $children = Entityrelation::where('entityparent_id', $entityid)->paginate(50);
            $parents = Entityrelation::where('entitychild_id', $entityid)->get();

            if ($set_status != '' && Auth::check() && Auth::user()->is('Admin')) {

                foreach ($children as $o) {
                    $member_status = Entity::find($o->entitychild_id);
                    $member_status->status = $set_status;
                    $member_status->save();
                }
            }
        }

        $doubleactive = Entity::entitiesWithMultipleActivePartyMembership()->count();

        return View::make('admin.relations_refine', compact('object', 'ent', 'avatar', 'children', 'parents', 'doubleactive'))->with('itemkind', 'entities')->with('task', 'refine');
    }

    public function refine_relations_table($entityid = 'x') {

        if ($entityid != 'x') {
            $object = Entity::find($entityid);

            if (isset($object) && $object->avatar == '') {
                $avatar = '_empty_entities.jpg';
            }
            else {
                $avatar = $object->avatar;
            }
        }

        $children = Entityrelation::where('entityparent_id', $entityid)->get();
        $parents = Entityrelation::where('entitychild_id', $entityid)->get();

        return View::make('partials.refine_relations_table', compact('object', 'ent', 'children', 'parents', 'avatar'))->with('itemkind', 'entities')->with('task', 'refine');
    }

    public function recalc_party_membership($parent_party = 261) {

        // Tu tiket #433 It should use Wiki page http://pl.wikipedia.org/wiki/Kategoria:Dzia%C5%82acze_polskich_partii_politycznych
        // https://bitbucket.org/UnrulyNatives/niepozwalam/issue/433/wci-gni-cie-partii-i-polityk-w-cz-g-wna
        //
        // INTERESUJĄ NAS TUTAJ  TYLKO PARTIE i POLITYCY, którzy mają zdefiniowane pole wiki_URL.
        //
        //
        //
        // KROK 1: wyciągnąć partie z wpisaną wartością WIKI
        //
        // KROK 2: zidentyfikować ją z tą ze strony http://pl.wikipedia.org/wiki/Kategoria:Dzia%C5%82acze_polskich_partii_politycznych
        //
        // Krok 3: pozyskać listę polityków z WIKI oraz tą z NP
        // KROK 3a: jak jakichś nie ma w NP - w jakiś sposób ich wylistować
        //  Automatyczne dodanie do bazy zbyt kłopotliwe bo trzeba sprawdzić, czy nie ma podmiotu o tej samej nazwie, upewnić się, że zbieżność nieprzypadkowa. TO trzeba zrobić ręcznie chyba.
        //
        //
        // sprawdzić, czy relacja partia - polityk już jest
        //
        // sprawdzić, czy polityk jest też w innych partiach
        //
        // brakujące relacje stworzyć w modelu Entityrelations
        //
        // nie będą miały dat - ale to trudno - większość z nich pojawi się i tak z relacjami podwójnymi, których likwidowaniem zajmuje się oddzielny panel
        //
        // Dwa pakiety: https://github.com/sunra/php-simple-html-dom-parser
        // https://github.com/GrahamCampbell/Laravel-Parse
        //
        // Eksperymenty Petera

        // var carried in URL - its value must be the page with list of members of a party
        // for example:
        $choose_wiki_party = Input::get('choose_wiki_party');

        $test = HtmlDomParser::file_get_html('http://pl.wikipedia.org/wiki/Kategoria:Dzia%C5%82acze_polskich_partii_politycznych')->plaintext;

        $partie_ = HtmlDomParser::file_get_html('http://pl.wikipedia.org/wiki/Kategoria:Dzia%C5%82acze_polskich_partii_politycznych');

        $partia = HtmlDomParser::file_get_html($choose_wiki_party);

        $list_members = array();
        $parent_ = Entity::find($parent_party);

        $available_parties = Capacitytype::find(117)->entities()->with('basecountry')->orderBy('name', 'asc')->get();

        // START DRUKOWANIA:
        //
        //
        //
        $relation_OK = array();
        $relation_NOT = array();

        Session::flash('result', 'Funkcja w przygotowaniu');

        // return redirect::to('political_relations_dashboard')

        return View::make('admin.tools.relations_get_wiki_politicians', compact('object', 'type', 'emptywiki', 'capacity', 'test', 'html', 'partia', 'partie_', 'list_members', 'parent_', 'relation_OK', 'relation_NOT', 'available_parties', 'choose_wiki_party'))->with('task', 'index')->with('itemkind', 'entities');
    }




    public function suck_candidates_link_candidate_to_entity($candidate,$entity=null) {


            $update_c = Electoralcandidate::find($candidate);
            $update_c->entity_id = $entity;
            $update_c->save();


        if($entity != null) {


            $object = Entity::find($entity);

            // return "funkcja w budowie";
            return View::make('admin.partials.suck_in_candidates_perform', compact('object' ));
        }

        if($entity == null) {
            return "Rozłączyłeś kandydata i podmiot!";
        }
    }


    public function manage_entities_by_capacity($type = 1) {

        $emptywiki = Input::get('emptywiki');
        $capacity = Capacitytype::find($type);

        if ($emptywiki == '1') {

            Session::flash('result', 'Widzisz podmiot typu ' . $capacity->name . ', którym PILNIE trzeba uzupełnić adres Wikipedii');
            $object = Capacitytype::find($type)->entities()->with('basecountry')->orderBy('name', 'asc')->where('wiki_URL', null)->paginate(50);
        }
        else {
            $object = Capacitytype::find($type)->entities()->with('basecountry')->orderBy('name', 'asc')->paginate(50);
        }

        return View::make('admin.manage_entities_by_capacity', compact('object', 'type', 'emptywiki', 'capacity'))->with('task', 'index')->with('itemkind', 'entities');
    }



    public function dashboard_interfaces() {

        $task = "experiments";
        $title = "NiePozwalam -- USer Control Panel";

        $view = View::make('admin.dashboard_interfaces', compact('title', 'task'))->with('itemkind', 'experiments');

        return Response::make($view);
    }

    public function dashboard_moderator() {

        // $object = Action::leftJoin('user_attitudes', function($q){
        //                     $q->on('item_id', '=', 'actions.id');
        //                     $q->where('item_type', '=', 'action');
        //                 })
        //                ->selectRaw('actions.*, SUM(user_attitudes.importance) AS importance')
        //                ->groupBy('actions.id')
        //                ->orderBy('id', 'desc')
        //                ->paginate(30);
        $sitestats = Sitestat::remember('2048')->orderBy('id', 'desc')->first();

        $volunteers = Role::find(13)->users()->get();

        return View::make('admin.dashboard_moderator', compact('object', 'sitestats', 'volunteers'))->with('task', 'dashboard')->with('itemkind', 'admin');
    }

    public function dashboard_caretaker() {

        $exemplars = Caretaken::where('item_type', 'exemplar')->get();

        // $questions = DB::table('caretakens')->where('item_type','question')->get();
        $questions = Caretaken::where('item_type', 'question')->get();

        $object = Caretaken::get();
        $object_count = Caretaken::count();

        // $object = Caretaker::where('user_id', 5)->get();

        // dd($object);

        return View::make('admin.dashboard_caretaker', compact('exemplars', 'questions', 'object', 'object_count', 'sitestats', 'volunteers'))->with('task', 'dashboard')->with('itemkind', 'admin');
    }

    // for checking designated item's all pivoted models
    public function dashboard_items() {

        return View::make('admin.dashboard_items', compact('object', 'sitestats', 'volunteers'))->with('task', 'dashboard')->with('itemkind', 'admin');
    }


    // for checking designated item's all pivoted models
    public function items_relationmap($itemtype, $itemid = 261) {

        $object = Entity::find($itemid);

        return View::make('admin.dashboard_items_relationmap', compact('object', 'sitestats', 'volunteers'))->with('task', 'dashboard')->with('itemkind', 'admin');
    }

    public function relations_entity_conclude() {

        $capacity_id = '1';
        $capacity = Capacitytype::find($capacity_id);

        $object = Capacitytype::find($capacity_id)->entities()->with('basecountry')

        // ->where('wiki_URL','>',)
        ->orderBy('name', 'asc')->paginate(100);

        // this deletes an old problem with placeholders. Sorry
        foreach ($object as $o) {

            if ($o->inception_year = 'Rok założenia') $o->inception_year = null;
            $o->save();
        };

        foreach ($object as $o) {

            $cessation = $o->date_end_year;
            $cessation_confirm = $o->date_end_year;

            if ($cessation > 0) {
                echo $cessation . '- ok! -';
                foreach ($o->parentingEntities as $relation) {

                    // echo $relation->id.'<-członek   ';
                    if ($relation->date_end_year == null || $relation->date_end_year == '0') {
                        $relation->date_end_year = $cessation;
                    }

                    if ($relation->end_confirmation_URL == null || $relation->end_confirmation_URL == '0') {
                        $relation->end_confirmation_URL = $cessation_confirm;
                    }

                    $relation->save();
                }
            }
        }

        return View::make('admin.relations_entity_conclude', compact('object', 'capacity', 'volunteers'))->with('task', 'manage')->with('itemkind', 'admin');
    }


    // for checking designated item's all pivoted models
    public function manage_items_events_avatar() {

        // tiket #409

        // znajdź zdarzenia z tylko jednym standpointem

        // pobierz avatar uczestnika

        // jeśli avatar zdarzenia pusty, przepisz wartość pola avatar od uczestnika do zdarzenia

        return View::make('admin.dashboard_items', compact('object', 'sitestats', 'volunteers'))->with('task', 'dashboard')->with('itemkind', 'admin');
    }

    // for checking designated item's all pivoted models
    public function manage_items_sync_capacitytype($capacitytype = 1, $new = 6) {

        $synced = Capacitytype::find($capacitytype);

        $object = Capacitytype::find($capacitytype)->entities()->get();

        // does sync of a capacity. For instance if a 'party' is already set, it can add the 'political organization'
        return View::make('admin.items_sync_capacitytype', compact('object', 'capacitytype', 'new', 'synced'))->with('task', 'sync')->with('itemkind', 'admin');
    }




    // for checking designated item's all pivoted models
    public function replace_underscore_in_name($itemkind = 'entity',$changethis="_") {

        // $synced = Capacitytype::find($capacitytype);
        $changethis = "&#95;";

        $object = Entity::where('name', 'LIKE', '%\_%')->limit(300)->get();


        return View::make('admin.tools.replace_underscore_in_name', compact('object', 'capacitytype', 'new', 'synced'))->with('task', 'sync')->with('itemkind', 'admin');
    }



    // for checking designated item's all pivoted models
    public function perform_sync_capacitytype($capacitytype, $new) {

        $object = Capacitytype::find($capacitytype)->entities()->get();
        foreach ($object as $o) {

            $item = Entity::find($o->id);
            $date = new \DateTime;
            $capacity_attrs = ['creator_id' => Auth::check() ? Auth::user()->id : NULL, 'created_at' => $date, 'updater_id' => Auth::check() ? Auth::user()->id : NULL, 'updated_at' => $date,
            ];

            // $capacity_data = array_fill_keys(array_values($item->capacitytypes())), $capacity_attrs);

            DB::transaction(function () use ($item, $capacity_data) {
                $item->save();
                $item->capacities()->sync($capacity_data);
            });
        }

        // does sync of a capacity. For instance if a 'party' is already set, it can add the 'political organization'
        return View::make('admin.items_sync_capacitytype', compact('object', 'capacitytype', 'new', 'synced'))->with('task', 'sync')->with('itemkind', 'admin');
    }

    // for checking designated item's all pivoted models
    public function list_zeroed_timestamps($itemkind) {

        $updated_at = Input::get('updated_at');
        $created_at = Input::get('created_at');
        $perform = Input::get('perform');

        $date = new \DateTime;

        //phase 1 - fill updated_at

        if ($itemkind == 'events') {
            $object1 = Event::where('updated_at', '=', '0000-00-00 00:00:00')->get();
            $object2 = Event::where('created_at', '0000-00-00 00:00:00')->get();

            $object3 = Entitystandpoint::where('created_at', '0000-00-00 00:00:00')->get();
        }

        if ($itemkind == 'entitystandpoints') {
            $object1 = Entitystandpoint::where('updated_at', '=', '0000-00-00 00:00:00')->paginate(500);

            $object2 = Entitystandpoint::where('created_at', '0000-00-00 00:00:00')->paginate(500);

            $object3 = Entitystandpoint::where('created_at', '0000-00-00 00:00:00')->paginate(500);
        }

        if ($itemkind == 'entities') {
            $object1 = Entity::where('updated_at', '=', '0000-00-00 00:00:00')->paginate(500);
            $object2 = Entity::where('created_at', '0000-00-00 00:00:00')->paginate(500);

            $object3 = Entity::where('created_at', '0000-00-00 00:00:00')->paginate(500);
        }

        if ($itemkind == 'entityrelations') {
            $object1 = Entityrelation::where('updated_at', '=', '0000-00-00 00:00:00')->paginate(500);
            $object2 = Entityrelation::where('created_at', '0000-00-00 00:00:00')->paginate(500);

            $object3 = Entityrelation::where('created_at', '0000-00-00 00:00:00')->paginate(500);
        }

        if ($itemkind == 'counteractions') {
            $object1 = Counteraction::where('updated_at', '=', '0000-00-00 00:00:00')->paginate(500);
            $object2 = Counteraction::where('created_at', '0000-00-00 00:00:00')->paginate(500);
        }

        if ($itemkind == 'tactics') {
            $object1 = Tactic::where('updated_at', '=', '0000-00-00 00:00:00')->paginate(500);
            $object2 = Tactic::where('created_at', '0000-00-00 00:00:00')->paginate(500);
        }

        if ($itemkind == 'questions') {
            $object1 = Question::where('updated_at', '=', '0000-00-00 00:00:00')->paginate(500);
            $object2 = Question::where('created_at', '0000-00-00 00:00:00')->paginate(500);
        }

        if ($itemkind == 'topics') {
            $object1 = Topics::where('updated_at', '=', '0000-00-00 00:00:00')->paginate(500);
            $object2 = Topics::where('created_at', '0000-00-00 00:00:00')->paginate(500);
        }

        if ($itemkind == 'communiquetypes') {
            $object1 = Communiquetype::where('updated_at', '=', '0000-00-00 00:00:00')->paginate(500);
            $object2 = Communiquetype::where('created_at', '0000-00-00 00:00:00')->paginate(500);
        }

        if ($itemkind == 'communiques') {
            $object1 = Communique::where('updated_at', '=', '0000-00-00 00:00:00')->paginate(500);
            $object2 = Communique::where('created_at', '0000-00-00 00:00:00')->paginate(500);
        }

        if ($perform == 1) {

            foreach ($object1 as $o) {

                $o->updated_at = $date;
                $o->save();

                Session::flash('object1_modified', $object1->count());
            }

            foreach ($object2 as $o) {
                $o->created_at = $o->updated_at;
                $o->save();
            }

            Session::flash('object2_modified', $object2->count());
        }

        // does sync of a capacity. For instance if a 'party' is already set, it can add the 'political organization'
        return View::make('admin.items_list_zeroed_timestamps', compact('object3', 'object1', 'object2', 'capacitytype', 'new', 'synced', 'perform'))->with('task', 'sync')->with('itemkind', 'admin');
    }

    public function view_volunteers() {

        $role = Role::find(13);

        $volunteers = Role::find(13)->users()->get();

        // check for volunteers who have or declared skills, but have not assigned role!

        $missed_declaration = User::leftJoin('user_settings', function ($join) {
            $join->on('users.id', '=', 'user_settings.user_id');
        })->whereNotNull('skills')->get();

        $missed_skill_declaration = User::get();

        return View::make('admin.volunteers', compact('volunteers', 'role', 'missed_declaration', 'missed_skill_declaration'))->with('itemkind', 'users')->with('task', 'view');
    }

    public function reverify_role_assignment() {

        $role = Role::find(13);

        $volunteers = Role::find(13)->users()->get();

        return View::make('admin.volunteers', compact('volunteers', 'role'))->with('itemkind', 'users')->with('task', 'view');
    }

    public function manage_relations_verify_ceased_field() {

        $perform = Input::get('perform');

        $object = Entityrelation::where('date_end', '')->where('date_end_year', '')->where('end_confirmation_URL', '')->where('ceased', '!=', '0')->get();
        $active_count = Entityrelation::where('ceased', '!=', '1')->count();
        $ceased_count = Entityrelation::where('ceased', '=', '1')->count();

        return View::make('admin.manage_relations_verify_ceased_field', compact('perform', 'object', 'active_count', 'ceased_count'))->with('itemkind', 'users')->with('task', 'view');
    }

    // test of mailgun operation URL: /mailgun, available for Admin role only
    public function mailgun() {
        $rand_id = '96';
        $task = "experiments";
        $title = "NiePozwalam -- USer Control Panel";

        Mail::raw('Drugi mail POWINIEN BYć z eventu', function ($message) {
            $message->to('peter.gavagai@gmail.com');

            $message->subject('Mail testujący wysłany z widoku. ID=');
        });

        // Send email to Peter
        \Event::fire(new \App\Events\SendEmailWithFeedback());

        // $user = User::findOrFail(5);

        // Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
        //     $m->to($user->email, $user->name)->subject('Your Reminder!');
        // });

        $view = View::make('emails.test_status', compact('title', 'task'))->with('itemkind', 'experiments', 'message_content');

        return Response::make($view);
    }

    // test of mailgun operation URL: /mailgun, available for Admin role only
    public function dashboard_elaborate() {


        $view = View::make('admin.elaborate', compact('title', 'task'))->with('itemkind', 'experiments', 'message_content');

        return Response::make($view);
    }





    public function elaborate_object($itemkind, $id=null) {


            $itemtype = str_singular($itemkind);

            //getting Class name
            $class_name = ucfirst($itemtype);
            $name = "App\\Models\\" . $class_name;
            $class = new $name;


            if (class_exists($name) && get_parent_class($class) == 'Illuminate\Database\Eloquent\Model') {
                $object = $class->find($id);
            }


            return View::make($itemkind.'.elaborate', compact('perform', 'object', 'active_count', 'ceased_count'))->with('itemkind', $itemkind)->with('task', 'edit');
    }

}
