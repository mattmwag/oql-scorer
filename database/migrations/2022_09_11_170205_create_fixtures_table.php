<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('round');
            $table->unsignedSmallInteger('team_one_id');
            $table->unsignedSmallInteger('team_two_id')->nullable();
            $table->unsignedSmallInteger('team_one_score')->nullable();
            $table->unsignedSmallInteger('team_two_score')->nullable();
            $table->unsignedSmallInteger('t1p1_id')->nullable();
            $table->unsignedSmallInteger('t1p2_id')->nullable();
            $table->unsignedSmallInteger('t1p3_id')->nullable();
            $table->unsignedSmallInteger('t1p4_id')->nullable();
            $table->unsignedSmallInteger('t2p1_id')->nullable();
            $table->unsignedSmallInteger('t2p2_id')->nullable();
            $table->unsignedSmallInteger('t2p3_id')->nullable();
            $table->unsignedSmallInteger('t2p4_id')->nullable();
            $table->unsignedSmallInteger('t1p1_score')->nullable();
            $table->unsignedSmallInteger('t1p2_score')->nullable();
            $table->unsignedSmallInteger('t1p3_score')->nullable();
            $table->unsignedSmallInteger('t1p4_score')->nullable();
            $table->unsignedSmallInteger('t2p1_score')->nullable();
            $table->unsignedSmallInteger('t2p2_score')->nullable();
            $table->unsignedSmallInteger('t2p3_score')->nullable();
            $table->unsignedSmallInteger('t2p4_score')->nullable();
            $table->smallInteger('t1p1_negs')->nullable();
            $table->smallInteger('t1p2_negs')->nullable();
            $table->smallInteger('t1p3_negs')->nullable();
            $table->smallInteger('t1p4_negs')->nullable();
            $table->smallInteger('t2p1_negs')->nullable();
            $table->smallInteger('t2p2_negs')->nullable();
            $table->smallInteger('t2p3_negs')->nullable();
            $table->smallInteger('t2p4_negs')->nullable();
            $table->text('history')->nullable();
            $table->unsignedTinyInteger('t1result')->nullable();
            $table->unsignedTinyInteger('t2result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixtures');
    }
};
