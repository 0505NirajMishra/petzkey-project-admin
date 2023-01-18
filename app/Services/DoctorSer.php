<?php

namespace App\Services;

use App\Models\doctorservice;

use Illuminate\Support\Facades\DB;

class DoctorSer
{
     

    public static function create(array $data)
    {
        $data = doctorservice::create($data);
        return $data;
    }

  
    public static function update(array $data,doctorservice $doctorser)
    {
        $data = $doctorser->update($data);
        return $data;
    }

   
    public static function updateById(array $data, $id)
    {
        $data = doctorservice::whereId($id)->update($data);
        return $data;
    }


    public static function getById($id)
    {
        $data = doctorservice::find($id);
        return $data;
    }

   
    public static function delete(doctorservice $doctorser)
    {
        $data = $doctorser->delete();
        return $data;
    }

    public static function deleteById($id)
    {
        $data = doctorservice::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('doctorservices')->orderBy('created_at', 'desc')->get();

      
        return $data;
    }

}