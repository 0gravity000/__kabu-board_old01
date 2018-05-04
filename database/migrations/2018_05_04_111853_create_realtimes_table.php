<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealtimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realtimes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('code');
            $table->string('name');
            $table->string('market');
            $table->integer('marketcode');
            $table->integer('value')->nullable();
            $table->integer('pre_value')->nullable();
            $table->integer('uppervalue')->nullable();
            $table->dateTime('uv_updateat')->nullable();
            $table->integer('lowervalue')->nullable();
            $table->dateTime('lv_updateat')->nullable();
            $table->integer('upperlimit')->nullable();
            $table->dateTime('ul_setat')->nullable();
            $table->integer('lowerlimit')->nullable();
            $table->dateTime('ll_setat')->nullable();
            $table->float('changerate')->nullable();
            $table->float('pre_changerate')->nullable();
            $table->integer('changecount')->nullable();
            $table->float('changerate_range')->nullable();
            $table->dateTime('cr_setat')->nullable();
            $table->boolean('sendflag');
            $table->boolean('sendflag_changerate');
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
        Schema::dropIfExists('realtimes');
    }
}
