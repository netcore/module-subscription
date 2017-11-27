<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreSubscriptionPlanOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_subscription__options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->unique()->index();
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('netcore_subscription__option_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('option_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');

            $table->foreign('option_id', 'netcore_subscription__option_translations_foreign')
                  ->references('id')
                  ->on('netcore_subscription__options')
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
        Schema::dropIfExists('netcore_subscription__option_translations');
        Schema::dropIfExists('netcore_subscription__options');
    }
}
