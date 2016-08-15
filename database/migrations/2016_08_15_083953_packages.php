<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Packages
 *
 * @author  The scaffold-interface created at 2016-08-15 08:39:53am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Packages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('packages',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('name',180);
        
        $table->longText('description');
        $table->String('description_does_what')->default('-');
        
        $table->String('string_composer',180);
        $table->String('dashboard_URL',180)->default('');
        $table->String('github_URL',180)->default('');
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
        Schema::drop('packages');
    }
}
