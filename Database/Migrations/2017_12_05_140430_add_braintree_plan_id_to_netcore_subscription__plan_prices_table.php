<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBraintreePlanIdToNetcoreSubscriptionPlanPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('netcore_subscription__plan_prices', function (Blueprint $table) {

            $table->string('braintree_plan_id')
                  ->after('original_price')
                  ->index()
                  ->nullable();

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

            $table->dropIndex(['braintree_plan_id']);
            $table->dropColumn('braintree_plan_id');

        });
    }
}
