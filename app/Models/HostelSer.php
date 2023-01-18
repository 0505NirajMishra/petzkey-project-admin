<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HostelSer extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $table = 'hostelsers';
    protected $primaryKey = 'hostel_servc_id';

    protected $fillable = [
        'pettype',
        'hrs_fee',
        'day_fee',
        'hos_seat',
        'desc'
    ];

}