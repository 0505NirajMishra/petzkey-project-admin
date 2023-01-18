<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctoravailbilty extends Model
{
    use HasFactory;

    protected $table = 'doctoravailbiltys';
    protected $primaryKey = 'doctor_avail_id';

    protected $fillable = [
        'avail_days',
        'ms_opening_time',
        'ms_closing_time',
        'es_opening_time',
        'es_closing_time',
    ];
}