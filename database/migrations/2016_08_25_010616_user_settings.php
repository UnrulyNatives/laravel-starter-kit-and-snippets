<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class User_settings
 *
 * @author  The scaffold-interface created at 2016-08-25 01:06:16am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class UserSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('user_settings',function (Blueprint $table){

        $table->increments('id');
        
        $table->integer('user_id');
        
        $table->String('setting_id');
        
        $table->longText('notes');
        
        /**
         * Foreignkeys section
         */
        
        
        $table->timestamps();
        
        
        $table->softDeletes();
        
        // type your addition here

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('user_settings');
    }
}
