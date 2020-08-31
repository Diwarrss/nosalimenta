<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDevelopedActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developed_activities', function (Blueprint $table) {
          $table->integer('land_tenure')->nullable()->after('technical_visit');
          $table->integer('total_area')->nullable()->after('land_tenure');
          $table->integer('condition')->nullable()->after('total_area');
          $table->decimal('score')->nullable()->after('condition');
          $table->string('family_nucleus')->nullable()->after('score');
          $table->date('approximate_date')->nullable()->after('family_nucleus');
          $table->string('projected_amount')->nullable()->after('approximate_date');
          $table->text('potential_buyers')->nullable()->after('projected_amount');
          $table->integer('sown_area')->nullable()->after('potential_buyers');
          $table->integer('costs')->nullable()->after('sown_area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developed_activities', function (Blueprint $table) {
          $table->dropColumn('land_tenure');
          $table->dropColumn('total_area');
          $table->dropColumn('condition');
          $table->dropColumn('score');
          $table->dropColumn('family_nucleus');
          $table->dropColumn('approximate_date');
          $table->dropColumn('projected_amount');
          $table->dropColumn('potential_buyers');
          $table->dropColumn('sown_area');
          $table->dropColumn('costs');
        });
    }
}
