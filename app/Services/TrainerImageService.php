<?php

namespace App\Services;

use App\Models\TrainerImage;

use Illuminate\Support\Facades\DB;

class TrainerImageService
{
     /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Promocode
     */ 

    public static function create(array $data)
    {
        $data = TrainerImage::create($data);
        return $data;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Promocode $promocode
     * @return Promocode
     */ 

    public static function update(array $data,TrainerImage $trainerimage)
    {
        $data = $trainerimage->update($data);
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
        $data = TrainerImage::whereId($id)->update($data);
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
        $data = TrainerImage::find($id);
        return $data;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Promocode
     * @return bool
     */

    public static function delete(TrainerImage $trainerimage)
    {
        $data = $trainerimage->delete();
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
        $data = TrainerImage::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('trainerimages')->orderBy('created_at','desc')->get();
        return $data;
    }

}