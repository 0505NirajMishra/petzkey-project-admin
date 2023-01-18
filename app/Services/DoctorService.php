<?php

namespace App\Services;

use App\Models\Doctors;
use Illuminate\Support\Facades\DB;

class DoctorService
{
     /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Promocode
     */ 

    public static function create(array $data)
    {
        $data = Doctors::create($data);
        return $data;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Promocode $promocode
     * @return Promocode
     */ 

    public static function update(array $data, Doctors $doctor)
    {
        $data = $doctor->update($data);
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
        $data = Doctors::whereId($id)->update($data);
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
        $data = Doctors::find($id);
        return $data;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Promocode
     * @return bool
     */

    public static function delete(Doctors $doctor)
    {
        $data = $doctor->delete();
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
        $data = Doctors::whereId($id)->delete();
        return $data;
    }

   
     /**
     * Get data for datatable from storage.
     *
     * @return Promocode with states, countries
     */

     public static function datatable()
    {
        $data = DB::table('doctors')->orderBy('created_at', 'desc')->get();
        return $data;
    }

}