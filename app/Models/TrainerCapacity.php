<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainerCapacity extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $table = 'trainerapptcapacitys';
    protected $primaryKey = 'trainer_apt_cap_id';

    protected $fillable = [
        'trainer_apt_cap',
    ];

}