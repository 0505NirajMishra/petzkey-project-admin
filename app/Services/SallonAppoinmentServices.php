<?php

namespace App\Services;

use App\Models\SallonAppoinment;

use Illuminate\Support\Facades\DB;

class SallonAppoinmentServices
{
     
    public static function create(array $data)
    {
        $data = SallonAppoinment::create($data);
        return $data;
    }


    public static function update(array $data,SallonAppoinment $sallonappionment)
    {
        $data = $sallonappionment->update($data);
        return $data;
    }

    
    public static function updateById(array $data, $id)
    {
        $data = SallonAppoinment::whereId($id)->update($data);
        return $data;
    }


    public static function getById($id)
    {
        $data = SallonAppoinment::find($id);
        return $data;
    }

   
    public static function delete(SallonAppoinment $sallonappionment)
    {
        $data = $sallonappionment->delete();
        return $data;
    }


    public static function deleteById($id)
    {
        $data = SallonAppoinment::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('sallonappoinments')->orderBy('created_at','desc')->get();
        return $data;
    }

}