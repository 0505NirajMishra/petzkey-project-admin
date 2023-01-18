<?php

namespace App\Services;

use App\Models\traineravailbilty;

use Illuminate\Support\Facades\DB;

class TrainerAvailbiltyService
{
    
    public static function create(array $data)
    {
        $data = traineravailbilty::create($data);
        return $data;
    }

    public static function update(array $data,traineravailbilty $trainerava)
    {
        $data = $trainerava->update($data);
        return $data;
    }

    public static function updateById(array $data, $id)
    {
        $data = traineravailbilty::whereId($id)->update($data);
        return $data;
    }

    public static function getById($id)
    {
        $data = traineravailbilty::find($id);
        return $data;
    }

    public static function delete(traineravailbilty $trainerava)
    {
        $data = $trainerava->delete();
        return $data;
    }

    public static function deleteById($id)
    {
        $data = traineravailbilty::whereId($id)->delete();
        return $data;
    }

    public static function datatable()
    {
        $data = DB::table('traineravailbiltys')->orderBy('created_at', 'desc')->get();
        return $data;
    }
}