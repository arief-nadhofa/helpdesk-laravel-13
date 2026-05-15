@include('layouts.header')
@include('layouts.sidebar')
<!-- Area Konten Utama -->
<main class="p-8 bg-base-200 min-h-screen max-w-full">

    <div class="grid grid-cols-12 ">
        <div class="col-span-12">
            <div class="breadcrumbs text-sm float-end">
                <ul>
                    <li>
                        <span class="badge bg-gray-300 ">Master Data</span>
                    </li>
                    <li>
                        <span class="badge bg-gray-300 ">
                            <a href="{{ route('account.index') }}">Account</a>
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
                <h2 class="text-xl font-bold">Add Account</h2>
            </div>
            <div class="divider"></div>
            <form action="{{ route('account.store') }}" method="POST">
                @csrf
                <fieldset class="fieldset grid grid-cols-12 gap-4">
                    <div class="col-span-3">
                        <legend class="fieldset-legend">ID Number</legend>
                        <input type="text" class="input w-full" required name="id_number" placeholder="Type here..." autofocus />
                    </div>
                    <div class="col-span-3">
                        <legend class="fieldset-legend">Full Name</legend>
                        <input type="text" class="input w-full" required name="name" placeholder="Type here..." />
                    </div>
                    <div class="col-span-3">
                        <legend class="fieldset-legend">LDAP</legend>
                        <input type="text" class="input w-full" required name="ldap" placeholder="Type here..." />
                    </div>
                    <div class="col-span-3">
                        <legend class="fieldset-legend">Role</legend>
                        <input type="text" class="input w-full" required name="role" placeholder="Type here..." />
                    </div>
                    <div class="col-span-6">
                        <legend class="fieldset-legend">Username</legend>
                        <input type="text" name="username" class="input w-full" placeholder="Type here" required />
                    </div>
                    <div class="col-span-6">
                        <legend class="fieldset-legend">Password</legend>
                        <input type="password" class="input w-full" required name="password" placeholder="*********" />
                    </div>

                    <div class="col-span-12">
                        <button class="btn bg-primary w-full text-white">Create</button>
                    </div>

                </fieldset>
            </form>


        </div>

    </div>
</main>
@include('layouts.footer')