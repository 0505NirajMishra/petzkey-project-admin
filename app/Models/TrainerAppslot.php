<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainerAppslot extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $table = 'trainerappslots';
    protected $primaryKey = 'trainer_apt_slot_id';

    protected $fillable = [
        'trainer_mrg_slot',
        'trainer_evg_slot'
    ];

}