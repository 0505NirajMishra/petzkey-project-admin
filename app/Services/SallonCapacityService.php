<?php

namespace App\Services;

use App\Models\SallonCapacity;

use Illuminate\Support\Facades\DB;

class SallonCapacityService
{
     
    public static function create(array $data)
    {
        $data = SallonCapacity::create($data);
        return $data;
    }


    public static function update(array $data,SallonCapacity $sallonapptcapacity)
    {
        $data = $sallonapptcapacity->update($data);
        return $data;
    }

    
    public static function updateById(array $data, $id)
    {
        $data = SallonCapacity::whereId($id)->update($data);
        return $data;
    }

    public static function getById($id)
    {
        $data = SallonCapacity::find($id);
        return $data;
    }

    public static function delete(SallonCapacity $sallonapptcapacity)
    {
        $data = $sallonapptcapacity->delete();
        return $data;
    }

    public static function deleteById($id)
    {
        $data = SallonCapacity::whereId($id)->delete();
        return $data;
    }

    public static function datatable()
    {
        $data = DB::table('sallonapptcapacitys')->orderBy('created_at','desc')->get();
        return $data;
    }

}