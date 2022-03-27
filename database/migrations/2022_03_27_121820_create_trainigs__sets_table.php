<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainigsSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainigs__sets', function (Blueprint $table) {
            $table->id();

//            $table->foreign('training_id')->references('id')->on('trainings');
            $table->foreignId('training_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->tinyInteger('sort')->nullable();

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainigs__sets', function (Blueprint $table) {
            $table->dropForeign(['training_id']);
        });

        Schema::dropIfExists('trainigs__sets');
    }
}
