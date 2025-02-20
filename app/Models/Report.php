<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural of the model name
    protected $table = 'reports';

    // Define the fillable attributes
    protected $fillable = [
        'part_name',
        'part_number',
        'inventory_id',
        'status_product',
        'qty_package',
        'qtybox',
        'total',
        'grand_total',
        'qty_package2',
        'qtybox2',
        'total2',
        'issue_date',
        'prepared_by',
        'checked_by',
        'detail_lokasi',
        'detail_lokasi2',
        'plant',
    ];
}