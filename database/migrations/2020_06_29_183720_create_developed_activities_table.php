<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopedActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developed_activities', function (Blueprint $table) {
            $table->id();
            $table->date('date_performed');
            $table->string('phytosanitary_limitation')->nullable();
            $table->integer('employees');
            $table->decimal('dose', 8,2)->nullable();
            $table->string('dose_type')->nullable();
            $table->string('product')->nullable();
            $table->decimal('quantity', 8,2)->nullable();
            $table->string('measure_type')->nullable();
            $table->text('description');
            $table->string('metod')->nullable();
            $table->foreignId('tracing_id')->constrained()->cascadeOnDelete();
            $table->foreignId('activity_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('developed_activities');
    }
}
