<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hostelavailbilty extends Model
{
    use HasFactory;

    protected $table = 'hostelavailbiltys';
    protected $primaryKey = 'hostel_avail_id';

    protected $fillable = [
        'opening_time',
        'closing_time',
    ];
}