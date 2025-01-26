@extends('layout.main')

@section('title', 'Penjualan')
@section('content')
    <h3 class="text-2xl text-gray-700 font-semibold">Penjualan</h3>
    <p class=" text-gray-500 border-b">Home / Penjualan </p>
    {{-- {{ $penjualan }} --}}
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
            <a href="#" type="button" data-modal-target="tambahpenjualanModal" data-modal-show="tambahpenjualanModal"
                class="text-white bg-blue-500 hover:bg-blue-600 transition  rounded-lg px-4 py-2">Tambah
                Data</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 mx-2">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- table --}}
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Pelanggan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tgl Penjualan
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Total <br> Harga
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Daftar Produk <br>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-100 dark:border-gray-50 hover:bg-gray-100 dark:hover:bg-gray-100">
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->pelanggan->nama_pelanggan }}
                        </th>
                        <td class="px-6 py-4">
                            {{ date('d F Y ', strtotime($item->tanggal_penjualan)) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            Rp. {{ $item->total_harga }}
                        </td>
                        <td class="px-6 py-4">
                            @foreach ($item->detailPenjualans as $detailProduk)
                                <ul>
                                    <li>{{ $loop->iteration . '. ' . $detailProduk->produk->nama_produk }}</li>
                                </ul>
                            @endforeach

                        </td>
                        <td class="px-6 py-4 flex gap-2 flex-wrap">
                            <!-- Modal toggle -->
                            <a href="#" type="button" data-modal-target="editPenjualanModal-{{ $item->id }}"
                                data-modal-show="editPenjualanModal-{{ $item->id }}"
                                class="font-medium text-yellow-600 text-xl dark:text-yellow-500 hover:underline">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="#" type="button" data-modal-target="deletePenjualanModal-{{ $item->id }}"
                                data-modal-show="deletePenjualanModal-{{ $item->id }}"
                                class="font-medium text-red-600 text-xl dark:text-red-500 hover:underline">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                            {{-- <a href="#" type="button" data-modal-target="editUserModal"
                                data-modal-show="editUserModal"
                                class="font-medium text-blue-600 text-xl dark:text-blue-500 hover:underline">
                                <i class="fa-solid fa-circle-info"></i>
                            </a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    {{-- Modal Tambah Data Penjualan --}}
    <div id="tambahpenjualanModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form class="relative bg-white rounded-lg shadow dark:bg-gray-700" action="/tambahPenjualan" method="POST">
                @csrf

                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Penjualan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="tambahpenjualanModal">
                        <i class="fa-solid fa-x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    {{-- tanggal penjualan --}}
                    <div class="mb-4">
                        <label for="inputTanggal_penjualan" class="block text-gray-700 font-medium mb-2">Tanggal
                            Penjualan</label>
                        <input type="date" id="inputTanggal_penjualan" name="tanggal_penjualan" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400">
                        @error('tanggal_penjualan')
                            <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pilihan Nama Pelanggan --}}
                    <div class="mb-4">
                        <label for="Pelanggan" class="block text-gray-700 font-medium mb-2">Pelanggan</label>
                        <select name="pelanggan_id" id="pelanggan_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400">
                            <option value="">Pilih Pelanggan</option>
                            @foreach ($pelanggan as $dataPelanggan)
                                <option value="{{ $dataPelanggan->id }}">{{ $dataPelanggan->nama_pelanggan }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Produk dan Jumlah --}}
                    <div class="mb-4">
                        <div id="produk-container">
                            <!-- Produk dan Jumlah Pertama -->
                            <div class="flex gap-4 mb-4">
                                <!-- Produk -->
                                <div class="flex-1">
                                    <label for="produk" class="block text-gray-700 font-medium mb-2">Produk</label>
                                    <select name="produk_id[]"
                                        class="produk_id w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400">
                                        <option value="">Pilih Produk</option>
                                        @foreach ($produk as $dataproduk)
                                            <option value="{{ $dataproduk->id }}">{{ $dataproduk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Jumlah -->
                                <div class="flex-1">
                                    <label for="jumlah" class="block text-gray-700 font-medium mb-2">Jumlah</label>
                                    <input type="number" name="jumlah[]" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                                        placeholder="Jumlah">
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Tambah Produk -->
                        <button type="button" onclick="tambahProduk()"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-blue-600">
                            Tambah Produk
                        </button>
                    </div>
                </div>

                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- Modal edit data penjualan --}}
    @foreach ($penjualan as $item)
        <div id="editPenjualanModal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <form class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                    action="/editPenjualan/{{ $item->id }}" method="POST">
                    @method('put')
                    @csrf

                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Edit Penjualan
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="editPenjualanModal-{{ $item->id }}">
                            <i class="fa-solid fa-x"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="mb-4">
                            <label for="Produk"
                                class="block text-gray-700 font-meproduk+idl
                                Penjualan">Tanggal
                                Penjualan</label>
                            <input type="date" id="Produk" name="tanggal_penjualan" required
                                class="produk_id w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                                value="{{ $item->tanggal_penjualan }}">
                            @error('tanggal_penjualan')
                                <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pilihan Nama Pelanggan -->
                        <div>
                            <label for="pelanggan_id_{{ $item->id }}" class="block text-gray-700">Pelanggan</label>
                            <select name="pelanggan_id" id="pelanggan_id_{{ $item->id }}"
                                class="w-full px-4 py-2 border rounded-lg">
                                @foreach ($pelanggan as $pelangganItem)
                                    <option value="{{ $pelangganItem->id }}"
                                        {{ $item->pelanggan_id == $pelangganItem->id ? 'selected' : '' }}>
                                        {{ $pelangganItem->nama_pelanggan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Produk dan Jumlah -->
                        <div id="produk-container-editmodal-{{ $item->id }}">
                            @foreach ($item->detailPenjualans as $detail)
                                <div class="flex gap-4 mb-4">
                                    <div class="flex-1">
                                        <label class="block text-gray-700 font-medium mb-2">Produk</label>
                                        <select name="produk_id[]" id="readonlySelect"
                                            class="produk_id w-full px-4 py-2 border rounded-lg">
                                            @foreach ($produk as $produkItem)
                                                <option value="{{ $produkItem->id }}"
                                                    {{ $detail->produk_id == $produkItem->id ? 'selected' : '' }}
                                                    @readonly(true)>
                                                    {{ $produkItem->nama_produk }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-gray-700 font-medium mb-2">Jumlah</label>
                                        <input type="number" name="jumlah[]" value="{{ $detail->jumlah_produk }}"
                                            class="w-full px-4 py-2 border rounded-lg" required>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button"
                            class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800"
                            data-modal-hide="editPenjualanModal-{{ $item->id }}">Cancel</button>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach



    {{-- modal delete data penjualan --}}
    @foreach ($penjualan as $item)
        <div id="deletePenjualanModal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="deletePenjualanModal-{{ $item->id }}">
                            <i class="fa-solid fa-x"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="flex items-center justify-center space-x-4">
                            <i class="fa-solid fa-triangle-exclamation text-yellow-500 text-5xl"></i>
                            <p class="text-gray-700 dark:text-white">Apakah Anda yakin ingin menghapus data penjualan ini?</p>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <a href="/deletePenjualan/{{ $item->id }}"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Ya,
                            Delete</a>
                        <button type="button"
                            class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800"
                            data-modal-hide="deletePenjualanModal-{{ $item->id }}">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <script>
        const select = document.getElementById('readonlySelect');
        select.addEventListener('mousedown', function(e) {
            e.preventDefault(); // Mencegah dropdown terbuka
        });

        // default set tanggal penjualan
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen input dengan type date
            const inputTanggal = document.getElementById("inputTanggal_penjualan");

            // Dapatkan tanggal sekarang dalam format YYYY-MM-DD
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
            const dd = String(today.getDate()).padStart(2, '0');

            inputTanggal.value = `${yyyy}-${mm}-${dd}`;
        });

        // tambah slot produk
        function tambahProduk() {
            const produkContainer = document.getElementById('produk-container');

            // Buat elemen produk dan jumlah baru
            const newProdukDiv = document.createElement('div');
            newProdukDiv.classList.add('flex', 'gap-4', 'mb-4');

            newProdukDiv.innerHTML = `
        <div class="flex-1">
            <label for="produk" class="block text-gray-700 font-medium mb-2">Produk</label>
            <select name="produk_id[]" class="produk_id w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400">
                <option value="">Pilih Produk</option>
                @foreach ($produk as $dataproduk)
                    <option value="{{ $dataproduk->id }}">{{ $dataproduk->nama_produk }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex-1">
            <label for="jumlah" class="block text-gray-700 font-medium mb-2">Jumlah</label>
            <input type="number" name="jumlah[]" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400" placeholder="Jumlah">
        </div>

        <div class="flex items-center justify-center pt-6">
            <button type="button" onclick="hapusProduk(this)" class="text-red-500 hover:text-red-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

            // Tambahkan elemen ke dalam container
            produkContainer.appendChild(newProdukDiv);
        }

        // hapus slot produk
        function hapusProduk(button) {
            // Ambil div terdekat yang membungkus slot produk
            const produkDiv = button.closest('.flex.gap-4.mb-4');
            produkDiv.remove(); // Hapus elemen div tersebut
        }
    </script>


@endsection
