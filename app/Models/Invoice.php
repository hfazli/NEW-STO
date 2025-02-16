<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'inv_id',
        'part_name',
        'part_no',
        'unit_price'
    ];

    // Add any relationships, accessors, or mutators here if needed
}