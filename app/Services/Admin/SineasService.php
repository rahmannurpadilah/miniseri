<?php

namespace App\Services\Admin;

use App\Models\SineasRegistration;

class SineasService
{
    /**
     * Ambil semua data sineas dengan pagination
     * 
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedSineas($perPage = 10)
    {
        return SineasRegistration::paginate($perPage);
    }

    /**
     * Cari sineas berdasarkan ID
     * 
     * @param int $id
     * @return \App\Models\SineasRegistration
     */
    public function getSineasById($id)
    {
        return SineasRegistration::findOrFail($id);
    }

    /**
     * Update data sineas
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateSineas($id, array $data)
    {
        $sineas = $this->getSineasById($id);
        return $sineas->update($data);
    }

    /**
     * Hapus data sineas
     * 
     * @param int $id
     * @return bool
     */
    public function deleteSineas($id)
    {
        $sineas = $this->getSineasById($id);
        return $sineas->delete();
    }
}
