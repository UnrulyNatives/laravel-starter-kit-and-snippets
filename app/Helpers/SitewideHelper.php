<?php

namespace App\Helpers;

use App\Models\Reminder;
use App\Models\Userattitude;
use App\Models\Entitystandpoint;
use App\Models\Usersetting;
use App\Models\Exemplar;
use App\Models\Source;
use App\User;
use DB;
use Auth;
use URL;

class SitewideHelper {

// just a hint:
// invoke a helper by 



    public static function getDomainName($url, $length=null) {
        $domain = parse_url($url, PHP_URL_HOST);
        return $domain;


   }

    //counts how many times an ntity was a publisher for event confirmation links
    public static function sourceCount($url) {
        $domain = parse_url($url, PHP_URL_HOST);

        $object = Source::where('website_URL', $domain)->first();
        if(!$object) {
          return '-';
        }
        return $object->counter;


   }

    public static function creatorAvatar($userid) {
        $user = User::find($userid);
        $hash = md5(strtolower($user->email));
        return "http://www.gravatar.com/avatar/$hash";


   }

    public static function creatorName($userid) {
        $user = User::find($userid);

        return $user->name;
      // return 'xx';

   }



    public static function setTopbar() {

      if(Auth::check()) {
          // L5.3 glitch
          $chosen_topbar = Auth::user()->settings->option_show_topbar_type;
          if(!isset($chosen_topbar)) {
            $chosen_topbar = request()->cookie('topbar') ? request()->cookie('topbar') : '2';
          }

      } else {
          $chosen_topbar = request()->cookie('topbar','2');
          if(!$chosen_topbar) {
            $chosen_topbar = request()->cookie('topbar') ? request()->cookie('topbar') : '2';
                  return $chosen_topbar;
                  return response();
                  // ->withCookie('topbar', $chosen_topbar, 10000);
          }
      }

      return $chosen_topbar;

      // return response();

   }

    public static function getActiveExemplar() {

            // $active_exemplar_id = request()->cookie('active_exemplar', '8');

            $active_exemplar_id = request()->cookie('active_exemplar') ? request()->cookie('active_exemplar') : '8';

            if(!$active_exemplar_id) {
              //create the active_exemplar cookie with value 8
              $active_exemplar_id = '8';
              // $active_exemplar->withCookie('active_exemplar', '11', 2628000);
            }

            $active_exemplar = Exemplar::find($active_exemplar_id);

      return $active_exemplar;

   }

    public static function cntRemindees($itemid, $importance) {

      $nonusers_alerted = Reminder::where('item_type','question')->where('item_id',$itemid)->where('importance',$importance)->count();
      return $nonusers_alerted;

   }


    public static function cntDoers($itemid, $importance) {

      $users_interested = Userattitude::where('item_type', 'question')->where('item_id', $itemid)->where('importance', $importance)->count();
      return $users_interested;

   }

    public static function className($itemkind,$output='class') {

      $classes = DB::table('model_names')->where('itemkind',$itemkind)->first();
      $output = $classes->$output;

      return $output;

   }

    public static function optionValue($option) {

      if (Auth::check()) {
        $object = Usersetting::where('user_id',Auth::id())->first();
        $valname = 'option_'.$option;
        $output = $object->$valname;
        return $output;
      } else {

      }


      // return $output;

   }

    public static function orgFramework($themename) {

      if ($themename == 'Seldon') {
        return "bootstrap";
      }
      if ($themename == 'Fawkes') {
        return "semantic";
      }

      return "semantic";


   }
    public static function optionSwitch($optionname) {


      return "<button data-load='" . URL::to('option_switch/'.$optionname) . "' id='os_111' data-puthere='#os_111' title='Przełączenie opcji ".$optionname."'>Switch option </button>";

      // return $output;

   }

   	// used in /sprawdz-spojnosc-wlasnych-pogladow (percept 09.07)
   	// sitewideHelper::listAttitudes('41', '5');
    public static function listAttitudes($questionid, $user) {


// zadanie: lista Userattitude wobec stanowisk postaci wyrażonych w konkretnym pytaniu 
// (Entitystandpoint where question_id = $questionid)
        $user_attitudes = Userattitude::join('entitystandpoints', function ($q) use($questionid,$user) {
            $q->where('user_attitudes.item_type', '=', 'entitystandpoint');
            $q->on('user_attitudes.item_id', '=', 'entitystandpoints.id');
            $q->where('entitystandpoints.question_id', '=', $questionid);
            $q->where('user_attitudes.creator_id','=', $user);
        })
        // ->select('questions.id AS id')
        ->select('user_attitudes.*')
        // ->selectRaw('SUM(user_attitudes.importance) AS importranking')
        // ->groupBy('questions.id')
        // ->orderBy('importranking', 'desc')
        ->get();

      return $user_attitudes;

   }


    public static function parseTitle($url) {
        $default = '(brak tytułu)';
        $req_headers = ["Accept-Language: en-US,en;q=0.8", "Accept-Charset: UTF-8,*;q=0.5"];
        $useragent = "Mozilla/5.0 (X11; Linux x86_64; rv:19.0) Gecko/20100101 Firefox/19.0 FirePHP/0.4";
        $timeout = 5;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $req_headers);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $headers = '';
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($ch, $h) use (&$headers) {
            $headers.= $h;
            return strlen($h);
        });
        $content = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($content === FALSE || $code >= 400) {
            return $default;
        }

        preg_match("/Content-Type:.*charset\s*=\s*(.*)[\s;]*/i", $headers, $enc);
        if (!isset($enc[1])) {
            preg_match('/<meta\s*http-equiv\s*=\s*"\s*content-type\s*"\s*content\s*=\s*".*;\s*charset\s*=\s*(.*?)\s*"\s*\/?>/i', $content, $enc);
        }
        if (!isset($enc[1])) {
            preg_match('/<meta\s*charset\s*=\s*"?\s*(.*?)\s*"?\s*\/?>/i', $content, $enc);
        }
        if (isset($enc[1])) {
            $pageenc = strtolower(trim($enc[1]));
            if ($pageenc !== 'utf-8') {
                $errh = set_error_handler(NULL);
                 // unfortunately.. is there a better way to stop laravel from throwing exceptions here when iconv has a problem?
                $content = @iconv($pageenc, 'utf-8', $content);
                set_error_handler($errh);
            }
        }

        preg_match("/<title.*?>\s*(.*?)\s*<\/title>/is", $content, $page_title);
        $page_title = isset($page_title[1]) ? $page_title[1] : $default;
        $page_title = preg_replace_callback("/(&#[0-9]+;)/", function($m) {
            return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
        }, $page_title); 
        $page_title = preg_replace('/\s+/', ' ', $page_title);
        return trim($page_title);
   }


    public static function listStandpoints($questionid, $user, $judged) {


// zadanie: lista Userattitude wobec stanowisk postaci wyrażonych w konkretnym pytaniu 
// (Entitystandpoint where question_id = $questionid)
        // $standpoints = Entitystandpoint::join('user_attitudes', function ($q) use($questionid,$user) {
        //     $q->where('user_attitudes.item_type', '=', 'entitystandpoint');
        //     $q->on('entitystandpoints.id', '=', 'user_attitudes.item_id');
        //     $q->where('entitystandpoints.question_id', '=', $questionid);
        //     $q->where('user_attitudes.creator_id','=', $user);
        //     $q->whereNull('user_attitudes.id');
        // })
        // // ->select('questions.id AS id')
        // ->select('user_attitudes.*')
        // // ->whereNull('user_attitudes.id')
        // // ->selectRaw('SUM(user_attitudes.importance) AS importranking')
        // // ->groupBy('questions.id')
        // // ->orderBy('importranking', 'desc')
        // ->count();


  // $standpoints = Userattitude::leftJoin('entitystandpoints', function ($q) use($questionid,$user) {
  //       $q->where('user_attitudes.item_type', '=', 'entitystandpoint');
  //       $q->on('user_attitudes.item_id', '=', 'entitystandpoints.id');
  //       $q->where('entitystandpoints.question_id', '=', $questionid);
  //       $q->where('user_attitudes.creator_id','=', $user);
  //   })
  //   ->whereNull('entitystandpoints.id')
  //   ->select('user_attitudes.*')
  //   ->get();






      // return $standpoints;

   }




}


            // if($judged=0) {
            //   // te standpointy, których user jeszcze nie ocenił

            // }
            // if($judged=1) {
            //   // standpointy, już ocenione
            // } else {
            //   // wszystkie standpointy dla tego pytania
            // }