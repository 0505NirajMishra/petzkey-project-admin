<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hostelservice extends Model
{
    use HasFactory, SoftDeletes; 

    protected $table = 'companyservices';
    protected $primaryKey = 'cmpny_dtls_id';

    protected $fillable = [
        'company_name',
        'company_lic_no',
        'company_licence_photo',
        'company_work_photo',
        'company_image_logo',
        'company_location',
        'company_address',
        'company_map_location',
        'company_aboutus'
    ];

}