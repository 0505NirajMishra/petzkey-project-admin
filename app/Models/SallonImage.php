<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SallonImage extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $table = 'sallonimages';
    protected $primaryKey = 'sallon_img_id';

    protected $fillable = [
        'sallon_img',
    ];

}