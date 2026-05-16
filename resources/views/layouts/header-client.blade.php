<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')

    <style>
        /* 1. Mengatur tinggi dan border agar tipis (1px) */
        .select2-container--default .select2-selection--single {
            height: 2.5rem !important;
            /* Samakan dengan tinggi input date */
            min-height: 2.5rem !important;
            @apply input input-bordered !important;
            /* Ambil base style dari DaisyUI */
            border-width: 1px !important;
            /* Paksa border jadi tipis */
            border-color: #d2d4d7 !important;
            /* Warna border standar Tailwind/DaisyUI */
        }

        /* 2. Menghapus bayangan atau outline tebal saat fokus */
        .select2-container--default.select2-container--focus .select2-selection--single {
            @apply border-primary !important;
            outline: none !important;
        }

        /* 3. Menyesuaikan teks agar berada di tengah secara vertikal */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.5rem !important;
            padding-left: 1rem !important;
            /* Jarak teks dari kiri */
            color: currentColor !important;
        }

        /* 4. Menyesuaikan posisi panah dropdown */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 2rem !important;
            top: 0 !important;
            right: 0.75rem !important;
        }
    </style>
</head>

<body>

    <div class="navbar bg-base-100 shadow-sm">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul
                    tabindex="-1"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    <li><a>Item 1</a></li>
                    <li>
                        <a>Parent</a>
                        <ul class="p-2">
                            <li><a>Submenu 1</a></li>
                            <li><a>Submenu 2</a></li>
                        </ul>
                    </li>
                    <li><a>Item 3</a></li>
                </ul>
            </div>
            <a class="btn btn-ghost text-xl">Helpdesk IT</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="{{ route('dashboard-client') }}">Dashboard</a></li>
                <li><a href="#">Cari Tiket</a></li>

            </ul>
        </div>
        <div class="navbar-end">
            <form action="{{ route('proses-logout') }}" method="POST" class="p-0">
                @csrf
                <button class="btn bg-error text-white">Logout</button>
            </form>
        </div>
    </div>