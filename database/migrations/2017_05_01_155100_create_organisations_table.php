<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->comment('Наименоввание для человека');
            $table->string('shortName')->comment('Короткое (народное) наименование')->nullable();
            $table->text('description')->comment('Описание организации')->nullable();
            $table->string('slug')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisations');
    }
}
