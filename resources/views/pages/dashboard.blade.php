@include('layouts.header')
@include('layouts.sidebar')
<!-- Area Konten Utama -->
<main class="p-8 bg-base-200 min-h-screen">

    <div class="stats shadow">
        <div class="stat bg-green-200">
            <div class="stat-title text-xl">Ticket</div>
            <div class="stat-value">89,400</div>
        </div>
    </div>
    <div class="stats shadow">
        <div class="stat bg-yellow-200">
            <div class="stat-title text-xl">Ticket</div>
            <div class="stat-value">89,400</div>
        </div>
    </div>
    <div class="stats shadow">
        <div class="stat bg-red-200">
            <div class="stat-title text-xl">Ticket</div>
            <div class="stat-value">89,400</div>
        </div>
    </div>
    <div class="grid mt-5">
        <div class="card shadow">
            <div class="stat bg-white">
                <div class="stat-value">Welcome!</div>
            </div>
        </div>

    </div>
    <div class="grid mt-5">
        <div class="overflow-x-auto bg-base-100 p-5 rounded-box shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Data Pengguna</h2>
                <button class="btn btn-primary btn-sm" onclick="my_modal_1.showModal()">
                    <i class="fa-solid fa-plus"></i> Tambah Data
                </button>
            </div>

            <table class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr class="text-base-content">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Pekerjaan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr class="hover">
                        <td>1.</td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div>
                                    <div class="font-bold">John Doe</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            IT Programmer
                        </td>
                        <td>
                            <span class="badge badge-success gap-2 text-white">
                                Aktif
                            </span>
                        </td>
                        <th class="text-center">
                            <div class="join">
                                <button class="btn join-item text-info">
                                    <span class="fa-solid fa-pen-to-square"></span>
                                </button>
                                <button class="btn join-item text-error">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </th>
                    </tr>


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