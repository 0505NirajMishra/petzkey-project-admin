<?php

namespace App\Services;

use App\Models\TrainerSer;

use Illuminate\Support\Facades\DB;

class TrainerService
{
     
    public static function create(array $data)
    {
        $data = TrainerSer::create($data);
        return $data;
    }


    public static function update(array $data,TrainerSer $trainerservice)
    {
        $data = $trainerservice->update($data);
        return $data;
    }

    
    public static function updateById(array $data, $id)
    {
        $data = TrainerSer::whereId($id)->update($data);
        return $data;
    }


    public static function getById($id)
    {
        $data = TrainerSer::find($id);
        return $data;
    }

   
    public static function delete(TrainerSer $trainerservice)
    {
        $data = $trainerservice->delete();
        return $data;
    }


    public static function deleteById($id)
    {
        $data = TrainerSer::whereId($id)->delete();
        return $data;
    }

   
    public static function datatable()
    {
        $data = DB::table('trainerservices')->orderBy('created_at','desc')->get();
        return $data;
    }

}