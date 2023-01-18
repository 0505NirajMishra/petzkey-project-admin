<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Petdetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'petdetails';
    protected $primaryKey = 'pet_id';

    protected $fillable = [
        'pet_type',
        'pet_breed',
        'pet_gender',
        'pet_year',
        'pet_month',
        'pet_height',
        'pet_weight',
        'pet_image'
    ];
}
