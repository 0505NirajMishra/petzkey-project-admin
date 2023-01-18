<?php

namespace App\Services;

use App\Models\SallonImage;

use Illuminate\Support\Facades\DB;

class SallonImageService
{
     /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Promocode
     */ 

    public static function create(array $data)
    {
        $data = SallonImage::create($data);
        return $data;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Promocode $promocode
     * @return Promocode
     */ 

    public static function update(array $data,SallonImage $sallon)
    {
        $data = $sallon->update($data);
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
        $data = SallonImage::whereId($id)->update($data);
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
        $data = SallonImage::find($id);
        return $data;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Promocode
     * @return bool
     */

    public static function delete(SallonImage $sallon)
    {
        $data = $sallon->delete();
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
        $data = SallonImage::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('sallonimages')->orderBy('created_at','desc')->get();
        return $data;
    }

}