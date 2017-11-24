<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreSubscriptionOptionplanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_subscription__option_plan', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('option_id')
                  ->unsigned();

            $table->integer('plan_id')
                  ->unsigned();


            $table->foreign('option_id', 'netcore_subscription__option_plan_option_id')
                  ->references('id')
                  ->on('netcore_subscription__options')
                  ->onDelete('CASCADE');

            $table->foreign('plan_id', 'netcore_subscription__option_plan_plan_id')
                  ->references('id')
                  ->on('netcore_subscription__plans')
                  ->onDelete('CASCADE');

        });

        Schema::create('netcore_subscription__option_plan_translations', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('option_plan_id')
                  ->unsigned();

            $table->string('locale')
                  ->index('netcore_subscription__option_plan_translations_locale');

            $table->string('value');


            $table->foreign('option_plan_id', 'netcore_subscription__option_plan_translations_foreign')
                  ->references('id')
                  ->on('netcore_subscription__option_plan')
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
        Schema::dropIfExists('netcore_subscription__option_plan_translations');
        Schema::dropIfExists('netcore_subscription__option_plan');
    }

}
