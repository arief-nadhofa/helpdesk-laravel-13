@include('layouts.header-client')

<main class="p-8 bg-base-200">
    <div class="grid grid-cols-12 mt-5">
        @if(session('success'))
        <div class="toast toast-top toast-end">
            <div class="alert alert-success text-white">
                <span>{{ session('success') }}</span>
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
        <div class="col-span-6 mr-4">
            <div class="overflow-x-auto bg-base-100 p-5 rounded-box shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Data Ticket</h2>
                </div>

                <table class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr class="text-base-content">
                            <th>No.</th>
                            <th>Status</th>
                            <th>No. Ticket</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Created At</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ticket as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($t['status'] == 1)
                                <span class="badge badge-error gap-2 text-white">
                                    Open
                                </span>
                                @elseif($t['status'] == 2)
                                <span class="badge badge-warning gap-2 text-white">
                                    Assign
                                </span>
                                @elseif($t['status'] == 3)
                                <span class="badge badge-info gap-2 text-white">
                                    On Progress
                                </span>
                                @else
                                <span class="badge badge-error gap-2 text-white">
                                    Close
                                </span>
                                @endif
                            </td>
                            <td>{{ $t['ticket_number'] }}</td>
                            <td>
                                {{ $t['category_id']? $t->category->description:'-' }}
                            </td>

                            <td>{{ date('d M Y',strtotime($t['date'])) }}</td>
                            <td>{{ date('d M Y H:i:s',strtotime($t['created_at'])) }}</td>
                            <td class="text-center">

                                <a href="{{ route('ticket.edit',$t['id']) }}" class="btn bg-primary text-white">
                                    <span class="fa-solid fa-info"></span>
                                </a>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <!-- Pagination Sederhana -->
                <div class="flex justify-end mt-4">
                    <div class="join">
                        <button class="join-item btn btn-sm">«</button>
                        <button class="join-item btn btn-sm btn-active">1</button>
                        <button class="join-item btn btn-sm">2</button>
                        <button class="join-item btn btn-sm">»</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-6 ">
            <div class="overflow-x-auto bg-base-100 p-5 rounded-box shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <div class="float-start">
                        <h2 class="text-xl font-bold">Create Ticket</h2>
                    </div>
                    <div class="float-end">
                        <h2 class="text-xl font-bold">Halo, 1225 - Arief!</h2>

                    </div>
                </div>
                <div class="divider"></div>
                <form action="{{ route('store-client') }}" method="POST">
                    @csrf
                    <fieldset class="fieldset grid grid-cols-12 gap-4">

                        <div class="col-span-12">
                            <legend class="fieldset-legend">Ticket No.</legend>

                            <input type="text" name="ticket_number" class="input w-full" value="{{ $ticketNumber }}" readonly />
                        </div>

                        <div class="col-span-12">
                            <legend class="fieldset-legend">Problem Description</legend>
                            <textarea class="input w-full h-25" placeholder="Type problem here..." required name="problem_description" autofocus></textarea>
                        </div>
                        <div class="col-span-12">
                            <button class="btn bg-primary w-full text-white">Create</button>
                        </div>

                    </fieldset>
                </form>


            </div>
        </div>

    </div>
</main>
@include('layouts.footer')