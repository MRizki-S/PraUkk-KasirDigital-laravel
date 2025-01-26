@extends('layout.main')

@section('title', 'Users')
@section('content')
    <h3 class="text-2xl text-gray-700 font-semibold">Users</h3>
    <p class=" text-gray-500 border-b">Home / Users </p>
    {{-- {{ $user }} --}}
    <div class="container bg-white mt-5 py-4 rounded-md shadow-md overflow-x-auto">
        <div
            class="flex items-center justify-end flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 px-4 bg-white dark:bg-gray-900">
            {{-- search --}}
            {{-- <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="text" id="table-search-users"
                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for users">
            </div> --}}

            {{-- tambah data --}}
            <a href="#" type="button" data-modal-target="tambahUsersModal" data-modal-show="tambahUsersModal"
                class="text-white bg-blue-500 hover:bg-blue-600 transition  rounded-lg px-4 py-2">Tambah
                Data</a>
        </div>
        {{-- table --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 mx-2">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Username
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Lengkap
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-100 dark:border-gray-50 hover:bg-gray-100 dark:hover:bg-gray-100">
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->username }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->nama_lengkap }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->role }}
                        </td>
                        <td class="px-6 py-4 flex gap-2 flex-wrap">
                            <!-- Modal toggle -->
                            <a href="#" type="button" data-modal-target="editUserModal-{{ $item->id }}"
                                data-modal-show="editUserModal-{{ $item->id }}"
                                class="font-medium text-yellow-600 text-xl dark:text-yellow-500 hover:underline">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            @if ($item->role == 'petugas')
                            <a href="#" type="button" data-modal-target="deleteUserModal-{{ $item->id }}"
                                data-modal-show="deleteUserModal-{{ $item->id }}"
                                class="font-medium text-red-600 text-xl dark:text-red-500 hover:underline">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


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




{{-- modal tambah data Users --}}
<div id="tambahUsersModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form class="relative bg-white rounded-lg shadow dark:bg-gray-700" action="/registration" method="POST">
            @csrf

            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Register
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="tambahUsersModal">
                    <i class="fa-solid fa-x"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                    <input type="text" id="username" name="username" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                           placeholder="Enter your username" value="{{ old('username') }}">
                    @error('username')
                           <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nama_lengkap" class="block text-gray-700 font-medium mb-2">Full name</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                           placeholder="Enter your full name" value="{{ old('nama_lengkap') }}">
                    @error('nama_lengkap')
                       <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <input type="email" id="email" name="email" reqsuired
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                           placeholder="Enter your email" value="{{ old('email') }}">
                    @error('email')
                       <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" requiredaa
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                           placeholder="Enter your password" value="{{ old('password') }}">
                    @error('password')
                       <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
            </div>
        </form>
    </div>
</div>


{{-- modal edit data user --}}
@foreach ($user as $item)
<div id="editUserModal-{{$item->id}}" tabindex="-1" aria-hidden="true"
class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form class="relative bg-white rounded-lg shadow dark:bg-gray-700" action="/editUser/{{$item->id}}" method="POST">
            @method('put')
            @csrf

            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit User
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="editUserModal-{{$item->id}}">
                    <i class="fa-solid fa-x"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                    <input type="text" id="username" name="username" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                           placeholder="Enter your username" value="{{ $item->username }}">
                    @error('username')
                           <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nama_lengkap" class="block text-gray-700 font-medium mb-2">Full name</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                           placeholder="Enter your full name" value="{{ $item->nama_lengkap }}">
                    @error('nama_lengkap')
                       <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <input type="email" id="email" name="email" reqsuired
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                           placeholder="Enter your email" value="{{ $item->email }}">
                    @error('email')
                       <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-gray-700 font-medium mb-2">role</label>
                    <input type="role" id="role" name="role" requiredaa
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-300 text-gray-400"
                           placeholder="Enter your role" value="{{$item->role}}" readonly>
                    @error('role')
                       <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button"
                class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800" data-modal-hide="editUserModal-{{$item->id}}">Cancel</button>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ubah</button>
            </div>
        </form>
    </div>
</div>
@endforeach



{{-- modal delete data user --}}
@foreach ($user as $item)
<div id="deleteUserModal-{{$item->id}}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                {{-- <h3 class="text-xl font-semibold text-gray-600 dark:text-white">
                    Delete user
                </h3> --}}
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="deleteUserModal-{{$item->id}}">
                    <i class="fa-solid fa-x"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="flex items-center justify-center space-x-4">
                    <i class="fa-solid fa-triangle-exclamation text-yellow-500 text-5xl"></i>
                    <p class="text-gray-700 dark:text-white">Apakah Anda yakin ingin menghapus user ini?</p>
                </div>
            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                <a href="/deleteUser/{{$item->id}}"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Ya, Delete</a>
                <button type="button"
                    class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800"
                    data-modal-hide="deleteUserModal-{{$item->id}}">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endforeach




@endsection
