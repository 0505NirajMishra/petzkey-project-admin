<?php

namespace App\Services;

use App\Models\SallonAppslot;

use Illuminate\Support\Facades\DB;

class SallonApptslotService
{
     
    public static function create(array $data)
    {
        $data = SallonAppslot::create($data);
        return $data;
    }

    public static function update(array $data,SallonAppslot $sallonappslot)
    {
        $data = $sallonappslot->update($data);
        return $data;
    }

    
    public static function updateById(array $data, $id)
    {
        $data = SallonAppslot::whereId($id)->update($data);
        return $data;
    }


    public static function getById($id)
    {
        $data = SallonAppslot::find($id);
        return $data;
    }

   
    public static function delete(SallonAppslot $sallonappslot)
    {
        $data = $sallonappslot->delete();
        return $data;
    }


    public static function deleteById($id)
    {
        $data = SallonAppslot::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('sallonaptslots')->orderBy('created_at','desc')->get();
        return $data;
    }

}