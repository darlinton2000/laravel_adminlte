<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
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
        return view('admin.home');
    }
}
