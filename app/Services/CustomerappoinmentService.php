<?php

namespace App\Services;

use App\Models\Customerappoinment;

use Illuminate\Support\Facades\DB;

class CustomerappoinmentService
{
  
    
    public static function create(array $data)
    {
        $data = Customerappoinment::create($data);
        return $data;
    }

     
    public static function update(array $data,Customerappoinment $customer)
    {
        $data = $customer->update($data);
        return $data;
    }

  

    public static function updateById(array $data, $id)
    {
        $data = Customerappoinment::whereId($id)->update($data);
        return $data;
    }

    public static function getById($id)
    {
        $data = Customerappoinment::find($id);
        return $data;
    }

    public static function delete(Customerappoinment $customer)
    {
        $data = $customer->delete();
        return $data;
    }

    public static function deleteById($id)
    {
        $data = Customerappoinment::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('customerappoinments')->orderBy('created_at', 'desc')->get();
        return $data;
    }
}