<?php

namespace App\Services;

use App\Models\TrainerCapacity;

use Illuminate\Support\Facades\DB;

class TrainerCapacityService
{
     
    public static function create(array $data)
    {
        $data = TrainerCapacity::create($data);
        return $data;
    }

   

    public static function update(array $data,TrainerCapacity $trainercapacity)
    {
        $data = $trainercapacity->update($data);
        return $data;
    }

    
    public static function updateById(array $data, $id)
    {
        $data = TrainerCapacity::whereId($id)->update($data);
        return $data;
    }


    public static function getById($id)
    {
        $data = TrainerCapacity::find($id);
        return $data;
    }

   
    public static function delete(TrainerCapacity $trainercapacity)
    {
        $data = $trainercapacity->delete();
        return $data;
    }


    public static function deleteById($id)
    {
        $data = TrainerCapacity::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('trainerapptcapacitys')->orderBy('created_at','desc')->get();
        return $data;
    }

}