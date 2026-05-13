<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class LayoutController extends Controller
{
    //

    function index(): View
    {
        return View('pages.login');
    }

    function dashboard(): View
    {
        return View('pages.dashboard');
    }

    function proses_login()
    {
        return redirect()->to('dashboard');
    }

    function proses_logout()
    {
        return redirect()->to('/');
    }
}
