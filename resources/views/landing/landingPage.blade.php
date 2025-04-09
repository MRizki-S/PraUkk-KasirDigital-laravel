<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Prima</title>

    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    {{-- link  icon fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- cdn flowbite --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    {{-- font poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    {{-- sweet alert cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        /* height: 3000px; */
    }

    html {
        scroll-behavior: smooth;
    }
</style>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="bg-white bg-opacity-20 shadow-lg p-4  z-50 fixed  top-0 w-full left-0 right-0">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a class="text-yellow-500 font-bold text-2xl hover:text-yellor-200" href="#">Hotel Prima</a>
            </div>

            <!-- Mobile menu button -->
            <button class="text-yellor-800 hover:text-yellor-200 lg:hidden" aria-label="Toggle navigation">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5h14M3 10h14M3 15h14" clip-rule="evenodd"></path>
                </svg>
            </button>

            <!-- Navbar links -->
            <div class="hidden lg:flex lg:items-center lg:space-x-10">

                <a href="{{ Request::is('pesan-sekarang') || Request::is('aksiPesan-sekarang') ? '/#home' : '#home' }}"
                    class="flex flex-col items-center text-gray-500 font-normal hover:text-gray-900 text-xs">
                    <i class="fas fa-stream text-xl mb-1 hover:scale-105 hover:rotate-6 transition duration-500"></i>
                    Home
                </a>


                <a href="{{ Request::is('pesan-sekarang') || Request::is('aksiPesan-sekarang') ? '/#tipe-kamar' : '#tipe-kamar' }}"
                    class="flex flex-col items-center text-gray-500 font-normal hover:text-gray-900 text-xs">
                    <i class="fas fa-images text-xl mb-1 hover:scale-105 hover:rotate-6 transition duration-500"></i>
                    Kamar
                </a>
                <a href="{{ Request::is('pesan-sekarang') || Request::is('aksiPesan-sekarang') ? '/#fasilitas' : '#fasilitas' }}"
                    class="flex flex-col items-center text-gray-500 font-normal hover:text-gray-900 text-xs">
                    <i class="fas fa-scroll text-xl mb-1 hover:scale-105 hover:rotate-6 transition duration-500"></i>
                    Fasilitas
                </a>
                {{-- @if (Auth::user() && Auth::user()->role_id == 1) --}}
                {{-- <a href="/fasilitas"
                        class="flex flex-col items-center text-gray-500 font-normal hover:text-gray-900 text-xs">
                        <i
                            class="fas fa-images text-xl mb-1 hover:scale-105 hover:rotate-6 transition duration-500"></i>
                        Fasilitas
                    </a> --}}
                {{-- <a href="/users"
                        class="flex flex-col items-center text-gray-500 font-normal hover:text-gray-900 text-xs">
                        <i class="fas fa-users text-xl mb-1 hover:scale-105 hover:rotate-6 transition duration-500"></i>
                        Users
                    </a> --}}
                {{-- @endif --}}
                {{-- <a href="/profile"
                    class="flex flex-col items-center text-gray-500 font-normal hover:text-gray-900 text-xs">
                    <i class="fas fa-user text-xl mb-1 hover:scale-105 hover:rotate-6 transition duration-500"></i>
                    Profile
                </a> --}}
            </div>

            <!-- Logout Button -->

            @if (Auth::user())
                <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                    data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer"
                    src="{{ Auth::user()->profile ? asset('storage/profile/' . Auth::user()->profile) : asset('assets/images/guest-profile.png') }}"
                    alt="User dropdown">

                <!-- Dropdown menu -->
                <div id="userDropdown"
                    class="hidden bg-white divide-y divide-black-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600 z-50 absolute">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        @if (Auth::user())
                            <div>{{ Auth::user()->nama_lengkap }}</div>
                            <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                        @else
                            <div>Guest</div>
                            <div class="font-medium truncate">guest@example.com</div>
                        @endif
                    </div>
                    {{-- <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">users</a>
                        </li>
                    </ul> --}}
                    <div class="py-1">
                        <a href="/logout"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Log
                            out</a>
                    </div>
                </div>
            @else
                <a href="/login"
                    class="bg-yellow-500 text-white font-semibold px-3 py-1 rounded-lg hover:bg-yellor-400 ml-4">
                    Login
                </a>
            @endif



        </div>
    </nav>

    {{-- content --}}
    <div>
        {{-- class="container relative mx-auto flex flex-col lg:flex-row justify-center bg-slate-700a space-y-4 lg:space-y-0 py-5 mt-20"> --}}

        @yield('content')
        <!-- Center Container (Larger) -->
        {{-- <div class="w-full lg:flex-1 lg:max-w-[800px] py-0 px-0">
            @yield('content')
        </div> --}}

        <!-- Right Container (Smaller, Fixed Sidebar) -->
        {{-- <div
            class="lg:max-w-[350px] w-full bg-white shadow-lg rounded-lg p-6 z-40 lg:fixed lg:right-5 lg:top-[86px] text-center border-2 border-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600">
            @if (Auth::user())
            <!-- User Avatar -->
            <img class="rounded-full w-24 h-24 mx-auto mb-4 border-4 border-yellor-500 shadow-md"
                src="{{Auth::user()->profile ? asset('storage/profile/' . Auth::user()->profile) : asset('assets/images/guest-profile.png') }}"
                alt="User Avatar">

            <!-- User Info -->
                <p class="text-xl font-semibold text-gray-800 dark:text-white mb-">{{ Auth::user()->nama_lengkap }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">{{ Auth::user()->email }}</p>

                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                    Welcome back, {{ Auth::user()->full_name }}! Access your profile, monitor recent activity, and
                    explore new features here.
                </p>

                <a href="/logout"
                    class="block bg-yellor-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-yellor-400 transform transition duration-300 ease-in-out">
                    Logout
                </a>
            @else
            <img class="rounded-full w-24 h-24 mx-auto mb-4 border-4 border-yellor-500 shadow-md"
            src="{{ asset('assets/images/guest-profile.png')}}"
            alt="User Avatar">

                <p class="text-xl font-semibold text-gray-800 dark:text-white mb-">Guest</p>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">guest@example.com</p>
                <a href="/login"
                    class="block bg-yellor-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-yellor-400 transform transition duration-300 ease-in-out">
                    login
                </a>
                <a href="/register"
                    class="block mt-2 border border-yellor-500 text-yellor-500 hover:text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-yellor-500 transform transition duration-300 ease-in-out">
                    Register
                </a>
            @endif

            <!-- Logout Button -->

        </div> --}}

    </div>



    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>

</html>
