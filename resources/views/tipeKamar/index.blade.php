@extends('layout.main')

@section('title', 'Tipe Kamar')
@section('content')
    <h3 class="text-2xl text-gray-700 font-semibold">Tipe Kamar</h3>
    <p class=" text-gray-500 border-b">Home / Tipe Kamar</p>
    {{-- {{ $kamarType }} --}}
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
            @if (Auth::user()->role == 'admin')
                <a href="#" type="button" data-modal-target="tambahKamarModal" data-modal-show="tambahKamarModal"
                    class="text-white bg-blue-500 hover:bg-blue-600 transition  rounded-lg px-4 py-2">Tambah
                    Data</a>
            @endif
        </div>
        {{-- table --}}
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Foto

                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fasilitas kamar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah Kamar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga/malam
                    </th>
                    @if (Auth::user()->role == 'admin')
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($kamarType as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-100 dark:border-gray-50 hover:bg-gray-100 dark:hover:bg-gray-100">
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->nama }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->deskripsi }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($item->image)
                                <img src="{{ asset('storage/imagesType/' . $item->image) }}" alt="Gambar Kamar"
                                    width="100">
                            @else
                                <span class="text-gray-500">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @foreach ($item->fasilitas as $fasilitas)
                                <span
                                    class="bg-blue-200 text-blue-700 text-xs font-semibold px-2 py-1 rounded mb-2 inline-block">
                                    {{ $fasilitas->nama }}
                                </span>
                                <br>
                            @endforeach
                        </td>
                        <th scope="col" class="px-6 py-3">
                            {{ $item->jumlah_kamar }} kamar
                        </th>
                        <td class="px-6 py-4">
                            Rp. {{ $item->harga_permalam }}
                        </td>
                        @if (Auth::user()->role == 'admin')
                            <td class="px-6 py-4 flex gap-2 flex-wrap">
                                <!-- Modal toggle -->
                                <a href="#" type="button" data-modal-target="editTipeKamarModel-{{ $item->id }}"
                                    data-modal-show="editTipeKamarModel-{{ $item->id }}"
                                    class="font-medium text-yellow-600 text-xl dark:text-yellow-500 hover:underline">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="#" type="button"
                                    data-modal-target="deleteTipeKamarModal-{{ $item->id }}"
                                    data-modal-show="deleteTipeKamarModal-{{ $item->id }}"
                                    class="font-medium text-red-600 text-xl dark:text-red-500 hover:underline">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection



{{-- modal tambah data tipe kamar --}}
<div id="tambahKamarModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form class="relative bg-white rounded-lg shadow dark:bg-gray-700" action="/tambahTipeKamar"
            enctype="multipart/form-data" enctype="multipart/form-data" method="POST">
            @csrf

            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tambah Tipe Kamar
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="tambahKamarModal">
                    <i class="fa-solid fa-x"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                {{-- nama tipe kamar --}}
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Tipe</label>
                    <input type="text" id="nama" name="nama" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                        placeholder="Nama Tipe" value={{ old('nama') }}>
                    @error('nama')
                        <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                    <input type="text" id="deskripsi" name="deskripsi" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                        placeholder="deskripsi" value={{ old('deskripsi') }}>
                    @error('deskripsi')
                        <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="foto">Upload Gambar Kamar:</label>
                    <br>
                    <input type="file" name="foto" accept="image/*" required>
                </div>

                <div id="fasilitas-container">
                    <!-- Fasilitas pertama -->
                    <div class="flex items-center fasilitas-item mb-2">
                        <select name="fasilitas[]"
                            class="fasilitas-select w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400">
                            <option value="">Pilih Fasilitas Kamar</option>
                            @foreach ($fasilitasAll as $dataFasilitas)
                                <option value="{{ $dataFasilitas->id }}">{{ $dataFasilitas->nama }}</option>
                            @endforeach
                        </select>
                        <button type="button"
                            class="ml-2 px-3 py-2 bg-blue-500 text-white rounded-lg add-fasilitas">+</button>
                    </div>
                </div>

                {{-- harga --}}
                <div class="mb-4">
                    <label for="harga_permalam" class="block text-gray-700 font-medium mb-2">Harga/Malam</label>
                    <input type="number" id="harga_permalam" name="harga_permalam" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                        placeholder="Rp " value={{ old('harga_permalam') }}>
                    @error('harga_permalam')
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('fasilitas-container');

        // Event listener untuk menambahkan fasilitas
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-fasilitas')) {
                const fasilitasItem = document.createElement('div');
                fasilitasItem.classList.add('flex', 'items-center', 'fasilitas-item', 'mb-2');

                fasilitasItem.innerHTML = `
                    <select name="fasilitas[]" class="fasilitas-select w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400">
                        <option value="">Pilih Fasilitas Kamar</option>
                        @foreach ($fasilitasAll as $dataFasilitas)
                            <option value="{{ $dataFasilitas->id }}">{{ $dataFasilitas->nama }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="ml-2 px-2 py-2 bg-red-300 text-white rounded-lg remove-fasilitas">❌</button>
                `;

                container.appendChild(fasilitasItem);
            }

            // Event listener untuk menghapus fasilitas
            if (e.target.classList.contains('remove-fasilitas')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>

{{-- modal edit data tipe kamar --}}
@foreach ($kamarType as $item)
    <div id="editTipeKamarModel-{{ $item->id }}" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                action="/editTipeKamar/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf

                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Tipe Kamar
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="editTipeKamarModel-{{ $item->id }}">
                        <i class="fa-solid fa-x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">

                    {{-- nama tipe kamar --}}
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Tipe</label>
                        <input type="text" id="nama" name="nama" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                            placeholder="Nama Tipe" value={{ $item->nama }}>
                        @error('nama')
                            <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                        <input type="text" id="deskripsi" name="deskripsi" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                            placeholder="deskripsi" value={{ $item->deskripsi }}>
                        @error('deskripsi')
                            <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Menampilkan gambar saat ini -->
                    @if ($item->image)
                        <p>Gambar saat ini:</p>
                        <img src="{{ asset('storage/imagesType/' . $item->image) }}" alt="Gambar Kamar"
                            width="100">
                    @endif
                    <div>
                        <label for="foto">Upload Gambar Kamar:</label>
                        <br>
                        <input type="file" name="foto" accept="image/*">
                    </div>
                    {{-- <div id="fasilitas-container">
                        <!-- Fasilitas pertama -->
                        <div class="flex items-center fasilitas-item mb-2">
                            <select name="fasilitas[]" class="fasilitas-select w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400">
                                <option value="">Pilih Fasilitas Kamar</option>
                                @foreach ($fasilitasAll as $dataFasilitas)
                                    <option value="{{ $dataFasilitas->id }}">{{ $dataFasilitas->nama }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="ml-2 px-3 py-2 bg-blue-500 text-white rounded-lg add-fasilitas">+</button>
                        </div>
                    </div> --}}
                    <div id="fasilitas-container-edit">
                        @foreach ($item->fasilitas as $selectedFasilitas)
                            <div class="flex items-center fasilitas-item mb-2">
                                <select name="fasilitas[]" class="fasilitas-select w-full px-4 py-2 border border-gray-300 rounded-lg">
                                    <option value="">Pilih Fasilitas Kamar</option>
                                    @foreach ($fasilitasAll as $dataFasilitas)
                                        <option value="{{ $dataFasilitas->id }}"
                                            {{ $selectedFasilitas->id == $dataFasilitas->id ? 'selected' : '' }}>
                                            {{ $dataFasilitas->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="ml-2 px-3 py-2 bg-red-500 text-white rounded-lg remove-fasilitas">-</button>
                            </div>
                        @endforeach

                        <!-- Tambah fasilitas baru di Edit -->
                        <div class="flex items-center fasilitas-item mb-2">
                            <select name="fasilitas[]" class="fasilitas-select w-full px-4 py-2 border border-gray-300 rounded-lg">
                                <option value="">Pilih Fasilitas Kamar</option>
                                @foreach ($fasilitasAll as $dataFasilitas)
                                    <option value="{{ $dataFasilitas->id }}">{{ $dataFasilitas->nama }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="ml-2 px-3 py-2 bg-blue-500 text-white rounded-lg add-fasilitas-edit">+</button>
                        </div>
                    </div>


                    {{-- harga --}}
                    <div class="mb-4">
                        <label for="harga_permalam" class="block text-gray-700 font-medium mb-2">Harga/Malam</label>
                        <input type="number" id="harga_permalam" name="harga_permalam" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                            placeholder="Rp " value={{ $item->harga_permalam }}>
                        @error('harga_permalam')
                            <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button"
                        class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800"
                        data-modal-hide="editTipeKamarModel-{{ $item->id }}">Cancel</button>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ubah</button>
                </div>
            </form>
        </div>
    </div>
@endforeach


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil container fasilitas di modal Edit
        const containerEdit = document.getElementById('fasilitas-container-edit');

        // Simpan daftar opsi fasilitas agar bisa digunakan ulang
        const fasilitasOptions = `
            @foreach ($fasilitasAll as $dataFasilitas)
                <option value="{{ $dataFasilitas->id }}">{{ $dataFasilitas->nama }}</option>
            @endforeach
        `;

        // Tambahkan fasilitas di modal Edit
        containerEdit.addEventListener('click', function (e) {
            if (e.target.classList.contains('add-fasilitas-edit')) {
                const fasilitasItem = document.createElement('div');
                fasilitasItem.classList.add('flex', 'items-center', 'fasilitas-item', 'mb-2');

                fasilitasItem.innerHTML = `
                    <select name="fasilitas[]" class="fasilitas-select w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Pilih Fasilitas Kamar</option>
                        ${fasilitasOptions}
                    </select>
                    <button type="button" class="ml-2 px-3 py-2 bg-red-500 text-white rounded-lg remove-fasilitas">-</button>
                `;

                containerEdit.appendChild(fasilitasItem);
            }

            // Hapus fasilitas di modal Edit
            if (e.target.classList.contains('remove-fasilitas')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>





{{-- modal delete data kamar --}}
@foreach ($kamarType as $item)
    <div id="deleteTipeKamarModal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-400">
                    {{-- <h3 class="text-xl font-semibold text-gray-600 dark:text-white">
                    Delete Produk
                </h3> --}}
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="deleteTipeKamarModal-{{ $item->id }}">
                        <i class="fa-solid fa-x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="flex items-center justify-center space-x-4">
                        <i class="fa-solid fa-triangle-exclamation text-yellow-500 text-5xl"></i>
                        <p class="text-gray-700 dark:text-white">Apakah Anda yakin ingin menghapus Tipe kamar ini?</p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <a href="/deleteTipeKamar/{{ $item->id }}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Ya,
                        Delete</a>
                    <button type="button"
                        class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800"
                        data-modal-hide="deleteTipeKamarModal-{{ $item->id }}">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
