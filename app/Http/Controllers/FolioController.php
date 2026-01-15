<?php

namespace App\Http\Controllers;

use App\Services\FolioService;

class FolioController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function show(string $hash, FolioService $folioService)
    {
        $data['folio'] = $folioService->getFolio($hash);

        return view('public.homepage.folio-detail.index', $data);
    }
}
