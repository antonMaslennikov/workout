<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainigsActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings__activities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('set_id');
            $table->foreign('set_id')
                ->references('id')
                ->on('trainings__sets')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('activitie_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->tinyInteger('quantity')->default(0);

            $table->tinyText('comment')->nullable();

            $table->boolean('complited')->default(0)->nullable();

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
        Schema::table('trainings__activities', function (Blueprint $table) {
            $table->dropForeign(['set_id']);
            $table->dropForeign(['activitie_id']);
        });

        Schema::dropIfExists('trainings__activities');
    }
}
