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
                <a href="/dashboard" class="flex gap-3 {{ request()->is('dashboard') ? 'active' : '' }}">
                    <span class="fas fa-home"></span>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="/users" class="flex gap-3">
                    <span class="fas fa-file"></span>
                    Ticket
                </a>
            </li>
            <li>
                <details>
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
                <details>
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
                <a href="/settings" class="flex gap-3">
                    <span class="fas fa-gear"></span>
                    Pengaturan
                </a>
            </li>

            <!-- Separator -->
            <div class="divider"></div>

            <!-- Logout Button -->
            <li>
                <form action="{{ route('proses-logout') }}" method="POST" class="p-0">
                    @csrf
                    <button type="submit" class="flex gap-3 text-error w-full p-3 hover:bg-error/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
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