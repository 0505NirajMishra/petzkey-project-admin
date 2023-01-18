<?php

namespace App\Services;

use App\Models\sallonavailbilty;

use Illuminate\Support\Facades\DB;

class SallonAvailbiltyService
{
    
    public static function create(array $data)
    {
        $data = sallonavailbilty::create($data);
        return $data;
    }

    public static function update(array $data,sallonavailbilty $sallonava)
    {
        $data = $sallonava->update($data);
        return $data;
    }

    public static function updateById(array $data, $id)
    {
        $data = sallonavailbilty::whereId($id)->update($data);
        return $data;
    }

    public static function getById($id)
    {
        $data = traineravailbilty::find($id);
        return $data;
    }

    public static function delete(sallonavailbilty $sallonava)
    {
        $data = $sallonava->delete();
        return $data;
    }

    public static function deleteById($id)
    {
        $data = sallonavailbilty::whereId($id)->delete();
        return $data;
    }

    public static function datatable()
    {
        $data = DB::table('sallonavailbiltys')->orderBy('created_at', 'desc')->get();
        return $data;
    }
}