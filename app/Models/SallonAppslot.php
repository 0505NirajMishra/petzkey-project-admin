<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SallonAppslot extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $table = 'sallonaptslots';
    protected $primaryKey = 'sallon_apt_slot_id';

    protected $fillable = [
        'sallon_mrg_slot',
        'sallon_evg_slot'
    ];

}