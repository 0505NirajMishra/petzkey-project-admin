<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SallonAppoinment extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $table = 'sallonappoinments';
    protected $primaryKey = 'appt_id';

    protected $fillable = [
        'appt_date_time',
        'book_date_time',
        'progress_status',
        'payment'
    ];

}