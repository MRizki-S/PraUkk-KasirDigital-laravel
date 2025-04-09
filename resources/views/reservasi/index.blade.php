@extends('layout.main')

@section('title', 'Reservasi')
@section('content')
    <h3 class="text-2xl text-gray-700 font-semibold">Reservasi</h3>
    <p class=" text-gray-500 border-b">Home / Reservasi </p>
    {{-- {{ $reservasi }} --}}
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
            <div class="flex items-center justify-between flex-wrap gap-4 p-4">
                <!-- Filter Nama Pemesan -->
                <input type="text" id="searchNama" placeholder="Cari Nama Pemesan"
                    class="block p-2 border border-gray-300 rounded-lg w-64 bg-gray-50 text-gray-900">

                <!-- Filter Tipe Kamar -->
                <select id="filterKamar" class="block p-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-900">
                    <option value="">Semua Tipe Kamar</option>
                    <option value="Bronze">Bronze</option>
                    <option value="Platinum">Platinum</option>
                    <option value="Diamond">Diamond</option>
                    <option value="Luxury">Luxury</option>
                </select>

                <!-- Filter Tanggal Check-in -->
                <input type="date" id="filterCheckin" class="block p-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-900">
            </div>

        </div>
        {{-- table --}}
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Pemesan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipe Kamar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Cek in
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Cek out
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservasi as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-100 dark:border-gray-50 hover:bg-gray-100 dark:hover:bg-gray-100">
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->nama_pemesan }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->email }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="
                                px-2 py-1 rounded text-white text-sm font-semibold
                                @if($item->kamarType->nama == 'Bronze') bg-yellow-600
                                @elseif($item->kamarType->nama == 'Platinum') bg-blue-500
                                @elseif($item->kamarType->nama == 'Diamond') bg-purple-500
                                @elseif($item->kamarType->nama == 'Luxury') bg-yellow-400
                                @else bg-gray-300
                                @endif
                            ">
                                {{ $item->kamarType->nama }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->check_in_date }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->check_out_date }}
                        </td>
                        <td class="px-6 py-4 flex gap-2 flex-wrap">
                            <!-- Modal toggle -->
                            {{-- <a href="#" type="button" data-modal-target="editKamarModal-{{ $item->id }}"
                                data-modal-show="editKamarModal-{{ $item->id }}"
                                class="font-medium text-yellow-600 text-xl dark:text-yellow-500 hover:underline">
                                <i class="fa-solid fa-pen"></i>
                            </a> --}}
                            <a href="#" type="button" data-modal-target="deleteReservasi-{{ $item->id }}"
                                data-modal-show="deleteReservasi-{{ $item->id }}"
                                class="font-medium text-red-600 text-xl dark:text-red-500 hover:underline">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchNama");
            const filterKamar = document.getElementById("filterKamar");
            const filterCheckin = document.getElementById("filterCheckin");
            const tableRows = document.querySelectorAll("tbody tr");

            function filterTable() {
                const searchValue = searchInput.value.toLowerCase();
                const kamarValue = filterKamar.value.toLowerCase();
                const checkinValue = filterCheckin.value;

                tableRows.forEach(row => {
                    const namaPemesan = row.querySelector("th").textContent.toLowerCase();
                    const tipeKamar = row.querySelector("td:nth-child(3) span")?.textContent.toLowerCase().trim() || "";
                    const checkinDate = row.querySelector("td:nth-child(4)").textContent.trim();

                    let showRow = true;

                    // Filter Nama Pemesan
                    if (searchValue && !namaPemesan.includes(searchValue)) {
                        showRow = false;
                    }

                    // Filter Tipe Kamar
                    if (kamarValue && tipeKamar !== kamarValue) {
                        showRow = false;
                    }

                    // Filter Tanggal Check-in
                    if (checkinValue && checkinDate !== checkinValue) {
                        showRow = false;
                    }

                    row.style.display = showRow ? "" : "none";
                });
            }

            searchInput.addEventListener("input", filterTable);
            filterKamar.addEventListener("change", filterTable);
            filterCheckin.addEventListener("input", filterTable);
        });
    </script>

@endsection




{{-- modal delete data kamar --}}
@foreach ($reservasi as $item)
    <div id="deleteReservasi-{{ $item->id }}" tabindex="-1" aria-hidden="true"
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
                        data-modal-hide="deleteReservasi-{{ $item->id }}">
                        <i class="fa-solid fa-x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="flex items-center justify-center space-x-4">
                        <i class="fa-solid fa-triangle-exclamation text-yellow-500 text-5xl"></i>
                        <p class="text-gray-700 dark:text-white">Apakah Anda yakin ingin menghapus Data Pemesanan ini?</p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <a href="/deleteReservasi/{{ $item->id }}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Ya,
                        Delete</a>
                    <button type="button"
                        class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800"
                        data-modal-hide="deleteReservasi-{{ $item->id }}">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endforeach







