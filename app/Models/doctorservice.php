<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctorservice extends Model
{
    use HasFactory; 

    protected $table = 'doctorservices';
    protected $primaryKey = 'doctor_servc_id';

    protected $fillable = [
        'pettype',
        'clinic_fee',
        'home_fee',
        'desc'
    ];

}
