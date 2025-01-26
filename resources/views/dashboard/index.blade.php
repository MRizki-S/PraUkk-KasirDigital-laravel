@extends('layout.main')

@section('title', 'Dashboard')
@section('content')
    <h3 class="text-2xl text-gray-700 font-semibold">Produk</h3>
    <p class=" text-gray-500 border-b">Home / Dashboard </p>
    {{-- {{ $produk }} --}}
    <div class="container bg-white mt-5 py-4 px-4 rounded-md shadow-md overflow-x-auto">
        <h3 class="text-2xl">Hi <span class="font-bold">{{ Auth::user()->nama_lengkap }}</span>, Selamat Datang di <span
                class="text-blue-700">Cashier UKK!</span></h3>
    </div>

    {{-- card total dashboard --}}
    <div class="container mt-5 py-5 bg-gray-100">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Produk Card -->
            <div class="w-full rounded-md border-t-4 border-blue-700 bg-white shadow-lg p-4 transition transform hover:scale-105 hover:shadow-2xl group">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full relative">
                            <i class="fa-solid fa-box text-blue-700 text-3xl transition-all transform opacity-1 group-hover:opacity-100 group-hover:translate-y-[-15px] group-hover:scale-150 group-hover:duration-500"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-blue-700">Produk</h3>
                            <p class="text-sm text-gray-500">Total Produk: </p>
                        </div>
                    </div>
                    <div>
                        <p class="font-extrabold text-blue-700 text-4xl text-right group-hover:text-5xl duration-200">{{ $totalProduk }}</p>
                    </div>
                </div>
            </div>

            <!-- Pelanggan Card -->
            <div
                class="w-full rounded-md border-t-4 border-green-700 bg-white shadow-lg p-4 transition transform hover:scale-105 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full">
                            <i class="fa-solid fa-user text-green-700 text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-green-700">Pelanggan</h3>
                            <p class="text-sm text-gray-500">Total Pelanggan:</p>
                        </div>
                    </div>
                    <div>
                        <p class="font-extrabold text-green-700 text-4xl text-right">{{ $totalPelanggan }}</p>
                    </div>
                </div>
            </div>
            <!-- Penjualan Card -->
            <div
                class="w-full rounded-md border-t-4 border-yellow-400 bg-white shadow-lg p-4 transition transform hover:scale-105 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <i class="fa-solid fa-chart-line text-yellow-600 text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-yellow-600">Penjualan</h3>
                            <p class="text-sm text-gray-500">Total Penjualan:</p>
                        </div>
                    </div>
                    <div>
                        <p class="font-extrabold text-yellow-600 text-4xl text-right">{{ $totalPenjualan }}</p>
                    </div>
                </div>
            </div>
            <!-- Petugas Card -->
            <div
                class="w-full rounded-md border-t-4 border-red-600 bg-white shadow-lg p-4 transition transform hover:scale-105 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 rounded-full">
                            <i class="fa-solid fa-users-cog text-red-600 text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-red-600">Petugas</h3>
                            <p class="text-sm text-gray-500">Total Petugas:</p>
                        </div>
                    </div>
                    <div>
                        <p class="font-extrabold text-red-600 text-4xl text-right">{{ $totalPetugas }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 py-5">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-600">Data Statistik</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Chart for Product Quantities -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-700 text-center mb-4">Jumlah Setiap Produk</h3>
                <canvas id="productPieChart" class="w-full" style="max-height: 300px;"></canvas>
            </div>

            <!-- Chart for Top Customers -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-700 text-center mb-4">Pelanggan dengan Pembelian Terbanyak</h3>
                <canvas id="customerBarChart" class="w-full" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data jumlah setiap produk - chart pie
        const produkLabel = {!! json_encode($produkData->pluck('nama_produk')) !!};
        const produkData = {!! json_encode($produkData->pluck('stok')) !!};

        const productPieCtx = document.getElementById('productPieChart').getContext('2d');
        new Chart(productPieCtx, {
            type: 'pie',
            data: {
                labels: produkLabel,
                datasets: [{
                    label: 'Jumlah Produk',
                    data: produkData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        });

        // Data jumlah pembelian setiap pelanggan - chart bar
        const pelanggganLabel = {!! json_encode($dataPembelianPelanggan->pluck('nama_pelanggan')) !!};
        const dataPembelianPelanggan = {!! json_encode($dataPembelianPelanggan->pluck('total_pembelian')) !!};


        const customerBarCtx = document.getElementById('customerBarChart').getContext('2d');
        new Chart(customerBarCtx, {
            type: 'bar',
            data: {
                labels: pelanggganLabel,
                datasets: [{
                    label: 'Jumlah Pembelian',
                    data: dataPembelianPelanggan,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 206, 86, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Pelanggan',
                            font: {
                                size: 14
                            }
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Pembelian',
                            font: {
                                size: 14
                            }
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>






@endsection
