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
                  ->unsigned();

            $table->boolean('is_paid')
                  ->default(false);

            $table->timestamps();

            $table->timestamp('expires_at')
                  ->nullable();


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
        Schema::dropIfExists('netcore_subscription__subscriptions');
    }

    /**
     * Set keys
     *
     * @param Blueprint $table
     */
    protected function setKeys(Blueprint $table)
    {
        $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('CASCADE');

        $table->foreign('plan_id', 'netcore_subscription__subscriptions_plan_foreign')
              ->references('id')
              ->on('netcore_subscription__plans')
              ->onDelete('CASCADE');
    }
}
