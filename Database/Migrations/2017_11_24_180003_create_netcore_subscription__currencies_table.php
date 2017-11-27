<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreSubscriptionCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_subscription__currencies', function (Blueprint $table) {
            $table->increments('id');

            $table->string('key')
                  ->index();
            $table->string('symbol');

        });

        Schema::create('netcore_subscription__currency_translations', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('currency_id')
                  ->unsigned();

            $table->string('locale');

            $table->string('name')
                  ->nullable();

            $table->foreign('currency_id', 'netcore_subscription__currencies_foreign')
                ->references('id')
                ->on('netcore_subscription__currencies')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('netcore_subscription__currency_translations');
        Schema::dropIfExists('netcore_subscription__currencies');
    }
}
