<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctors extends Model
{
    use HasFactory, SoftDeletes; 

    protected $table = 'doctors';
    protected $primaryKey = 'doctor_id';

    protected $fillable = [
        'doctor_image',
    ];

}