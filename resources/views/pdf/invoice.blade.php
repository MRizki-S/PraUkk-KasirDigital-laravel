<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pemesanan Hotel</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .invoice-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #5c67f2;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
            color: #333;
        }

        .header img {
            max-width: 80px;
            margin-bottom: 8px;
        }

        .table-container {
            margin-bottom: 20px;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
            background: white;
            font-size: 14px;
            /* Ukuran font lebih kecil */
        }

        .table-custom th,
        .table-custom td {
            border: 1px solid #ddd;
            padding: 8px;
            /* Kurangi padding agar lebih compact */
            text-align: left;
            max-width: 150px;
            /* Batasi lebar agar tidak terlalu besar */
            word-wrap: break-word;
            /* Biarkan teks panjang terpotong otomatis */
        }

        .table-custom th {
            background-color: #5c67f2;
            color: white;
            font-weight: 600;
            font-size: 14px;
            /* Ukuran font lebih kecil untuk header */
        }

        .table-custom td {
            background-color: #f2f2ff;
            white-space: nowrap;
            /* Mencegah teks terlalu panjang dalam satu baris */
            overflow: hidden;
            text-overflow: ellipsis;
            /* Tambahkan "..." jika teks terlalu panjang */
        }

        @media (max-width: 600px) {
            .table-custom {
                font-size: 12px;
                /* Ukuran font lebih kecil untuk layar kecil */
            }

            .table-custom th,
            .table-custom td {
                padding: 6px;
                /* Kurangi padding agar tabel tetap proporsional */
            }
        }
    </style>
</head>

<body>

    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            {{--    <img src="{{ Storage::url('/public/assets/images/logo.png') }}" alt="Hotel Logo"> --}}
            <h1>Bukti Pemesanan - Hotel Prima</h1>
        </div>

        <div class="table-container">
            <!-- Table Data Pemesan -->
            <div class="table-title">Data Pemesan</div>
            <table class="table-custom">
                <tr>
                    <th>Nama Pemesan</th>
                    <th>Email</th>
                    <th>No. Handphone</th>
                    <th>Nama Tamu</th>
                </tr>
                <tr>
                    <td>{{ $reservation->nama_pemesan }}</td>
                    <td>{{ $reservation->email }}</td>
                    <td>{{ $reservation->no_handphone }}</td>
                    <td>{{ $reservation->nama_tamu }}</td>
                </tr>
            </table>
        </div>

        <div class="table-container">
            <!-- Table Detail Pemesanan -->
            <div class="table-title">Detail Pemesanan</div>
            <table class="table-custom">
                <tr>
                    <th>Tipe Kamar</th>
                    <th>Deskripsi</th>
                    <th>Nomor Kamar</th>
                    <th>Tanggal Check-in</th>
                    <th>Tanggal Check-out</th>
                    <th>Jumlah Kamar</th>
                    <th>Total Harga</th>
                </tr>
                <tr>
                    <td>{{ $reservation->kamarType->nama }}</td>
                    <td>{{ $reservation->kamarType->deskripsi }}</td>
                    <td>{{ $reservation->no_kamar }}</td>
                    <td>{{ $reservation->check_in_date }}</td>
                    <td>{{ $reservation->check_out_date }}</td>
                    <td>{{ $reservation->jumlah_kamar }}</td>
                    <td><strong>Rp. {{ number_format($reservation->total_harga, 2) }}</strong></td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih telah memilih <strong>Hotel Prima</strong>. Kami berharap Anda menikmati masa menginap Anda!
            </p>
            <p><strong>Hotel Prima</strong> - Jl. Raya No. 123, Jember, Indonesia</p>
        </div>
    </div>

</body>

</html>
