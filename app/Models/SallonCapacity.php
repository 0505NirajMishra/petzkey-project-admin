<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SallonCapacity extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $table = 'sallonapptcapacitys';
    protected $primaryKey = 'sallon_apt_cap_id';

    protected $fillable = [
        'sallon_apt_cap',
    ];

}