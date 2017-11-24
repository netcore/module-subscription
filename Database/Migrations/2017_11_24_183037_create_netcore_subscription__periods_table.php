<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreSubscriptionPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_subscription__periods', function (Blueprint $table) {
            $table->increments('id');

            $table->string('key');

            $table->integer('days')
                  ->unsigned();

        });

        Schema::create('netcore_subscription__period_translations', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('period_id')
                  ->unsigned();

            $table->string('locale')
                  ->index();

            $table->string('name');

            $table->foreign('period_id', 'netcore_subscription__period_translations_foreign')
                  ->references('id')
                  ->on('netcore_subscription__periods')
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
        Schema::dropIfExists('netcore_subscription__period_translations');
        Schema::dropIfExists('netcore_subscription__periods');
    }
}
