<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctorappoinments extends Model
{
    use HasFactory;

    protected $table = 'doctorappoinments';
    protected $primaryKey = 'appt_id';

    protected $fillable = [
        'appt_date_time',
        'book_date_time',
        'progress_status',
        'payment'
    ];
}