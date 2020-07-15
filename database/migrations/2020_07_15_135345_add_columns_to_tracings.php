<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTracings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tracings', function (Blueprint $table) {
          $table->string('latitude')->nullable()->after('phone');
          $table->string('longitude')->nullable()->after('latitude');
          $table->string('altitude')->nullable()->after('longitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tracings', function (Blueprint $table) {
          $table->dropColumn('latitude');
          $table->dropColumn('longitude');
          $table->dropColumn('altitude');
        });
    }
}
