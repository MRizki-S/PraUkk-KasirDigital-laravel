@extends('layout.main')

@section('title', 'Fasilitas Kamar')
@section('content')
    <h3 class="text-2xl text-gray-700 font-semibold">Fasilitas Kamar</h3>
    <p class=" text-gray-500 border-b">Home / Fasilitas Kamar</p>
    {{-- {{ $fasilitas }} --}}
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
                    placeholder="Search for produk">
            </div> --}}

            {{-- tambah data --}}
            <a href="#" type="button" data-modal-target="tambahFasilitas" data-modal-show="tambahFasilitas"
                class="text-white bg-blue-500 hover:bg-blue-600 transition  rounded-lg px-4 py-2">Tambah
                Data</a>
        </div>
        {{-- table --}}
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Tipe Kamar</th>
                    <th scope="col" class="px-6 py-3">Fasilitas</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupFasilitas as $tipeKamar => $fasilitas)
                    <tr class="bg-gray-200">
                        <td class="px-6 py-3 font-semibold text-gray-900" colspan="3">
                            {{ $tipeKamar }} <!-- Nama tipe kamar sebagai header -->
                        </td>
                        @foreach ($fasilitas as $item)
                        <td class="px-6 py-3 font-semibold text-gray-900" colspan="3">
                            {{ $item->nama }} <!-- Nama tipe kamar sebagai header -->
                        </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
