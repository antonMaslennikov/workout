<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrainingsResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings__results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('training_activitie_id')
                ->constrained('trainings__activities')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->tinyInteger('repeats')->nullable();
            $table->float('weight')->nullable();

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
        //
    }
}
