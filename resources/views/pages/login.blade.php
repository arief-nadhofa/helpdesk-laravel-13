<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - My App</title>
    @vite('resources/css/app.css')
</head>
<!-- Grid/Flex center setup dengan background biru -->

<body class="min-h-screen flex items-center justify-center bg-gray-200 px-4">

    <!-- Card Container -->
    <div class="card w-full max-w-md bg-base-100 shadow-2xl overflow-hidden">
        <div class="card-body p-8">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Selamat Datang</h2>
                <p class="text-sm text-gray-500 mt-2">Silakan masuk ke akun Anda</p>
            </div>

            <form action="{{ route('proses-login') }}" method="POST">
                @csrf
                <!-- Email Input -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Account Laptop</span>
                    </label>
                    <input type="text" placeholder="arief.nadhofa" class="input input-bordered focus:input-primary w-full" required autofocus />
                </div>

                <!-- Password Input -->
                <div class="form-control w-full mt-4">
                    <label class="label">
                        <span class="label-text font-semibold">Password</span>
                    </label>
                    <input type="password" placeholder="••••••••" class="input input-bordered focus:input-primary w-full" required />
                    <label class="label mt-1">
                        <a href="#" class="label-text-alt link link-hover text-blue-600">Lupa password?</a>
                    </label>
                </div>

                <!-- Login Button -->
                <div class="form-control mt-8">
                    <button type="submit" class="btn btn-primary text-white border-none bg-blue-600 hover:bg-blue-700 w-full">
                        Login
                    </button>
                </div>
            </form>

        </div>
    </div>

</body>

</html>