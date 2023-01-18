<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HostelProfile extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $table = 'hostelprofiles';

    protected $primaryKey = 'hostle_img_id';


    protected $fillable = [
        'hostel_image',
    ];

}