@include('layouts.header')
@include('layouts.sidebar')
<!-- Area Konten Utama -->
<main class="p-8 bg-base-200 min-h-screen">

    <div class="grid grid-cols-12 ">
        <div class="col-span-12">
            <div class="breadcrumbs text-sm float-end">
                <ul>
                    <li>
                        <span class="badge bg-gray-300 ">Ticket</span>
                    </li>
                    <li>
                        <span class="badge bg-blue-400 text-white">List</span>
                    </li>

                </ul>
            </div>
        </div>
    </div>

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

    <div class="grid mt-5">
        <div class="overflow-x-auto bg-base-100 p-5 rounded-box shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Data Ticket</h2>
                <button class="btn btn-primary btn-sm">
                    <a href="{{ route('ticket.create') }}">
                        <i class="fa-solid fa-plus"></i> Tambah Data
                    </a>
                </button>
            </div>

            <table class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr class="text-base-content">
                        <th>No.</th>
                        <th>No. Ticket</th>
                        <th>Category</th>
                        <th>Request From</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ticket as $t)

                    <tr class="hover">
                        <td>{{ $loop->iteration }}</td>
                        <td>

                            <div class="flex items-center gap-3">
                                <div>
                                    <div class="font-bold">{{ $t['ticket_number'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ $t['category_id'] }}
                        </td>
                        <td>
                            {{ $t['user_request'] }} - {{ $t->account->name }}
                        </td>
                        <td>
                            @if($t['status']==0)
                            <span class="badge badge-success gap-2 text-white">
                                Open
                            </span>
                            @else
                            <span class="badge badge-error gap-2 text-white">
                                Close
                            </span>
                            @endif
                        </td>
                        <td>{{ $t['created_at'] }}</td>
                        <td class="text-center">

                            <form action="{{ route('ticket.destroy', $t['id']) }}"
                                method="POST"
                                class="delete-form flex items-center gap-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tiket?')">
                                <a href="#" class="btn bg-yellow-400 text-white">
                                    <span class="fa-solid fa-pen-to-square"></span>
                                </a>


                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn bg-red-400 text-white">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <!-- row 1 -->


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

        <dialog id="my_modal_1" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Tambah Data</h3>
                <form method="dialog" class="mt-5">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Account Laptop</span>
                        </label>
                        <input type="text" placeholder="arief.nadhofa" class="input input-bordered focus:input-primary w-full" required autofocus />
                    </div>
                    <button class="mt-5 w-full btn bg-primary text-white">Simpan</button>
                </form>
            </div>
        </dialog>

    </div>
</main>
@include('layouts.footer')