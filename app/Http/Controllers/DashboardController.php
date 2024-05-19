<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id ==  '1') {
            $activePage = 'dashboard';
            return  view('mahasiswa.dashboard', compact('activePage'));
        } elseif (Auth::user()->role_id == '2') {
            $activePage = 'dashboard';
            return  view('cdc.dashboard', compact('activePage'));
        } elseif (Auth::user()->role_id == '3') {
            $activePage = 'dashboard';
            return  view('admin.dashboard', compact('activePage'));
        } elseif (Auth::user()->role_id == '4') {
            $activePage = 'dashboard';
            return  view('dekanat.dashboard', compact('activePage'));
        }
    }
}
