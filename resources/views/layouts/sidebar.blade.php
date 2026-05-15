<!-- Drawer Container -->
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <!-- Sidebar Side -->
    <div class="drawer-side">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>

        <ul class="menu p-4 w-80 min-h-full bg-base-100 text-base-content border-r border-base-300">
            <!-- Header Sidebar / Logo -->
            <li class="mb-5">
                <div class="text-2xl font-bold flex items-center gap-2 text-blue-600">
                    <span class="p-2 bg-blue-600 text-white rounded-lg">🚀</span>
                    Helpdesk IT
                </div>
            </li>

            <!-- Menu Items -->
            <li>
                <a href="/dashboard" class="flex gap-3 {{ request()->is('dashboard') ? 'active' : '' }} text-lg">
                    <span class="fas fa-home"></span>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('ticket.index') }}" class="flex gap-3 text-lg">
                    <span class="fas fa-list-check"></span>
                    Ticket
                </a>
            </li>
            <li>
                <details class="text-lg">
                    <summary>
                        <i class="fa-solid fa-dashboard w-5"></i>
                        Master Data
                    </summary>
                    <ul>
                        <li><a href="/laporan/harian">Akun</a></li>
                        <li><a href="/laporan/bulanan">Aset</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details class="text-lg">
                    <summary>
                        <i class="fa-solid fa-file-invoice w-5"></i>
                        Laporan
                    </summary>
                    <ul>
                        <li><a href="/laporan/harian">Laporan Harian</a></li>
                        <li><a href="/laporan/bulanan">Laporan Bulanan</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <a href="/settings" class="flex gap-3 text-lg">
                    <span class="fas fa-gear"></span>
                    Pengaturan
                </a>
            </li>

            <!-- Separator -->
            <div class="divider"></div>

            <!-- Logout Button -->
            <li class="text-lg">
                <div class="grid">
                    <div class="col-span-12 w-full ">
                        <form action="{{ route('proses-logout') }}" method="POST" class="p-0">
                            @csrf
                            <button type="submit" class="bg-red-400 justify-center flex gap-3 text-white h-10 w-full p-1  rounded-lg ">
                                Logout
                            </button>
                        </form>

                    </div>
                </div>
            </li>
        </ul>
    </div>

    <!-- Content Halaman -->
    <div class="drawer-content flex flex-col">

        <!-- Navbar (Hanya muncul di Mobile untuk buka Sidebar) -->
        <div class="navbar bg-base-100 w-full lg:hidden shadow-sm">
            <div class="flex-none">
                <label for="my-drawer" class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>
            <div class="flex-1 px-2 mx-2 font-bold">Helpdesk IT</div>
        </div>