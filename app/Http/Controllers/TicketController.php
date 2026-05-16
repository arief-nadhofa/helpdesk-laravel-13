<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\TicketTimeline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticket = Ticket::with('account')
            ->orderBy('status', 'ASC')
            ->orderBy('created_at', 'DESC')
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

        // 5. Gabungkan menjadi format final (misal: T-26050001)
        // Str::padLeft memastikan nomor urut selalu 4 digit dengan menambahkan angka '0' di depan
        $ticketNumber = $prefix . Str::padLeft($nextSequence, 4, '0');
        return view('pages.ticket.create', compact(['account', 'category', 'ticketNumber']));
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

        $npk = Ticket::with('account')->first();

        $cekAccount = Account::where('id_number', $user_request_id)->first();
        $cekCategory = Category::where('id', $category_id)->first();


        Ticket::create([
            'ticket_number' => $ticket_number,
            'date' => $date,
            'user_request' => $user_request_id,
            'category_id' => $category_id,
            'status' => 1,
            'problem_description' => $problem_description,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);

        TicketTimeline::create([
            'ticket_number' => $ticket_number,
            'status' => 1,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);

        // --- PESAN UNTUK USER (Konfirmasi) ---
        $messageToUser = "Halo *{$cekAccount->name}*,\n\n"
            . "Tiket Anda telah berhasil dibuat.\n"
            . "*No Tiket:* {$ticket_number}\n"
            . "*Status:* Open\n\n"
            . "Mohon tunggu, tim IT kami akan segera merespon. Terima kasih.";

        // --- PESAN UNTUK IT (Alert Baru) ---
        $messageToIT = "🚨 *ADA TIKET BARU!* 🚨\n\n"
            . "*No Tiket:* {$ticket_number}\n"
            . "*User:* {$cekAccount->name}\n"
            . "*Kategori:* {$cekCategory->description}\n"
            . "*Problem:* {$problem_description}\n\n"
            . "Segera cek Helpdesk untuk memproses tiket ini.";

        // // 2. Kirim Notifikasi via Fonnte
        // Http::withHeaders([
        //     'Authorization' => env('FONNTE_TOKEN'), // Taruh token di .env
        // ])->post('https://api.fonnte.com/send', [
        //     'target' => env('FONNTE_TARGET_GROUP'),
        //     "$cekAccount->phone", // Nomor tujuan
        //     'message' => $messageToIT,
        // ]);

        // Http::withHeaders([
        //     'Authorization' => env('FONNTE_TOKEN'), // Taruh token di .env
        // ])->post('https://api.fonnte.com/send', [
        //     'target' => $cekAccount->phone,
        //     "$cekAccount->phone", // Nomor tujuan
        //     'message' => $messageToUser,
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
        $ticket = Ticket::findOrFail($id);
        $account = Account::all();
        $category = Category::all();
        $status = Status::all();
        $ticketTimeline = TicketTimeline::where('ticket_number', $ticket->ticket_number)
            ->get();


        return view('pages.ticket.edit', compact(['ticket', 'account', 'category', 'status', 'ticketTimeline']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket_number = $ticket->ticket_number;
        $date = $ticket->date;
        $user_request_id = $ticket->user_request;
        $category_id = $request->category_id;
        $problem_description = $ticket->problem_description;
        $statusOld = $ticket->status;
        $note = $request->note;
        $status = $request->status;

        $maxStatus = $statusOld + 1;
        if ($status == $maxStatus) {
            if ($statusOld != $status) {
                $ticket->update([
                    'ticket_number' => $ticket_number,
                    'date' => $date,
                    'user_request' => $user_request_id,
                    'category_id' => $ticket->category_id ?  $ticket->category_id : $category_id,
                    'status' => $status,
                    'problem_description' => $problem_description,
                    'note' => $note
                ]);

                TicketTimeline::create([
                    'ticket_number' => $ticket_number,
                    'status' => $status,
                    'created_at' => Carbon::now('Asia/Jakarta'),
                ]);

                if ($status == 4) {
                    $now = now('Asia/Jakarta');
                    // $duration = $ticket->created_at->diffForHumans($now, true);

                    $cekAccount = Account::where('id_number', $user_request_id)->first();
                    $cekCategory = Category::where('id', $category_id)->first();

                    $ticketLink = "http://helpdesk-it.advics-min.co.id/search/" . $ticket_number;
                    $messageToIT = "✅ *TICKET CLOSED BY IT*\n\n"
                        . "*No Tiket:* {$ticket->ticket_number}\n"
                        . "*PIC IT:* ?\n"
                        . "*User:* {$cekAccount->name}\n"
                        . "*Durasi:* ?\n"
                        . "*Note:* {$ticket->note}\n\n";

                    $messageToUser = "Halo *{$cekAccount->name}*,\n\n"
                        . "Tiket bantuan Anda telah selesai diproses oleh tim IT.\n\n"
                        . "*No. Tiket:* {$ticket_number}\n"
                        . "*Status:* CLOSED (Selesai)\n"
                        . "*Solusi/Catatan:* {$note}\n\n"
                        . "Anda dapat melihat detail tiket di sini:\n"
                        . "🔗 {$ticketLink}\n\n"
                        . "Terima kasih telah menghubungi Helpdesk!";

                    Http::withHeaders([
                        'Authorization' => env('FONNTE_TOKEN'), // Taruh token di .env
                    ])->post('https://api.fonnte.com/send', [
                        'target' => $cekAccount->phone,
                        "$cekAccount->phone", // Nomor tujuan
                        'message' => $messageToUser,
                    ]);

                    // 2. Kirim Notifikasi via Fonnte
                    Http::withHeaders([
                        'Authorization' => env('FONNTE_TOKEN'), // Taruh token di .env
                    ])->post('https://api.fonnte.com/send', [
                        'target' => env('FONNTE_TARGET_GROUP'),
                        "$cekAccount->phone", // Nomor tujuan
                        'message' => $messageToIT,
                    ]);
                }


                return redirect()->route('ticket.index')->with(['success' => 'Data Berhasil Diupdate!']);
            } else {
                return redirect()->route('ticket.index')->with(['error' => 'Data tidak ada update!']);
            }
        } else {
            return redirect()->back()->with(['error' => 'Update status tidak diperbolehkan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);

        TicketTimeline::where('ticket_number', $ticket->ticket_number)->delete();

        $ticket->delete();

        return redirect()->route('ticket.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function store_client(Request $request)
    {
        $ticket_number = $request->ticket_number;
        $date = date('Y-m-d', strtotime(Carbon::now('Asia/Jakarta')));
        $user_request_id = "1225";
        $category_id = 0;
        $problem_description = $request->problem_description;

        $npk = Ticket::with('account')->first();

        $cekAccount = Account::where('id_number', $user_request_id)->first();
        $cekCategory = Category::where('id', $category_id)->first();


        Ticket::create([
            'ticket_number' => $ticket_number,
            'date' => $date,
            'user_request' => $user_request_id,
            'category_id' => $category_id,
            'status' => 1,
            'problem_description' => $problem_description,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);

        TicketTimeline::create([
            'ticket_number' => $ticket_number,
            'status' => 1,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);

        // Tentukan URL detail tiket (asumsi kamu punya route bernama 'tickets.show')
        $ticketLink = "http://helpdesk-it.advics-min.co.id/search/" . $ticket_number;
        // --- PESAN UNTUK USER (Konfirmasi) ---
        $messageToUser = "Halo *{$cekAccount->name}*,\n\n"
            . "Tiket Anda berhasil dibuat.\n"
            . "*No Tiket:* {$ticket_number}\n\n"
            . "Anda bisa memantau status tiket secara real-time melalui link berikut:\n"
            . "🔗 {$ticketLink}\n\n"
            . "Terima kasih.";

        // --- PESAN UNTUK IT (Alert Baru) ---
        $messageToIT = "🚨 *ADA TIKET BARU!* 🚨\n\n"
            . "*No Tiket:* {$ticket_number}\n"
            . "*User:* {$cekAccount->name}\n"
            . "*Kategori:* -\n"
            . "*Problem:* {$problem_description}\n\n"
            . "Segera cek Helpdesk untuk memproses tiket ini.";

        // 2. Kirim Notifikasi via Fonnte
        Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'), // Taruh token di .env
        ])->post('https://api.fonnte.com/send', [
            'target' => env('FONNTE_TARGET_GROUP'),
            "$cekAccount->phone", // Nomor tujuan
            'message' => $messageToIT,
        ]);

        Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'), // Taruh token di .env
        ])->post('https://api.fonnte.com/send', [
            'target' => $cekAccount->phone,
            "$cekAccount->phone", // Nomor tujuan
            'message' => $messageToUser,
        ]);


        return redirect()->route('dashboard-client')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
