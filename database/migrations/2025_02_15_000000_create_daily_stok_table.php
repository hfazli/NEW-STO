<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyStokTable extends Migration
{
    public function up()
    {
        Schema::create('daily_stok', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_id')->unique();
            $table->string('part_name');
            $table->string('part_number');
            $table->string('customer');
            $table->integer('min_stock');
            $table->integer('max_stock');
            $table->integer('actual_stock');
            $table->string('status_product');
            $table->string('lokasi');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_stok');
    }
}