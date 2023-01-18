<?php

namespace App\Services;

use App\Models\Advisorie;

class AdvisorieService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Advisorie
     */
    public static function create(array $data)
    {
        $data = Advisorie::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Advisorie $battle
     * @return Advisorie
     */
    public static function update(array $data, Advisorie $advisory)
    {
        $data = $advisory->update($data);
        return $data;
    }

    /**
     * UpdateById the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  $id
     * @return Advisorie
     */
    public static function updateById(array $data, $id)
    {
        $data = Advisorie::whereId($id)->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return Advisorie
     */
    public static function getById($id)
    {
        $data = Advisorie::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Advisorie
     * @return bool
     */
    public static function delete(Advisorie $advisory)
    {
        $data = $advisory->delete();
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
        $data = Advisorie::whereId($id)->delete();
        return $data;
    }

    /**
     * update data in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Int $id - Battle Id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = Advisorie::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Advisorie with states, countries
     */
    public static function datatable()
    {
        $data = Advisorie::orderBy('created_at', 'desc');
        return $data;
    }
}
