<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\UserService;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    /**
     * Tampilkan daftar semua user
     */
    public function index(): View
    {
        $users = $this->userService->getAllUsers();
        return view('admin.users_management.index', compact('users'));
    }
}
