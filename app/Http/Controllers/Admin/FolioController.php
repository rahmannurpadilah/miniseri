<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Folio;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FolioController extends Controller
{
    /**
     * Tampilkan daftar semua folio dengan favorit di atas
     */
    public function index(): View
    {
        // Ambil 3 folio favorit
        $favoriteFolios = Folio::where('is_favorite', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Ambil semua folio yang bukan favorit
        $allFolios = Folio::where('is_favorite', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.folios_management.index', compact('favoriteFolios', 'allFolios'));
    }

    /**
     * Tampilkan form untuk membuat folio baru
     */
    public function create(): View
    {
        return view('admin.folios_management.create');
    }

    /**
     * Simpan folio baru ke database
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'is_favorite' => 'boolean',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'trailer' => 'required|file|mimes:mp4,webm,avi|max:102400',
            'desc_home' => 'required|string|max:255',
            'desc_side' => 'required|string',
            'desc_full' => 'required|string',
        ]);

        // Handle banner upload
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('folios/banners', 'public');
            $validated['banner'] = $bannerPath;
        }

        // Handle trailer upload
        if ($request->hasFile('trailer')) {
            $trailerPath = $request->file('trailer')->store('folios/trailers', 'public');
            $validated['trailer'] = $trailerPath;
        }

        // Set default is_favorite jika tidak ada
        $validated['is_favorite'] = $request->has('is_favorite') ? true : false;

        // Jika is_favorite dipilih, pastikan hanya maksimal 3 favorit
        if ($validated['is_favorite']) {
            $favoritesCount = Folio::where('is_favorite', true)->count();
            if ($favoritesCount >= 3) {
                return redirect()->back()->with('error', 'Hanya boleh maksimal 3 folio favorit');
            }
        }

        Folio::create($validated);

        return redirect()->route('admin.folios.index')->with('success', 'Folio berhasil ditambahkan');
    }

    /**
     * Tampilkan detail folio
     */
    public function show(Folio $folio): View
    {
        return view('admin.folios_management.show', compact('folio'));
    }

    /**
     * Tampilkan form untuk mengedit folio
     */
    public function edit(Folio $folio): View
    {
        return view('admin.folios_management.edit', compact('folio'));
    }

    /**
     * Update folio di database
     */
    public function update(Request $request, Folio $folio): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'is_favorite' => 'boolean',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'trailer' => 'nullable|file|mimes:mp4,webm,avi|max:102400',
            'desc_home' => 'required|string|max:255',
            'desc_side' => 'required|string',
            'desc_full' => 'required|string',
        ]);

        // Handle banner upload
        if ($request->hasFile('banner')) {
            // Hapus banner lama jika ada
            if ($folio->banner) {
                \Storage::disk('public')->delete($folio->banner);
            }
            $bannerPath = $request->file('banner')->store('folios/banners', 'public');
            $validated['banner'] = $bannerPath;
        }

        // Handle trailer upload
        if ($request->hasFile('trailer')) {
            // Hapus trailer lama jika ada
            if ($folio->trailer) {
                \Storage::disk('public')->delete($folio->trailer);
            }
            $trailerPath = $request->file('trailer')->store('folios/trailers', 'public');
            $validated['trailer'] = $trailerPath;
        }

        // Update is_favorite
        $isFavoriteBefore = $folio->is_favorite;
        $validated['is_favorite'] = $request->has('is_favorite') ? true : false;

        // Cek limit favorit
        if ($validated['is_favorite'] && !$isFavoriteBefore) {
            $favoritesCount = Folio::where('is_favorite', true)->count();
            if ($favoritesCount >= 3) {
                return redirect()->back()->with('error', 'Hanya boleh maksimal 3 folio favorit');
            }
        }

        $folio->update($validated);

        return redirect()->route('admin.folios.index')->with('success', 'Folio berhasil diperbarui');
    }

    /**
     * Hapus folio
     */
    public function destroy(Folio $folio): RedirectResponse
    {
        // Hapus banner jika ada
        if ($folio->banner) {
            \Storage::disk('public')->delete($folio->banner);
        }

        // Hapus trailer jika ada
        if ($folio->trailer) {
            \Storage::disk('public')->delete($folio->trailer);
        }

        $folio->delete();

        return redirect()->route('admin.folios.index')->with('success', 'Folio berhasil dihapus');
    }

    /**
     * Toggle status unggulan folio
     */
    public function toggleFavorite(Folio $folio): RedirectResponse
    {
        // Jika akan dijadikan unggulan, cek apakah sudah maksimal 3
        if (!$folio->is_favorite) {
            $favoritesCount = Folio::where('is_favorite', true)->count();
            if ($favoritesCount >= 3) {
                return redirect()->back()->with('error', 'Hanya boleh maksimal 3 folio unggulan. Hapus salah satu terlebih dahulu.');
            }
            $folio->update(['is_favorite' => true]);
            return redirect()->back()->with('success', 'Folio berhasil dijadikan unggulan');
        } else {
            // Hapus dari unggulan
            $folio->update(['is_favorite' => false]);
            return redirect()->back()->with('success', 'Folio berhasil dihapus dari unggulan');
        }
    }
}
