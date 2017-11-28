<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreSubscriptionPlanSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_subscription__plan_settings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('plan_id')
                  ->unsigned();

            $table->string('type');

            $table->string('key')
                  ->index();

            $table->string('value')
                  ->nullable();


            $table->foreign('plan_id', 'netcore_subscription__plan_settings_plan_foreign')
                  ->references('id')
                  ->on('netcore_subscription__plans')
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
        Schema::dropIfExists('netcore_subscription__settings');
    }
}
