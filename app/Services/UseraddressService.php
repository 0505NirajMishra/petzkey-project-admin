<?php

namespace App\Services;

use App\Models\Useraddress;

use Illuminate\Support\Facades\DB;

class UseraddressService
{
     

    public static function create(array $data)
    {
        $data = Useraddress::create($data);
        return $data;
    }

  
    public static function update(array $data,Useraddress $useradd)
    {
        $data = $useradd->update($data);
        return $data;
    }

   
    public static function updateById(array $data, $id)
    {
        $data = Useraddress::whereId($id)->update($data);
        return $data;
    }


    public static function getById($id)
    {
        $data = Useraddress::find($id);
        return $data;
    }

   
    public static function delete(Useraddress $useradd)
    {
        $data = $useradd->delete();
        return $data;
    }

    public static function deleteById($id)
    {
        $data = Useraddress::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('useraddresss')->orderBy('created_at', 'desc')->get();
        return $data;
    }

}