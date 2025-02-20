<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSTO extends Model
{
  use HasFactory;

  protected $table = 'report_sto';

  protected $fillable = [
    'issued_date',
    'inventory_id',
    'prepared_by',
    'checked_by',
    'status',
    'qty_per_box',
    'qty_box',
    'total',
    'grand_total'
  ];

  protected $casts = [
    'issued_date' => 'datetime',
  ];

  public function inventory()
  {
    return $this->belongsTo(Inventory::class, 'inventory_id', 'inventory_id');
  }

  public function preparer()
  {
    return $this->belongsTo(User::class, 'prepared_by');
  }

  public function checker()
  {
    return $this->belongsTo(User::class, 'prepared_by');
  }
}
