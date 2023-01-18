<?php

namespace App\Services;

use App\Models\TrainerAppslot;

use Illuminate\Support\Facades\DB;

class TrainerApptslotService
{
     
    public static function create(array $data)
    {
        $data = TrainerAppslot::create($data);
        return $data;
    }

   

    public static function update(array $data,TrainerAppslot $trainerappslot)
    {
        $data = $trainerappslot->update($data);
        return $data;
    }

    
    public static function updateById(array $data, $id)
    {
        $data = TrainerAppslot::whereId($id)->update($data);
        return $data;
    }


    public static function getById($id)
    {
        $data = TrainerAppslot::find($id);
        return $data;
    }

   
    public static function delete(TrainerAppslot $trainerappslot)
    {
        $data = $trainerappslot->delete();
        return $data;
    }


    public static function deleteById($id)
    {
        $data = TrainerAppslot::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('trainerappslots')->orderBy('created_at','desc')->get();
        return $data;
    }

}