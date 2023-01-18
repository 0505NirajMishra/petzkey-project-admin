<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctorspeciality extends Model
{
    use HasFactory; 

    protected $table = 'doctorspecialitys';
    protected $primaryKey = 'dr_spclty_id';

    protected $fillable = [
        'dr_spclty_name',
    ];

}
