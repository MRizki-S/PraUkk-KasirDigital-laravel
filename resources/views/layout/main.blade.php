<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')

    {{-- link  icon fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- cdn flowbite --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    {{-- font poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">


    {{-- sweet alert cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f6f6f6;
            font-family: 'Poppins', sans-serif;
        }
    </style>


</head>

<body class="min-h-screen">
    <div class="flex flex-col ">
        <div class="bg-white flex justify-between py-5 px-8 w-full shadow-xl z-30">
            <h2 class="text-2xl text-blue-800 font-bold">Hotel Prima</h2>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 border border-gray-700"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full"
                        src="https://as2.ftcdn.net/v2/jpg/00/64/67/27/1000_F_64672736_U5kpdGs9keUll8CRQ3p3YaEv2M6qkVY5.jpg"
                        alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span
                            class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->nama_lengkap }}</span>
                        <span
                            class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="logout"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</a>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="navbar-user" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="w-full flex gap-5 min-h-screen">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-lg py-5 px-7">
                <!-- Sidebar Links -->
                <nav class="space-y-6">

                    <!-- Main Menu Section -->
                    <div>
                        <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Main Menu</h3>
                        <div class="mt-2 space-y-4">
                            <a href="dashboard"
                                class="flex items-center text-gray-700 p-3 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200"
                                title="Dashboard - View overall system information">
                                <i class="fa-solid fa-house text-xl"></i>
                                <span class="ml-4">Dashboard</span>
                            </a>
                        </div>
                    </div>

                    <!-- Product Management Section -->
                    <div>
                        <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Management</h3>
                        <div class="mt-2 space-y-4">
                            <a href="/tipe-kamar"
                                class="flex items-center text-gray-700 p-3 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200"
                                title="Produk - Manage your products">
                                <i class="fa-solid fa-stream text-xl"></i>
                                <span class="ml-4">Tipe Kamar</span>
                            </a>
                        </div>
                        <div class="mt-2 space-y-4">
                            <a href="/kamar"
                                class="flex items-center text-gray-700 p-3 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200"
                                title="Produk - Manage your products">
                                <i class="fa-solid fa-box text-xl"></i>
                                <span class="ml-4">Kamar</span>
                            </a>
                        </div>
                    </div>

                    <!-- Fasilitas-->
                    @if (Auth::user()->role == 'admin')
                    <div>
                        <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Fasilitas</h3>
                        <div class="mt-2 space-y-4">
                            <a href="/fasilitas"
                                class="flex items-center text-gray-700 p-3 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200"
                                title="Penjualan - Track your sales">
                                <i class="fa-solid fa-th-list text-xl"></i>
                                <span class="ml-4">Fasilitas</span>
                            </a>
                            {{-- <a href="/fasilitas-kamar"
                                class="flex items-center text-gray-700 p-3 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200"
                                title="Pelanggan - Manage your customers">
                                <i class="fa-solid fa-tags text-xl"></i>
                                <span class="ml-4">Fasilitas Kamar</span>
                            </a> --}}
                        </div>
                    </div>
                    @endif

                    <!-- Admin Section -->
                    <div>
                        <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Reservasi</h3>
                        <div class="mt-2 space-y-4">
                            <a href="/reservasi"
                                class="flex items-center text-gray-700 p-3 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200"
                                title="Registration - Add or manage users">
                                <i class="fa-solid fa-address-card text-xl"></i>
                                <span class="ml-4">Reservasi</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </aside>


            {{-- main content --}}
            <div class="container bg-limea-300 px-5 py-8">
                @yield('content')
            </div>
        </div>


        {{-- js flowbite --}}
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

        {{-- js --}}
        <script>
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 3000 // Notifikasi akan hilang otomatis dalam 3 detik
                });
            @elseif (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ Session::get('error') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        </script>


        {{-- js jquery untuk select 2 --}}
        {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script> --}}
        {{-- js select 2 --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

</body>

</html>
