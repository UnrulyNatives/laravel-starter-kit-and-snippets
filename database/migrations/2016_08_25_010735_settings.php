<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Settings
 *
 * @author  The scaffold-interface created at 2016-08-25 01:07:35am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Settings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('settings',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('name');
        
        $table->longText('description');
        
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
        Schema::drop('settings');
    }
}
