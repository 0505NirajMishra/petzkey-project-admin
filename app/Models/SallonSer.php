<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SallonSer extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $table = 'sallonservicess';
    protected $primaryKey = 'sallon_servc_id';

    protected $fillable = [
        'pettype',
        'sallon_servc_name',
        'sallon_servc_img',
        'sallon_servc_pckgtyp',
        'cntr_fee',
        'home_fee',
    ];

}