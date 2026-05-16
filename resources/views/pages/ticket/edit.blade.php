@include('layouts.header')
@include('layouts.sidebar')
<!-- Area Konten Utama -->
<main class="p-8 bg-base-200 min-h-screen max-w-full">

    <div class="grid grid-cols-12 ">
        <div class="col-span-12">
            <div class="breadcrumbs text-sm float-end">
                <ul>
                    <li>
                        <span class="badge bg-gray-300 ">Ticket</span>
                    </li>
                    <li>
                        <span class="badge bg-gray-300 ">
                            <a href="{{ route('ticket.index') }}">List</a>
                        </span>
                    </li>
                    <li>
                        <span class="badge bg-blue-400 text-white">Edit</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @if(session('error'))
    <div class="toast toast-top toast-end">
        <div class="alert alert-error text-white">
            <span>{{ session('error') }}</span>
        </div>
    </div>
    <script>
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            });
        }, 3000); // Hilang dalam 3 detik
    </script>
    @endif

    <div class="grid mt-0">
        <div class="w-full mb-5">
            <div class="flex w-full items-start justify-between relative">

                <div class="absolute top-[65%] left-0 w-full h-1 bg-gray-200 -z-0 transform -translate-y-1/2"></div>

                @foreach($status as $s)
                @php
                // Mencari apakah status saat ini ada di dalam history timeline
                $history = $ticketTimeline->where('status', $s['id'])->first();
                @endphp
                <div class="flex flex-col items-center flex-1 relative z-10">
                    <span class="text-xs md:text-sm font-medium mb-3 text-center h-10 flex items-end">{{ $s['description'] }}</span>
                    @if($history)
                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white ring-4 ring-white">
                        <span class="fas fa-check"></span>
                    </div>
                    @else
                    <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center text-white ring-4 ring-white">
                        <!-- <span class="fas fa-check"></span> -->
                    </div>
                    @endif
                    <span class="text-xs h-5 text-center flex items-end">{{ $history?date('d M Y H:i:s',strtotime($history->created_at)):'--:--' }}</span>
                </div>
                @endforeach

            </div>
        </div>
        <div class="overflow-x-auto bg-base-100 p-5 rounded-box shadow-sm">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Update Ticket</h2>
                <div class="float-end">
                    <a href="{{ route('ticket.index') }}" class="btn bg-warning w-full text-white">
                        <span class="fas fa-backward"></span>
                        Back</a>
                </div>
            </div>
            <div class="divider"></div>
            <form action="{{ route('ticket.update', $ticket->id) }}" method="POST">
                @csrf
                @method('PUT')
                <fieldset class="fieldset grid grid-cols-12 gap-4">


                    <div class="col-span-4">
                        <legend class="fieldset-legend">Ticket No.</legend>
                        <input type="text" name="ticket_number" class="input w-full" value="{{ $ticket->ticket_number }}" readonly />
                    </div>
                    <div class="col-span-4">
                        <legend class="fieldset-legend">Date</legend>
                        <input type="date" class="input w-full" required name="date" value="{{ $ticket->date }}" readonly />
                    </div>
                    <div class="col-span-4">
                        <legend class="fieldset-legend">Status</legend>
                        <div class="flex flex-wrap items-center gap-6">
                            @foreach($status as $s)
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input name="status"
                                    value="{{ $s['id'] }}"
                                    type="radio"
                                    {{ $ticket->status == $s['id'] ? 'checked' : '' }}
                                    class="radio radio-primary" />
                                <span class="label-text font-medium group-hover:text-primary transition-colors">
                                    {{ $s['description'] }}
                                </span>
                            </label>
                            @endforeach
                        </div>

                    </div>
                    <div class="col-span-6">
                        <legend class="fieldset-legend">User Request</legend>
                        <select class="select2-laravel w-full" name="user_request_id" disabled>
                            <option value="">Choose User</option>
                            @foreach($account as $a)
                            <option {{ $ticket->user_request == $a['id_number']?'selected':'' }} value="{{ $a['id_number'] }}">{{ $a['id_number'] }} - {{ $a['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-6">
                        <legend class="fieldset-legend">Category</legend>
                        <select class="select2-laravel w-full" name="category_id" {{$ticket->category_id?'disabled':''}}>
                            <option value="">Choose Category</option>
                            @foreach($category as $c)
                            <option {{ $ticket->category_id == $c['id']?'selected':'' }} value="{{ $c['id'] }}">{{ $c['description'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12">
                        <legend class="fieldset-legend">Problem Description</legend>
                        <textarea class="input w-full" name="problem_description" readonly>{{ $ticket->problem_description }}</textarea>
                    </div>
                    <div class="col-span-12">
                        <legend class="fieldset-legend">Note</legend>
                        <textarea class="input input-error w-full" name="note" placeholder="Type here" required>{{ $ticket->note }}</textarea>
                    </div>
                    <div class="col-span-6">
                        <button name="update" class="btn bg-primary w-full text-white">Update</button>
                    </div>
                    <div class="col-span-6">
                        <button onclick="if(confirm('Apakah Anda yakin ingin membatalkan tiket?')) { window.location.href='{{ route('ticket.index') }}'; }" name="cancel" class="btn bg-error w-full text-white">Cancel Tiket</button>
                    </div>

                </fieldset>
            </form>


        </div>

    </div>
</main>
@include('layouts.footer')