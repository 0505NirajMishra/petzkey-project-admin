<?php

namespace App\Services;

use App\Models\SallonSer;

use Illuminate\Support\Facades\DB;

class SallonService
{
     
    public static function create(array $data)
    {
        $data = SallonSer::create($data);
        return $data;
    }


    public static function update(array $data,SallonSer $sallonservice)
    {
        $data = $sallonservice->update($data);
        return $data;
    }

    
    public static function updateById(array $data, $id)
    {
        $data = SallonSer::whereId($id)->update($data);
        return $data;
    }


    public static function getById($id)
    {
        $data = SallonSer::find($id);
        return $data;
    }

   
    public static function delete(SallonSer $sallonservice)
    {
        $data = $sallonservice->delete();
        return $data;
    }


    public static function deleteById($id)
    {
        $data = SallonSer::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('sallonservicess')->orderBy('created_at','desc')->get();
        return $data;
    }

}