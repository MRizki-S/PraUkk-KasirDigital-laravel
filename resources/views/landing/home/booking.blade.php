@extends('../../landing/landingPage')

@section('content')
    <div class="relative w-full h-screen bg-cover bg-center flex items-center justify-center"
        style="background-image: url('{{ asset('assets/images/background.jpg') }}');">
        <div class="bg-black bg-opacity-50 text-white text-center p-10 rounded-lg mt-20">
            @if(session('success'))
                <!-- tampilkan sukses -->
                <div class="text-center">
                    <h1 class="text-green-400 text-4xl font-semibold mb-4">Pemesanan Kamar berhasil dilakukan!</h1>
                    <p class="text-lg mb-6">Nikmati pengalaman menginap terbaik dengan fasilitas lengkap.</p>

                    <!-- Tombol Unduh Bukti Pemesanan -->
                    <a href="/download-buktiPemesanan/{{$reservation->id}}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg mr-4">
                        Unduh Bukti Pemesanan
                        <i class="fas fa-file-download"></i>
                    </a>
                </div>
            @else
                <h1 class="text-4xl font-bold mb-4">Lengkapi Data Booking</h1>
                <p class="text-lg mb-6">Nikmati pengalaman menginap terbaik dengan fasilitas lengkap.</p>
                <!-- Jika tidak ada session sukses, tampilkan form pemesanan -->
                <form action="/aksiPesan-sekarang" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="check_in_date" class="block text-sm font-medium">Tanggal Check-in</label>
                            <input type="date" id="check_in_date" name="check_in_date" value="{{ $check_in_date }}"
                                class="w-full px-4 py-2 border rounded-lg text-black">
                        </div>

                        <div>
                            <label for="check_out_date" class="block text-sm font-medium">Tanggal Check-out</label>
                            <input type="date" id="check_out_date" name="check_out_date" value="{{$check_out_date}}"
                                class="w-full px-4 py-2 border rounded-lg text-black">
                        </div>

                        <div>
                            <label for="jumlah_kamar" class="block text-sm font-medium">Jumlah Kamar</label>
                            <input type="number" id="jumlah_kamar" name="jumlah_kamar" min="1" value="{{$jumlah_kamar}}"
                                class="w-full px-4 py-2 border rounded-lg text-black">
                        </div>
                    </div>

                    <div class="mb-4 flex gap-4">
                        <div class="w-1/2 text-start">
                            <label for="nama_pemesan" class="block text-white font-medium mb-1">Nama Pemesan</label>
                            <input type="text" id="nama_pemesan" name="nama_pemesan" required
                                class="w-full text-black px-4 py-2 border rounded-lg"
                                placeholder="Nama Pemesan" value="{{ old('nama_pemesan') }}">
                        </div>

                        <div class="w-1/2">
                            <label for="nama_tamu" class="block text-white font-medium mb-1">Nama Tamu</label>
                            <input type="text" id="nama_tamu" name="nama_tamu" required
                                class="w-full text-black px-4 py-2 border rounded-lg"
                                placeholder="Nama Tamu" value="{{ old('nama_tamu') }}">
                        </div>
                    </div>

                    <div class="mb-4 flex gap-4">
                        <div class="w-1/2 text-start">
                            <label for="email" class="block text-white font-medium mb-1">Email</label>
                            <input type="text" id="email" name="email" required
                                class="w-full text-black px-4 py-2 border rounded-lg"
                                placeholder="sample@gmail.com" value="{{ old('email') }}">
                        </div>

                        <div class="w-1/2">
                            <label for="no_handphone" class="block text-white font-medium mb-1">No Handphone</label>
                            <input type="text" id="no_handphone" name="no_handphone" required
                                class="w-full px-4 text-black py-2 border rounded-lg"
                                placeholder="08XXX" value="{{ old('no_handphone') }}">
                        </div>
                    </div>

                    <div class="">
                        <label for="kamar_type_id" class="block text-white font-medium mb-1">Tipe Kamar</label>
                        <select name="kamar_type_id" id="kamar_type_id"
                            class="w-full px-4 py-2 border rounded-lg text-black">
                            <option value="">Tipe Kamar</option>
                            @foreach ($kamarType as $datakamarType)
                                <option value="{{ $datakamarType->id }}">{{ $datakamarType->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit"
                        class="mt-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg">
                        Pesan Sekarang
                    </button>
                </form>
            @endif

        </div>
    </div>

    <script>
        @if (Session::has('success'))
         Swal.fire({
            position: "top-end",
            icon: "success",
            title: '{{ Session::get('success') }}',
            showConfirmButton: false,
            timer: 1500
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
@endsection
