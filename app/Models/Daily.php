<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    use HasFactory;

    protected $table = 'inventory'; // Specify the table name

    protected $fillable = [
        'inventory_id', 'part_name', 'part_number', 'customer', 'min_stock', 'max_stock', 'actual_stock', 'status_product', 'lokasi', 'date'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'inventory_id');
    }
}