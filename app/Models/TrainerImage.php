<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainerImage extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $table = 'trainerimages';
    protected $primaryKey = 'trainer_img_id';

    protected $fillable = [
        'trainer_image',
    ];

}