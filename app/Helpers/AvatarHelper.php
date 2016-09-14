<?php
namespace Unrulynatives\Helpers;

use App\User;

class AvatarHelper {

    public static function dispAvatar($itemkind,$string=null) {
        if ($string == '') {
            $avatar = '_empty_'.$itemkind.'.jpg';

           
      } else {
        $avatar = $string;
      }

       return $avatar; 
   }




    public static function userAvatar($userid) {
        if($userid == '') {
          return '';
        }
        $user = User::find($userid);
        $hash = md5(strtolower($user->email));
        return "http://www.gravatar.com/avatar/$hash";
      // return 'xx';

   }

}

