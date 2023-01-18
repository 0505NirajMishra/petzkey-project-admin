<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAnAppointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'package_id',
        'consultant_id',
        'vat_no',
        'promocode',
        'promo_id',
        'status',
    ];
}
