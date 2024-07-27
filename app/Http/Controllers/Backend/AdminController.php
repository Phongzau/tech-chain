<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('admin.dashboard', compact(['title']));
    }

    public function showFormLogin()
    {
        return view('admin.auth.login');
    }

    public function showFormRegister()
    {
        return view('admin.auth.register');
    }
}
