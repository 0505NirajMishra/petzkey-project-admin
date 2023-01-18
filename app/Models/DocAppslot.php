<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DocAppslot extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'doctoraptslots';
    protected $primaryKey = 'dr_apt_slot_td';

    protected $fillable = [
        'dr_mrg_slot',
        'dr_evg_slot'
    ];
}