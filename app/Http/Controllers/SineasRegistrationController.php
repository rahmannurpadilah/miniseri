<?php

namespace App\Http\Controllers;

use App\Models\SineasRegistration;
use App\Services\SineasRegistrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SineasRegistrationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SineasRegistrationService $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sineas_registrations',
            'phone' => 'required|string|max:20',
            'can_edit' => 'required|in:Ya,Tidak',
            'g-recaptcha-response' => 'required',
            'agreement' => 'accepted',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if(!($response->json()['success'] ?? false)){
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'Captcha tidak valid. Tolong coba lagi.'])->withInput();
        }

        try{
            $service->register($request->all());
            return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pendaftaran.');
        }
    }

    public function refreshCaptcha() {
        return response()->json(['captcha' => captcha_img()]);
    }
}
