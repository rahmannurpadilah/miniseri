<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Folio;
use App\Models\SineasRegistration;
use Illuminate\View\View;

// Controller untuk dashboard admin
class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard dengan statistik data
     * 
     * @return View
     */
    public function index(): View
    {
        // Ambil data statistik dari database
        // $totalUsers = User::query()->count();
        $totalFolios = Folio::query()->count();
        $totalSineasRegistrations = SineasRegistration::query()->count();

        // Ambil sineas registrations terbaru (limit 5)
        $recentSineasRegistrations = SineasRegistration::query()
            ->latest('created_at')
            ->limit(5)
            ->get();

        // Ambil folios unggulan (limit 3)
        $recentFolios = Folio::where('is_favorite', true)
            ->latest('created_at')
            ->limit(3)
            ->get();

        // Ambil users terbaru (limit 5)
        // $recentUsers = User::query()
        //     ->latest('created_at')
        //     ->limit(5)
        //     ->get();

        // Kirim data ke view
        return view('admin.dashboard.index', [
            // 'totalUsers' => $totalUsers,
            'totalFolios' => $totalFolios,
            'totalSineasRegistrations' => $totalSineasRegistrations,
            'recentSineasRegistrations' => $recentSineasRegistrations,
            'recentFolios' => $recentFolios,
            // 'recentUsers' => $recentUsers,
        ]);
    }
}

