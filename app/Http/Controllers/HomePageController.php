<?php

namespace App\Http\Controllers;

use App\Models\Folio;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['folios'] = Folio::where('is_favorite', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('public.homepage.index', $data);
    }
}
