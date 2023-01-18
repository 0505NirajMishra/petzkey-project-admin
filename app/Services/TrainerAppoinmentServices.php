<?php

namespace App\Services;

use App\Models\TrainerAppoinment;

use Illuminate\Support\Facades\DB;

class TrainerAppoinmentServices
{
     
    public static function create(array $data)
    {
        $data = TrainerAppoinment::create($data);
        return $data;
    }


    public static function update(array $data,TrainerAppoinment $trainerappoinment)
    {
        $data = $trainerappoinment->update($data);
        return $data;
    }

    
    public static function updateById(array $data, $id)
    {
        $data = TrainerAppoinment::whereId($id)->update($data);
        return $data;
    }


    public static function getById($id)
    {
        $data = TrainerAppoinment::find($id);
        return $data;
    }

   
    public static function delete(TrainerAppoinment $trainerappoinment)
    {
        $data = $trainerappoinment->delete();
        return $data;
    }


    public static function deleteById($id)
    {
        $data = TrainerAppoinment::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('trainerappoinments')->orderBy('created_at','desc')->get();
        return $data;
    }

}