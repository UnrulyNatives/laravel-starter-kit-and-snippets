<?php

namespace App\Helpers;

class DateHelper {

    public static function dateYmd($date) {
        if ($date) {
            $dt = new \DateTime($date);

          // return = $date;
          if(strtotime($date) == 0) {
              return 'No date set.';
          }
        return $dt->format("Y-m-d"); // 
      }
   }


    public static function dateDfh($date) {
        if ($date) {
            $dt = new \DateTime($date);

          // return = $date;
          if(strtotime($date) == 0) {
              return trans('messages.no_date_set');
          }

        return \Jenssegers\Date\Date::parse($date)->diffForHumans(); // diffForHumans
      }
   }
}

