<?php

namespace App\Services;

use App\Models\BookAnAppointment;

class BookAnAppointmentService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return SetAvailability
     */
    public static function create(array $data)
    {
        $data = BookAnAppointment::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  BookAnAppointment $battle
     * @return BookAnAppointment
     */
    public static function update(array $data, BookAnAppointment $bookanappointment)
    {
        $data = $bookanappointment->update($data);
        return $data;
    }

    /**
     * UpdateById the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  $id
     * @return BookAnAppointment
     */
    public static function updateById(array $data, $id)
    {
        $data = BookAnAppointment::whereId($id)->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return BookAnAppointment
     */
    public static function getById($id)
    {
        $data = BookAnAppointment::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\BookAnAppointment
     * @return bool
     */
    public static function delete(BookAnAppointment $bookanappointment)
    {
        $data = $bookanappointment->delete();
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
        $data = BookAnAppointment::whereId($id)->delete();
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
        $data = BookAnAppointment::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return BookAnAppointment with states, countries
     */
    public static function datatable()
    {
        $data = BookAnAppointment::orderBy('created_at', 'desc');
        return $data;
    }
}
