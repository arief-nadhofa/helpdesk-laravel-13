<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticket = Ticket::with('account')
            ->orderBy('created_at', 'DESC')
            ->orderBy('status', 'ASC')
            ->get();
        return view('pages.ticket.show', compact('ticket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $account = Account::all();
        $category = Category::all();
        return view('pages.ticket.create', compact(['account', 'category']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ticket_number = $request->ticket_number;
        $date = $request->date;
        $user_request_id = $request->user_request_id;
        $category_id = $request->category_id;
        $problem_description = $request->problem_description;

        Ticket::create([
            'ticket_number' => 1,
            'date' => $date,
            'user_request' => $user_request_id,
            'category_id' => $category_id,
            'problem_description' => $problem_description,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);

        // 2. Kirim Notifikasi via Fonnte
        // $response = Http::withHeaders([
        //     'Authorization' => env('FONNTE_TOKEN'), // Taruh token di .env
        // ])->post('https://api.fonnte.com/send', [
        //     'target' => env('FONNTE_TARGET_GROUP'), // Nomor tujuan
        //     'message' => "Gaes, tiket masuk nih!\n\n==== Helpdesk Tiket ====\nTiket No.: #1\nTanggal: {$date}\nProblem:\n{$problem_description}\nDari: 1225 - Arief N\nDibuat pada: " . Carbon::now('Asia/Jakarta') . "\n========================",
        // ]);


        return redirect()->route('ticket.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->delete();
        return redirect()->route('ticket.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
