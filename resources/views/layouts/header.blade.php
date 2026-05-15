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