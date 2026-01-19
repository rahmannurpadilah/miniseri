<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Folio;
use App\Services\Admin\FolioManagementService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

// Controller untuk admin folio management
class FolioController extends Controller
{
    public function __construct(protected FolioManagementService $folioService) {}

    /**
     * Tampilkan list semua folio (3 populer + yang lain dengan pagination)
     */
    public function index(): View
    {
        // Ambil folio populer (max 3)
        $popularFolios = Folio::where('is_popular', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        // Ambil folio lainnya dengan pagination
        $allFolios = Folio::paginate(10);

        return view('admin.folio_management.index', [
            'popularFolios' => $popularFolios,
            'allFolios' => $allFolios,
        ]);
    }

    /**
     * Tampilkan form create folio
     */
    public function create(): View
    {
        return view('admin.folio_management.create');
    }

    /**
     * Simpan folio baru ke database
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'desc_home' => 'required|string|max:160',
            'desc_long' => 'nullable|string',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'trailer' => 'required|file|mimes:mp4,avi,mov,webm|max:102400',
            'budget' => 'nullable|numeric|min:0',
            'quality' => 'nullable|string|max:50',
            'genre' => 'nullable|string|max:100',
            'duration' => 'nullable|numeric|min:0',
        ], [
            'title.required' => 'Judul harus diisi',
            'desc_home.required' => 'Deskripsi singkat harus diisi',
            'banner.required' => 'Banner harus diupload',
            'banner.image' => 'Banner harus berupa gambar',
            'banner.max' => 'Ukuran banner maksimal 5MB',
            'trailer.required' => 'Trailer harus diupload',
            'trailer.file' => 'Trailer harus berupa file video',
            'trailer.max' => 'Ukuran trailer maksimal 100MB',
        ]);

        // Buat folio via service
        $this->folioService->createFolio($validated);

        return redirect()->route('admin.folio.index')
            ->with('success', 'Folio berhasil ditambahkan');
    }

    /**
     * Tampilkan form edit folio
     */
    public function edit(Folio $folio): View
    {
        return view('admin.folio_management.edit', [
            'folio' => $folio,
        ]);
    }

    /**
     * Update folio ke database
     */
    public function update(Request $request, Folio $folio): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'desc_home' => 'required|string|max:160',
            'desc_long' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'trailer' => 'nullable|file|mimes:mp4,avi,mov,webm|max:102400',
            'budget' => 'nullable|numeric|min:0',
            'quality' => 'nullable|string|max:50',
            'genre' => 'nullable|string|max:100',
            'duration' => 'nullable|numeric|min:0',
        ], [
            'title.required' => 'Judul harus diisi',
            'desc_home.required' => 'Deskripsi singkat harus diisi',
            'banner.image' => 'Banner harus berupa gambar',
            'banner.max' => 'Ukuran banner maksimal 5MB',
            'trailer.file' => 'Trailer harus berupa file video',
            'trailer.max' => 'Ukuran trailer maksimal 100MB',
        ]);

        // Update folio via service
        $this->folioService->updateFolio($folio, $validated);

        return redirect()->route('admin.folio.index')
            ->with('success', 'Folio berhasil diupdate');
    }

    /**
     * Tampilkan detail folio
     */
    public function show(Folio $folio): View
    {
        return view('admin.folio_management.show', [
            'folio' => $folio,
        ]);
    }

    /**
     * Hapus folio dari database
     */
    public function destroy(Folio $folio): RedirectResponse
    {
        $this->folioService->deleteFolio($folio);

        return redirect()->route('admin.folio.index')
            ->with('success', 'Folio berhasil dihapus');
    }

    /**
     * Toggle popular status folio (max 3 populer)
     */
    public function togglePopular(Folio $folio): RedirectResponse
    {
        $this->folioService->togglePopular($folio);

        $status = $folio->fresh()->is_popular ? 'menjadi populer' : 'tidak populer lagi';

        return redirect()->route('admin.folio.index')
            ->with('success', "Folio '{$folio->title}' {$status}");
    }
}


