<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->string('log_name')->nullable();
            $table->string('description');
            $table->integer('subject_id')->nullable();
            $table->string('subject_type')->nullable();
            $table->integer('causer_id')->nullable();
            $table->string('causer_type')->nullable();
            $table->text('properties')->nullable();

            $table->dropColumn('ip_address');
            $table->dropColumn('user_id');
            $table->dropColumn('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->dropColumn('log_name');
            $table->dropColumn('description');
            $table->dropColumn('subject_id');
            $table->dropColumn('subject_type');
            $table->dropColumn('causer_type');
            $table->dropColumn('causer_id');
            $table->dropColumn('causer_type');
            $table->dropColumn('properties');

            $table->integer('user_id')->nullable();
            $table->string('text');
            $table->string('ip_address', 64);            
        });
    }
}
