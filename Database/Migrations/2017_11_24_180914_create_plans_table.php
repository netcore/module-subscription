<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_subscription__plans', function (Blueprint $table) {

            $table->increments('id');

            $table->string('key')
                  ->index();

            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('netcore_subscription__plan_translations', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('plan_id')
                  ->unsigned();

            $table->string('locale')
                  ->index();

            $table->string('name');


            $table->foreign('plan_id', 'netcore_subscription__plan_translations_foreign')
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
        Schema::dropIfExists('netcore_subscription__plan_translations');
        Schema::dropIfExists('netcore_subscription__plans');
    }

}
