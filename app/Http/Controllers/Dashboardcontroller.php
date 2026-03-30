<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // A autenticação real é feita via Bearer token no JS (Sanctum API)
        // Esta rota só serve a view — sem depender de Auth::user()
        return view('dashboard');
    }
}
