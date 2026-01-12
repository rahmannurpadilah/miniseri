<?php

namespace App\Services;

use App\Mail\SineasRegisterMail;
use App\Models\SineasRegistration;
use Illuminate\Support\Facades\Mail;

class SineasRegistrationService
{
    /**
     * Create a new class instance.
     */
    public function register(array $data): SineasRegistration
    {
        $sineas = SineasRegistration::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'can_edit' => $data['can_edit'],
            'agreement' => true,
        ]);

        Mail::to(config('mail.admin_email'))->send(new SineasRegisterMail($sineas));
        return $sineas;
    }
}
