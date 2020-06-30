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
            $table->text('name');
            $table->date('date_performed');
            $table->string('phytosanitary_limitation');
            $table->integer('employees');
            $table->integer('dose');
            $table->integer('dose_type');
            $table->string('product')->nullable();
            $table->decimal('quantity')->nullable();
            $table->string('measure_type');
            $table->text('description')->nullable();
            $table->text('images')->nullable();
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
