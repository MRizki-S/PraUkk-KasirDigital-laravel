@extends('../../landing/landingPage')

@section('content')
    <div class="relative w-full h-screen bg-cover bg-center flex items-center justify-center" id="home"
        style="background-image: url('{{ asset('assets/images/background.jpg') }}');">
        <div class="bg-black bg-opacity-50 text-white text-center p-10 rounded-lg">
            <h1 class="text-4xl font-bold mb-4">Mulai Booking Hotel Anda Sekarang!</h1>
            <p class="text-lg mb-6">Nikmati pengalaman menginap terbaik dengan fasilitas lengkap.</p>

            <!-- Form Booking -->
            <form action="/pesan-sekarang" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Tanggal Check-in -->
                    <div>
                        <label for="check_in_date" class="block text-sm font-medium">Tanggal Check-in</label>
                        <input type="date" id="check_in_date" name="check_in_date"
                            class="w-full px-4 py-2 border rounded-lg text-black">
                    </div>

                    <!-- Tanggal Check-out -->
                    <div>
                        <label for="check_out_date" class="block text-sm font-medium">Tanggal Check-out</label>
                        <input type="date" id="check_out_date" name="check_out_date"
                            class="w-full px-4 py-2 border rounded-lg text-black">
                    </div>

                    <!-- Jumlah Kamar -->
                    <div>
                        <label for="jumlah_kamar" class="block text-sm font-medium">Jumlah Kamar</label>
                        <input type="number" id="jumlah_kamar" name="jumlah_kamar" min="1"
                            class="w-full px-4 py-2 border rounded-lg text-black">
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit"
                    class="mt-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg">
                    Pesan Sekarang
                </button>
            </form>
        </div>
    </div>

    <!-- Section Keunggulan -->
    <div class="container mx-auto py-16">
        <h2 class="text-center text-3xl font-bold text-yellow-600 mb-10">Kenapa Memilih Kami?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <!-- Bersih -->
            <div class="py-6 px-4 bg-white shadow-lg rounded-lg flex flex-col items-center">
                <div class="bg-blue-100 p-4 rounded-full mb-4">
                    <i class="fa-solid fa-broom text-blue-600 text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Bersih & Nyaman</h3>
                <p class="text-gray-600 mt-2">Kamar selalu dibersihkan secara rutin untuk kenyamanan Anda.</p>
            </div>

            <!-- Fast Respon -->
            <div class="py-6 px-4 bg-white shadow-lg rounded-lg flex flex-col items-center">
                <div class="bg-green-100 p-4 rounded-full mb-4">
                    <i class="fa-solid fa-headset text-green-600 text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Fast Respon</h3>
                <p class="text-gray-600 mt-2">Pelayanan cepat dan ramah selama 24 jam.</p>
            </div>

            <!-- Free WiFi -->
            <div class="py-6 px-4 bg-white shadow-lg rounded-lg flex flex-col items-center">
                <div class="bg-yellow-100 p-4 rounded-full mb-4">
                    <i class="fa-solid fa-wifi text-yellow-600 text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Free WiFi</h3>
                <p class="text-gray-600 mt-2">Nikmati akses internet gratis di seluruh area hotel.</p>
            </div>
        </div>
    </div>

    {{-- section tipe kamar --}}
    <div class="container mx-auto py-20" id="tipe-kamar">
        <h2 class="text-center text-3xl font-bold text-yellow-600">Tipe Kamar</h2>
        <p class="text-center text-gray-600 mb-10">
            Pilih tipe kamar yang sesuai dengan kebutuhan Anda. <br>
            Kami menyediakan berbagai tipe kamar untuk memenuhi kebutuhan Anda.
        </p>

        <div class="flex flex-wrap justify-center gap-8">
            @foreach ($tipeKamar as $item)
                <div
                    class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col h-full w-full max-w-sm min-h-[500px]">
                    <!-- Cek apakah ada gambar, jika tidak gunakan gambar default -->
                    <img src="{{ $item->image ? asset('storage/imagesType/' . $item->image) : asset('assets/images/kamar/bronze.jpg') }}"
                        alt="Kamar image" class="w-full h-56 object-cover">


                    <div class="p-6 flex flex-col flex-grow">
                        <!-- Nama Kamar -->
                        <h3 class="text-lg font-semibold text-gray-800">{{ $item->nama }}</h3>

                        <!-- Harga -->
                        <p class="text-yellow-600 font-bold mt-2">Rp {{ number_format($item->harga_permalam, 0, ',', '.') }}
                        </p>

                        <!-- Fasilitas -->
                        <p class="text-gray-600 mt-2 font-semibold">Fasilitas:</p>
                        <ul class="text-gray-600 mt-1 space-y-1 flex-grow">
                            @if ($item->fasilitas->isNotEmpty())
                                @foreach ($item->fasilitas as $data)
                                    <li class="flex items-center">
                                        <i class="fa-solid fa-check-circle text-green-500 mr-2"></i>
                                        {{ $data->nama }}
                                    </li>
                                @endforeach
                            @else
                                <li class="text-gray-500">Tidak ada fasilitas tersedia.</li>
                            @endif
                        </ul>

                        <!-- Memastikan tombol tetap di bawah -->
                        <div class="mt-auto">
                            <a href="/pesan-sekarang"
                                class="block bg-gray-900 hover:bg-gray-800 text-white text-center font-bold py-2 px-6 rounded-lg">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>



    <!-- Section Fasilitas Hotel -->
    <div class="container mx-auto py-16 px-6 min-h-screen" id="fasilitas">
        <h2 class="text-center text-3xl font-bold text-yellow-600">Fasilitas Eksklusif Hotel Kami</h2>
        <p class="text-center text-lg text-gray-700 mb-12">
            Kami menyediakan berbagai fasilitas untuk kenyamanan dan pengalaman menginap terbaik Anda. <br>
            Rasakan kemewahan, kenyamanan, dan pelayanan terbaik hanya di <strong>Hotel Prima</strong>.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Gambar Hotel -->
            <div class="relative w-full flex justify-center overflow-hidden rounded-lg shadow-lg group">
                <!-- Gambar Hotel -->
                <img src="{{ asset('assets/images/background.jpg') }}" alt="Fasilitas Hotel"
                    class="w-full h-full object-cover transition-transform duration-1000 ease-in-out transform group-hover:scale-110">
                <!-- Overlay Gelap -->
                <div
                    class="absolute inset-0 bg-black opacity-30 transition-opacity duration-700 ease-in-out group-hover:opacity-50">
                </div>

                <!-- Teks Muncul Saat Hover -->
                <div
                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-700 ease-in-out">
                    <span class="text-yellow-500 text-2xl font-bold bg-black bg-opacity-50 px-4 py-2 rounded-lg">
                        Selamat Datang di Kemewahan & Kenyamanan
                    </span>
                </div>
            </div>


            <!-- Daftar Fasilitas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Bagian Kiri -->
                <ul class="space-y-4 text-lg text-gray-700">
                    <li class="flex items-center hover:translate-x-2 hover:text-green-500 transition-all">
                        <i class="fa-solid fa-check-circle text-green-500 text-xl mr-3"></i>
                        Kolam Renang Infinity View
                    </li>
                    <li class="flex items-center hover:translate-x-2 hover:text-green-500 transition-all">
                        <i class="fa-solid fa-check-circle text-green-500 text-xl mr-3"></i>
                        Restoran Mewah dengan Menu Internasional
                    </li>
                    <li class="flex items-center hover:translate-x-2 hover:text-green-500 transition-all">
                        <i class="fa-solid fa-check-circle text-green-500 text-xl mr-3"></i>
                        Gym & Fitness Center Berstandar Internasional
                    </li>
                    <li class="flex items-center hover:translate-x-2 hover:text-green-500 transition-all">
                        <i class="fa-solid fa-check-circle text-green-500 text-xl mr-3"></i>
                        Spa & Pijat Relaksasi oleh Terapis Profesional
                    </li>
                    <li class="flex items-center hover:translate-x-2 hover:text-green-500 transition-all">
                        <i class="fa-solid fa-check-circle text-green-500 text-xl mr-3"></i>
                        Shuttle Bandara Gratis
                    </li>
                </ul>

                <!-- Bagian Kanan -->
                <ul class="space-y-4 text-lg text-gray-700">
                    <li class="flex items-center hover:translate-x-2 hover:text-green-500 transition-all">
                        <i class="fa-solid fa-check-circle text-green-500 text-xl mr-3"></i>
                        Parkir Gratis dengan Keamanan 24 Jam
                    </li>
                    <li class="flex items-center hover:translate-x-2 hover:text-green-500 transition-all">
                        <i class="fa-solid fa-check-circle text-green-500 text-xl mr-3"></i>
                        Free WiFi di Seluruh Area Hotel
                    </li>
                    <li class="flex items-center hover:translate-x-2 hover:text-green-500 transition-all">
                        <i class="fa-solid fa-check-circle text-green-500 text-xl mr-3"></i>
                        Layanan Kamar Eksklusif 24 Jam
                    </li>
                    <li class="flex items-center hover:translate-x-2 hover:text-green-500 transition-all">
                        <i class="fa-solid fa-check-circle text-green-500 text-xl mr-3"></i>
                        Ruang Meeting & Ballroom Berkapasitas Besar
                    </li>
                    <li class="flex items-center hover:translate-x-2 hover:text-green-500 transition-all">
                        <i class="fa-solid fa-check-circle text-green-500 text-xl mr-3"></i>
                        Area Hiburan: Game Room & Lounge
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-gray-300 pt-12 pb-6">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Kolom 1: Tentang Kami -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">Tentang Hotel Prima</h3>
                    <p class="text-gray-400">
                        Nikmati pengalaman menginap terbaik dengan fasilitas eksklusif dan layanan terbaik di Hotel Prima.
                        Kenyamanan dan kepuasan Anda adalah prioritas kami.
                    </p>
                </div>

                <!-- Kolom 2: Kontak -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">Kontak Kami</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fa-solid fa-phone text-yellow-500 mr-3"></i> +62 852-3861-7670
                        </li>
                        <li class="flex items-center">
                            <i class="fa-solid fa-envelope text-yellow-500 mr-3"></i> infohotelPrima@gmail.com
                        </li>
                        <li class="flex items-center">
                            <i class="fa-solid fa-map-marker-alt text-yellow-500 mr-3"></i> Jl. Raya No. 123, Jember,
                            Indonesia
                        </li>
                    </ul>
                </div>

                <!-- Kolom 3: Sosial Media -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-yellow-500 transition-all">
                            <i class="fa-brands fa-facebook text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500 transition-all">
                            <i class="fa-brands fa-instagram text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500 transition-all">
                            <i class="fa-brands fa-twitter text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500 transition-all">
                            <i class="fa-brands fa-whatsapp text-2xl"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Garis Pembatas -->
            <div class="border-t border-gray-700 mt-8 pt-6 text-center">
                <p class="text-gray-500">&copy; 2025 Hotel Prima. Semua Hak Dilindungi.</p>
            </div>
        </div>
    </footer>




    <style>
        /* Tambahkan gaya CSS tambahan jika diperlukan */
        .hover\:translate-x-2:hover {
            transform: translateX(0.5rem);
        }
    </style>
@endsection
