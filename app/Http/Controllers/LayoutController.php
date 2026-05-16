<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

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

    function proses_login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($username == "admin" && $password == "admin") {
            return redirect()->to('dashboard');
        } else if ($username == "user" && $password == "user") {
            return redirect()->to('dashboard-client');
        } else {
            return redirect()->back()->with(['error' => 'Login gagal!']);
        }
    }

    function proses_logout()
    {
        return redirect()->to('/');
    }

    function client_dashboard()
    {
        $account = Account::all();
        $category = Category::all();

        // 2. Generate Format Tahun dan Bulan (Format: 2605)
        $now = Carbon::now();
        $prefix = 'T-' . $now->format('ym');

        // 3. Cari tiket terakhir yang dibuat pada bulan & tahun ini
        $lastTicket = Ticket::where('ticket_number', 'like', $prefix . '%')
            ->latest('id') // Urutkan berdasarkan ID terbesar (terbaru)
            ->first();

        // 4. Tentukan nomor urut berikutnya
        if ($lastTicket) {
            // Mengambil 4 digit terakhir (misal '0001' menjadi int 1)
            $lastSequence = (int) substr($lastTicket->ticket_number, -4);
            $nextSequence = $lastSequence + 1;
        } else {
            // Jika belum ada tiket di bulan ini, mulai dari 1
            $nextSequence = 1;
        }
        $ticketNumber = $prefix . Str::padLeft($nextSequence, 4, '0');

        $ticket = Ticket::orderBy('status', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();
        return View('pages.client.dashboard', compact(['ticketNumber', 'account', 'category', 'ticket']));
    }
}
