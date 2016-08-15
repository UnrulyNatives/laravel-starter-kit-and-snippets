<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Features
 *
 * @author  The scaffold-interface created at 2016-08-15 09:55:54am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Features extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('features',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('name');
        
        $table->longText('description');
        
        $table->String('demonstration_URL');
        $table->integer('creator_id')->unsigned()->nullable();
        $table->integer('updater_id')->unsigned()->nullable();
        $table->timestamps();
        $table->softDeletes();
        $table->string('status', 6)->default('');
        $table->string('slug', 128)->nullable();          
        /**
         * Foreignkeys section
         */
        
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
        Schema::drop('features');
    }
}
