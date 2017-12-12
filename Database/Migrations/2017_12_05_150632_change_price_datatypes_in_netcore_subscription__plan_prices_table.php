<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePriceDatatypesInNetcoreSubscriptionPlanPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('netcore_subscription__plan_prices', function (Blueprint $table) {

            $table->decimal('monthly_price', 8, 2)
                  ->change();

            $table->decimal('original_price', 8, 2)
                  ->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('netcore_subscription__plan_prices', function (Blueprint $table) {

            $table->float('monthly_price', 4, 2)
                  ->change();

            $table->float('original_price', 4, 2)
                  ->change();

        });
    }
}
