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
        $data['folios'] = Folio::all();

        return view('public.homepage.index', $data);
    }
}
