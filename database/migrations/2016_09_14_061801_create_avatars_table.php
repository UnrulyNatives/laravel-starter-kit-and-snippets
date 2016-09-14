<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatars', function (Blueprint $table) {
            $table->increments('id');

            $table->string('item_type', 32);
            $table->integer('item_id')->unsigned();
            $table->string('avatar_pic', 32); 
            $table->string('avatar_copyright', 32); 
            $table->string('avatar_original_URL', 32); 
            $table->integer('creator_id')->unsigned()->index('creator_id');
            $table->timestamps();            
            $table->softDeletes();
            $table->string('status', 6)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avatars');
    }
}
