<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreSubscriptionSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_subscription__subscriptions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')
                  ->unsigned();

            $table->integer('plan_id')
                  ->usigned();

            $table->boolean('is_paid')
                  ->default(false);

            $table->timestamps();

            $table->timestamp('expires_at')
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
        Schema::dropIfExists('netcore_subscription__subscriptions');
    }
}
