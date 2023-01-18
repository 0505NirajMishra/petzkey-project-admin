<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Doccapacitys extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'doctorcapacitys';
    protected $primaryKey = 'dr_apt_cap_id';

    protected $fillable = [
        'dr_apt_cap',
    ];
}