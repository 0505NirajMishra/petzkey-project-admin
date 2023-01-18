<?php

namespace App\Services;

use App\Models\Managehostels;
use Illuminate\Support\Facades\DB;

class Hostelmanageservice
{
     /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Promocode
     */ 

    public static function create(array $data)
    {
        $data = Managehostels::create($data);
        return $data;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Promocode $promocode
     * @return Promocode
     */ 

    public static function update(array $data, Managehostels $managehostel)
    {
        $data = $managehostel->update($data);
        return $data;
    }

     /**
     * UpdateById the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  $id
     * @return Promocode
     */ 

    public static function updateById(array $data, $id)
    {
        $data = Managehostels::whereId($id)->update($data);
        return $data;
    }


    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return Promocode
     */ 

    public static function getById($id)
    {
        $data = Managehostels::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Promocode
     * @return bool
     */
    public static function delete(Managehostels $managehostel)
    {
        $data = $managehostel->delete();
        return $data;
    }


    /**
     * RemoveById the specified resource from storage.
     *
     * @param  $id
     * @return bool
     */
    public static function deleteById($id)
    {
        $data = Managehostels::whereId($id)->delete();
        return $data;
    }

  
    public static function datatable()
    {
        $data = DB::table('managehostelservice')->orderBy('created_at', 'desc')->get();
        return $data;
    }
}