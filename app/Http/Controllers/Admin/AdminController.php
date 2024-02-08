<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    /**
     * Autênticação
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Página inicial do painel administrativo
     *
     * @return View
     */
    public function index()
    {
        $userCount = User::count();

        return view('admin.dashboard', [
            'userCount'    => $userCount
        ]);
    }
}
