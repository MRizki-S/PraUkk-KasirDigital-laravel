@extends('layout.main')

@section('title', 'Pelanggan')
@section('content')
    <h3 class="text-2xl text-gray-700 font-semibold">Pelanggan</h3>
    <p class=" text-gray-500 border-b">Home / Pelanggan </p>
    {{-- {{ $pelanggan }} --}}
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
            <a href="#" type="button" data-modal-target="tambahPelangganModal" data-modal-show="tambahPelangganModal"
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
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alamat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        No Telepon
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelanggan as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-100 dark:border-gray-50 hover:bg-gray-100 dark:hover:bg-gray-100">
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->nama_pelanggan }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->alamat }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->no_telepon }}
                        </td>
                        <td class="px-6 py-4 flex gap-2 flex-wrap">
                            <!-- Modal toggle -->
                            <a href="#" type="button" data-modal-target="editPelangganModal-{{ $item->id }}"
                                data-modal-show="editPelangganModal-{{ $item->id }}"
                                class="font-medium text-yellow-600 text-xl dark:text-yellow-500 hover:underline">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="#" type="button" data-modal-target="deletePelangganModal-{{ $item->id }}"
                                data-modal-show="deletePelangganModal-{{ $item->id }}"
                                class="font-medium text-red-600 text-xl dark:text-red-500 hover:underline">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                            <a href="#" type="button" data-modal-target="detailPelangganModal-{{ $item->id }}"
                                data-modal-show="detailPelangganModal-{{ $item->id }}"
                                class="font-medium text-blue-600 text-xl dark:text-blue-500 hover:underline">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection



{{-- modal tambah data Pelanggan --}}
<div id="tambahPelangganModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form class="relative bg-white rounded-lg shadow dark:bg-gray-700" action="/tambahPelanggan" method="POST">
            @csrf

            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tambah Pelanggan
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="tambahPelangganModal">
                    <i class="fa-solid fa-x"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                {{-- nama Pelanggan --}}
                <div class="mb-4">
                    <label for="nama_Pelanggan" class="block text-gray-700 font-medium mb-2">Nama Pelanggan</label>
                    <input type="nama_Pelanggan" id="nama_Pelanggan" name="nama_pelanggan" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                        placeholder="Masukan nama Pelanggan" value={{ old('nama_Pelanggan') }}>
                    @error('nama_Pelanggan')
                        <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- alamat --}}
                <div class="mb-4">
                    <label for="alamat" class="block text-gray-700 font-medium mb-2">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                        placeholder="masukan alamat" value={{ old('alamat') }}>
                    @error('alamat')
                        <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- no_telepon --}}
                <div class="mb-4">
                    <label for="no_telepon" class="block text-gray-700 font-medium mb-2">No Telepon</label>
                    <input type="number" id="no_telepon" name="no_telepon" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                        placeholder="No telepon" value={{ old('no_telepon') }}>
                    @error('no_telepon')
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





{{-- modal edit data Pelanggan --}}
@foreach ($pelanggan as $item)
<div id="editPelangganModal-{{$item->id}}" tabindex="-1" aria-hidden="true"
class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form class="relative bg-white rounded-lg shadow dark:bg-gray-700" action="/editPelanggan/{{$item->id}}" method="POST">
            @method('put')
            @csrf

            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Pelanggan
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="editPelangganModal-{{$item->id}}">
                    <i class="fa-solid fa-x"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                {{-- nama Pelanggan --}}
                <div class="mb-4">
                    <label for="nama_Pelanggan" class="block text-gray-700 font-medium mb-2">Nama Pelanggan</label>
                    <input type="text" id="nama_Pelanggan" name="nama_pelanggan" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                        placeholder="Masukan nama Pelanggan" value="{{ $item->nama_pelanggan }}">
                    @error('nama_Pelanggan')
                        <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                 {{-- alamat --}}
                 <div class="mb-4">
                    <label for="alamat" class="block text-gray-700 font-medium mb-2">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                        placeholder="masukan alamat" value="{{$item->alamat}}">
                    @error('alamat')
                        <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- no_telepon --}}
                <div class="mb-4">
                    <label for="no_telepon" class="block text-gray-700 font-medium mb-2">No Telepon</label>
                    <input type="number" id="no_telepon" name="no_telepon" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                        placeholder="No telepon" value="{{$item->no_telepon}}">
                    @error('no_telepon')
                        <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button"
                class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800" data-modal-hide="editPelangganModal-{{$item->id}}">Cancel</button>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ubah</button>
            </div>
        </form>
    </div>
</div>
@endforeach



{{-- modal delete data Pelanggan --}}
@foreach ($pelanggan as $item)
<div id="deletePelangganModal-{{$item->id}}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                {{-- <h3 class="text-xl font-semibold text-gray-600 dark:text-white">
                    Delete Pelanggan
                </h3> --}}
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="deletePelangganModal-{{$item->id}}">
                    <i class="fa-solid fa-x"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="flex items-center justify-center space-x-4">
                    <i class="fa-solid fa-triangle-exclamation text-yellow-500 text-5xl"></i>
                    <p class="text-gray-700 dark:text-white">Apakah Anda yakin ingin menghapus Pelanggan ini?</p>
                </div>
            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                <a href="/deletePelanggan/{{$item->id}}"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Ya, Delete</a>
                <button type="button"
                    class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800"
                    data-modal-hide="deletePelangganModal-{{$item->id}}">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Modal Detail Data Pelanggan --}}
@foreach ($pelanggan as $item)
<div id="detailPelangganModal-{{$item->id}}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal content -->

        <!-- Modal header -->
        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Detail Pelanggan
            </h3>
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="detailPelangganModal-{{$item->id}}">
                <i class="fa-solid fa-x"></i>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

        <!-- Modal body -->
        <div class="p-6 space-y-6">
            {{-- Nama Pelanggan --}}
            <div class="mb-4">
                <label for="nama_Pelanggan" class="block text-gray-700 font-medium mb-2">Nama Pelanggan</label>
                <input type="text" id="nama_Pelanggan" name="nama_pelanggan" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                    placeholder="Masukan nama Pelanggan" value="{{ $item->nama_pelanggan }}" readonly>
            </div>

            {{-- Alamat --}}
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 font-medium mb-2">Alamat</label>
                <input type="text" id="alamat" name="alamat" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                    placeholder="Masukan alamat" value="{{$item->alamat}}" readonly>
            </div>

            {{-- No Telepon --}}
            <div class="mb-4">
                <label for="no_telepon" class="block text-gray-700 font-medium mb-2">No Telepon</label>
                <input type="number" id="no_telepon" name="no_telepon" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                    placeholder="No telepon" value="{{$item->no_telepon}}" readonly>
            </div>

            {{-- Tabel Riwayat Pembelian --}}
            <div class="mb-4">
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Riwayat Pembelian</h4>
                <table class="w-full border-collapse border border-gray-300 rounded-lg">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                            <th class="border border-gray-300 px-4 py-2">Nama Produk</th>
                            <th class="border border-gray-300 px-4 py-2">Jumlah</th>
                            <th class="border border-gray-300 px-4 py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->penjualans as $penjualan)
                            @foreach ($penjualan->detailPenjualans as $detail)
                            <tr class="text-gray-700">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $penjualan['tanggal_penjualan'] }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $detail['produk']['nama_produk'] }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $detail['jumlah_produk'] }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-right">Rp {{ number_format($detail['subtotal'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
