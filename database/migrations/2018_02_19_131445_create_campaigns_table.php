<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('template_id')->unsigned()->nullable();
            $table->integer('bunch_id')->unsigned()->nullable();
            $table->integer('created_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('template_id')->references('id')->on('templates');
            $table->foreign('bunch_id')->references('id')->on('bunches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
