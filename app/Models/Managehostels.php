<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Managehostels extends Model
{
    use HasFactory, SoftDeletes; 

    protected $table = 'managehostelservice';
    protected $primaryKey = 'pet_id';

    protected $fillable = [
        'opening_time',
        'closing_time',
        'pet_type',
        'pet_per_hour',
        'pet_per_day',
        'pet_seat',
        'pet_desc',
        'pet_image',
    ];

}