<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainerSer extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $table = 'trainerservices';
    protected $primaryKey = 'trainer_servc_id';

    protected $fillable = [
        'pettype',
        'trainer_servc_name',
        'trainer_servc_img',
        'trainer_servc_packagetype',
        'cntr_fees',
        'home_fees',
    ];

}