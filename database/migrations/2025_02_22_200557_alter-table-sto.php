<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('report_sto', function (Blueprint $table) {
      $table->dropForeign(['checked_by']);
      $table->dropColumn('checked_by');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('report_sto', function (Blueprint $table) {
      $table->foreignId('checked_by')->constrained('users')->onDelete('cascade');
    });
  }
};
