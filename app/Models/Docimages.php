<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Docimages extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'doctorclinicimages';
    protected $primaryKey = 'clinic_img_id';

    protected $fillable = [
        'clinic_img',
    ];
}