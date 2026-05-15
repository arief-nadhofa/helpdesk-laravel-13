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
                        <span class="badge bg-blue-400 text-white">Create</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="grid mt-5">
        <div class="overflow-x-auto bg-base-100 p-5 rounded-box shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Create Ticket</h2>
            </div>
            <div class="divider"></div>
            <form action="{{ route('ticket.store') }}" method="POST">
                @csrf
                <fieldset class="fieldset grid grid-cols-12 gap-4">

                    <div class="col-span-3">
                        <legend class="fieldset-legend">Ticket No.</legend>

                        <input type="text" name="ticket_number" class="input w-full" placeholder="Type here" readonly />
                    </div>
                    <div class="col-span-3">
                        <legend class="fieldset-legend">Date</legend>
                        <input type="date" class="input w-full" required name="date" />
                    </div>
                    <div class="col-span-3">
                        <legend class="fieldset-legend">User Request</legend>
                        <select class="select2-laravel w-full" name="user_request_id">
                            <option value="">Choose User</option>
                            @foreach($account as $a)
                            <option value="{{ $a['id_number'] }}">{{ $a['id_number'] }} - {{ $a['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-3">
                        <legend class="fieldset-legend">Category</legend>
                        <select class="select" name="category_id">
                            <option disabled selected>Select Category</option>
                            <option value="laptop">Laptop</option>
                            <option value="computer">Computer</option>
                            <option value="system">System</option>
                            <option value="network">Network</option>
                            <option value="vpn">VPN</option>
                        </select>
                    </div>
                    <div class="col-span-12">
                        <legend class="fieldset-legend">Problem Description</legend>
                        <textarea class="input w-full" placeholder="Type problem here..." required name="problem_description"></textarea>
                    </div>
                    <div class="col-span-12">
                        <button class="btn bg-primary w-full text-white">Create</button>
                    </div>

                </fieldset>
            </form>


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