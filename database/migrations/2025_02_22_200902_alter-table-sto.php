<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::table('report_sto', function (Blueprint $table) {
      $table->string('checked_by')->nullable();

      $table->integer('qty_per_box_2')->nullable();
      $table->integer('qty_box_2')->nullable();
      $table->integer('total_2')->nullable();
    });
  }

  public function down()
  {
    Schema::table('report_sto', function (Blueprint $table) {
      $table->dropColumn('checked_by');

      $table->dropColumn(['qty_per_box_2', 'qty_box_2', 'total_2']);
    });
  }
};
