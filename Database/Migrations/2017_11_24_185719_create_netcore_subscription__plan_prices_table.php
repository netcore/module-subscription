<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreSubscriptionPlanPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_subscription__plan_prices', function (Blueprint $table) {

            $table->increments('id');

            /*$table->integer('currency_id')
                  ->unsigned();*/

            $table->integer('plan_id')
                  ->unsigned();

            $table->integer('period_id')
                  ->unsigned();

            $table->float('monthly_price', 4, 2)
                  ->nullable();

            $table->timestamps();


            $this->setKeys($table);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('netcore_subscription__plan_prices');
    }

    /**
     * Set keys
     *
     * @param Blueprint $table
     */
    protected function setKeys(Blueprint $table)
    {

        $table->foreign('plan_id', 'netcore_subscription__plan_prices_plan_foreign')
              ->references('id')
              ->on('netcore_subscription__plans')
              ->onDelete('CASCADE');

        $table->foreign('period_id', 'netcore_subscription__plan_prices_period_foreign')
              ->references('id')
              ->on('netcore_subscription__periods')
              ->onDelete('CASCADE');

        /*$table->foreign('currency_id', 'netcore_subscription__plan_prices_currency_foreign')
              ->references('id')
              ->on('netcore_subscription__currencies')
              ->onDelete('CASCADE');*/

    }

}
