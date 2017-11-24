<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanPricesTable extends Migration
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

            $table->integer('plan_id')
                  ->unsigned();

            $table->enum('period', [
                'montly', 'quarterly', 'semi-annually', 'annually'
            ]);

            $table->float('monthly_price', 4, 2);

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

        $table->foreign('plan_id', 'netcore_subscription__plan_prices_foreign')
              ->references('id')
              ->on('netcore_subscription__plans')
              ->onDelete('CASCADE');

    }

}
