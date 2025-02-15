<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory'; // Specify the table name

    protected $fillable = [
        'inventory_id',
        'part_name',
        'part_number',
        'type_package',
        'qty_package',
        'project',
        'customer',
        'detail_lokasi',
        'satuan',
        'stok_awal',
        'plant',
        'status_product', // Add this line
    ];
}