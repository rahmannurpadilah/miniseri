<?php

namespace App\Services;

use App\Models\Folio;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class FolioService
{
    /**
     * Create a new class instance.
     */
    public function getFolio(string $hash)
    {
        try {
            $id = Crypt::decrypt($hash);
        } catch (DecryptException $e) {
            abort(404);
        }

        return Folio::findOrFail($id);
    }
}
