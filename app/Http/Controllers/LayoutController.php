<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
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
        $ticket = Ticket::all();
        return View('pages.dashboard', compact('ticket'));
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
