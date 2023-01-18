<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Userservice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'userservices';
    protected $primaryKey = 'servicetype_id';

    protected $fillable = [
        'service_name',
    ];
}