<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxiServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxi_services', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->comment('Описание службы');
            $table->string('phones',130)->comment('Номера телефонов');
            $table->decimal('priceGettingDay',5,2)->comment('Стоимость посадки днем')->nullable();
            $table->decimal('priceGettingNight',5,2)->comment('Стоимость посадки ночью')->nullable();
            $table->decimal('pricePerKmIncityDay',5,2)->comment('Стоимость проезда по городу днем')->nullable();
            $table->decimal('pricePerKmIncityNight',5,2)->comment('Стоимость проезда по городу ночью')->nullable();
            $table->decimal('pricePerKmOutcityDay',5,2)->comment('Стоимость проезда за городом днем')->nullable();
            $table->decimal('pricePerKmOutcityNight',5,2)->comment('Стоимость проезда за городом ночью')->nullable();
            $table->decimal('priceWaitPerMinute',5,2)->comment('Стоимость минуты ожидания')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxi_services');
    }
}
