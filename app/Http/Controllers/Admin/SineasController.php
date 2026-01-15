<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SineasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SineasController extends Controller
{
    /**
     * Untuk menyimpan instance SineasService
     * 
     * @var \App\Services\Admin\SineasService
     */
    protected $sineasService;

    /**
     * Konstruktor - inject SineasService
     * 
     * @param \App\Services\Admin\SineasService $sineasService
     */
    public function __construct(SineasService $sineasService)
    {
        $this->sineasService = $sineasService;
    }

    /**
     * Tampilkan daftar semua sineas dengan pagination
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data sineas dengan pagination 10 item per halaman
        $sineasList = $this->sineasService->getPaginatedSineas(perPage: 10);

        // Kirim data ke view
        return view('admin.sineas_management.index', [
            'sineasList' => $sineasList,
        ]);
    }

    /**
     * Tampilkan form untuk edit sineas
     * Decrypt ID terlebih dahulu sebelum mencari data
     * 
     * @param string $encryptedId - ID yang sudah di-encrypt
     * @return \Illuminate\View\View
     */
    public function edit($encryptedId)
    {
        // Dekripsi ID
        $id = Crypt::decrypt($encryptedId);

        // Ambil data sineas berdasarkan ID
        $sineas = $this->sineasService->getSineasById($id);

        // Kirim data ke form edit
        return view('admin.sineas_management.edit', [
            'sineas' => $sineas,
        ]);
    }

    /**
     * Simpan perubahan data sineas
     * Decrypt ID terlebih dahulu sebelum update
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $encryptedId - ID yang sudah di-encrypt
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $encryptedId)
    {
        // Dekripsi ID
        $id = Crypt::decrypt($encryptedId);

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sineas_registrations,email,' . $id,
            'phone' => 'required|string|max:20',
            'can_edit' => 'required|in:Ya,Tidak',
            'agreement' => 'boolean',
        ]);

        // Update data sineas
        $this->sineasService->updateSineas($id, $validated);

        // Redirect dengan pesan sukses
        return redirect()
            ->route('admin.sineas.index')
            ->with('success', 'Data sineas berhasil diperbarui');
    }

    /**
     * Hapus data sineas
     * Decrypt ID terlebih dahulu sebelum hapus
     * 
     * @param string $encryptedId - ID yang sudah di-encrypt
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($encryptedId)
    {
        // Dekripsi ID
        $id = Crypt::decrypt($encryptedId);

        // Hapus data sineas
        $this->sineasService->deleteSineas($id);

        // Redirect dengan pesan sukses
        return redirect()
            ->route('admin.sineas.index')
            ->with('success', 'Data sineas berhasil dihapus');
    }
}
