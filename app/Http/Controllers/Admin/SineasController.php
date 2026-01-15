<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SineasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

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
        try {
            // Validasi input - pastikan encryptedId tidak kosong
            if (empty($encryptedId)) {
                return redirect()
                    ->route('admin.sineas.index')
                    ->with('error', 'ID tidak valid');
            }

            // Dekripsi ID
            $id = Crypt::decrypt($encryptedId);

            // Validasi hasil dekripsi - pastikan ID berupa integer
            if (!is_numeric($id) || $id <= 0) {
                return redirect()
                    ->route('admin.sineas.index')
                    ->with('error', 'ID tidak valid');
            }

            // Ambil data sineas berdasarkan ID
            $sineas = $this->sineasService->getSineasById($id);

            // Kirim data ke form edit
            return view('admin.sineas_management.edit', [
                'sineas' => $sineas,
            ]);

        } catch (DecryptException $e) {
            // Handle decrypt error
            \Log::error('Decrypt error di SineasController@edit: ' . $e->getMessage());
            
            return redirect()
                ->route('admin.sineas.index')
                ->with('error', 'Gagal membuka form edit: ID tidak valid atau sudah kadaluarsa');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle record not found
            \Log::warning('Sineas tidak ditemukan di database: ID ' . $id);
            
            return redirect()
                ->route('admin.sineas.index')
                ->with('error', 'Data sineas tidak ditemukan');

        } catch (\Exception $e) {
            // Handle unexpected error
            \Log::error('Error tidak terduga di SineasController@edit: ' . $e->getMessage());
            
            return redirect()
                ->route('admin.sineas.index')
                ->with('error', 'Terjadi kesalahan saat membuka form edit');
        }
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
        try {
            // Validasi input - pastikan encryptedId tidak kosong
            if (empty($encryptedId)) {
                return redirect()
                    ->route('admin.sineas.index')
                    ->with('error', 'ID tidak valid');
            }

            // Dekripsi ID
            $id = Crypt::decrypt($encryptedId);

            // Validasi hasil dekripsi - pastikan ID berupa integer
            if (!is_numeric($id) || $id <= 0) {
                return redirect()
                    ->route('admin.sineas.index')
                    ->with('error', 'ID tidak valid');
            }

            // Validasi input form dengan rule yang ketat
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'min:3',
                    'regex:/^[a-zA-Z\s\-\.]+$/', // Hanya huruf, spasi, dash, dan titik
                ],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:sineas_registrations,email,' . $id,
                ],
                'phone' => [
                    'required',
                    'string',
                    'max:20',
                    'min:10',
                    'regex:/^[0-9\+\-\s\(\)]+$/', // Hanya angka dan karakter telepon
                ],
                'can_edit' => [
                    'required',
                    'in:Ya,Tidak',
                ],
                'agreement' => [
                    'boolean',
                ],
            ], [
                // Custom error messages Bahasa Indonesia
                'name.required' => 'Nama lengkap harus diisi',
                'name.string' => 'Nama lengkap harus berupa teks',
                'name.max' => 'Nama lengkap maksimal 255 karakter',
                'name.min' => 'Nama lengkap minimal 3 karakter',
                'name.regex' => 'Nama lengkap hanya boleh berisi huruf, spasi, dash, dan titik',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email tidak valid',
                'email.max' => 'Email maksimal 255 karakter',
                'email.unique' => 'Email sudah terdaftar di sistem',
                'phone.required' => 'Nomor telepon harus diisi',
                'phone.string' => 'Nomor telepon harus berupa teks',
                'phone.max' => 'Nomor telepon maksimal 20 karakter',
                'phone.min' => 'Nomor telepon minimal 10 karakter',
                'phone.regex' => 'Nomor telepon tidak valid',
                'can_edit.required' => 'Status bisa edit harus dipilih',
                'can_edit.in' => 'Nilai status bisa edit tidak valid',
                'agreement.boolean' => 'Format persetujuan tidak valid',
            ]);

            // Cek apakah data sineas masih ada di database
            $sineas = $this->sineasService->getSineasById($id);

            // Update data sineas
            $this->sineasService->updateSineas($id, $validated);

            // Log aktivitas update
            \Log::info('Data sineas berhasil diupdate', [
                'sineas_id' => $id,
                'sineas_name' => $validated['name'],
                'user_id' => auth()->id() ?? 'unknown',
            ]);

            // Redirect dengan pesan sukses
            return redirect()
                ->route('admin.sineas.index')
                ->with('success', 'Data sineas (' . $validated['name'] . ') berhasil diperbarui');

        } catch (DecryptException $e) {
            // Handle decrypt error
            \Log::error('Decrypt error di SineasController@update: ' . $e->getMessage());
            
            return redirect()
                ->route('admin.sineas.index')
                ->with('error', 'Gagal mengupdate data: ID tidak valid atau sudah kadaluarsa');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle record not found
            \Log::warning('Sineas tidak ditemukan saat update: ID ' . $id);
            
            return redirect()
                ->route('admin.sineas.index')
                ->with('error', 'Data sineas tidak ditemukan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validasi gagal - redirect kembali dengan error
            return redirect()
                ->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            // Handle unexpected error
            \Log::error('Error tidak terduga di SineasController@update: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat mengupdate data')
                ->withInput();
        }
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
        try {
            // Validasi input - pastikan encryptedId tidak kosong
            if (empty($encryptedId)) {
                return redirect()
                    ->route('admin.sineas.index')
                    ->with('error', 'ID tidak valid');
            }

            // Dekripsi ID
            $id = Crypt::decrypt($encryptedId);

            // Validasi hasil dekripsi - pastikan ID berupa integer
            if (!is_numeric($id) || $id <= 0) {
                return redirect()
                    ->route('admin.sineas.index')
                    ->with('error', 'ID tidak valid');
            }

            // Cek apakah data sineas masih ada sebelum hapus
            $sineas = $this->sineasService->getSineasById($id);
            $sineasName = $sineas->name;

            // Hapus data sineas
            $this->sineasService->deleteSineas($id);

            // Log aktivitas delete
            \Log::info('Data sineas berhasil dihapus', [
                'sineas_id' => $id,
                'sineas_name' => $sineasName,
                'user_id' => auth()->id() ?? 'unknown',
            ]);

            // Redirect dengan pesan sukses
            return redirect()
                ->route('admin.sineas.index')
                ->with('success', 'Data sineas (' . $sineasName . ') berhasil dihapus');

        } catch (DecryptException $e) {
            // Handle decrypt error
            \Log::error('Decrypt error di SineasController@destroy: ' . $e->getMessage());
            
            return redirect()
                ->route('admin.sineas.index')
                ->with('error', 'Gagal menghapus data: ID tidak valid atau sudah kadaluarsa');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle record not found
            \Log::warning('Sineas tidak ditemukan saat delete: ID ' . $id);
            
            return redirect()
                ->route('admin.sineas.index')
                ->with('error', 'Data sineas tidak ditemukan');

        } catch (\Exception $e) {
            // Handle unexpected error
            \Log::error('Error tidak terduga di SineasController@destroy: ' . $e->getMessage());
            
            return redirect()
                ->route('admin.sineas.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
