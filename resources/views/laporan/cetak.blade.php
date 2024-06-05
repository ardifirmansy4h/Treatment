<!DOCTYPE html>
<html>

<head>
    <title>Pdf</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin: 50px auto;
            max-width: 800px;
        }

        h3 {
            color: #4CAF50;
            font-weight: bold;
        }

        .table {
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table td:first-child {
            font-weight: bold;
            background-color: #e9ecef;
            width: 200px;
        }

        .table-bordered {
            border: 2px solid #dee2e6;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center mb-4">Aesthetic.id</h3>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td id="tanggal">{{ $data->slot->tanggal }}</td>
                </tr>
                <tr>
                    <td>Jam</td>
                    <td>:</td>
                    <td>{{ $data->slot->jam->waktu }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $data->nama }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>
                        @if ($data->jenis_kelamin == 'L')
                            Laki-laki
                        @else
                            Perempuan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Usia</td>
                    <td>:</td>
                    <td>{{ $data->usia }} Tahun</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $data->alamat }}</td>
                </tr>
                <tr>
                    <td>Jenis Treatment</td>
                    <td>:</td>
                    <td>{{ $data->jenis->nama }}</td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td>{{ $data->keterangan }}</td>
                </tr>
                <tr>
                    <td>Uang Muka</td>
                    <td>:</td>
                    <td id="uang_muka">{{ $data->dp }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pembayaran Uang Muka</td>
                    <td>:</td>
                    <td id="tanggal_dp">{{ $data->tgl_pembayaran_dp }}</td>
                </tr>
                <tr>
                    <td>Pembayaran Sisa</td>
                    <td>:</td>
                    <td id="sisa_pembayaran">{{ $data->sisa_pembayaran }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pembayaran Sisa</td>
                    <td>:</td>
                    <td id="tanggal_sisa">{{ $data->tgl_pembayaran_sisa }}</td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            <h3>Terima kasih telah berkunjung!</h3>
        </div>
    </div>

    <script>
        // Fungsi untuk memformat tanggal ke dalam format Indonesia
        function formatTanggal(tanggal) {
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            return new Date(tanggal).toLocaleDateString('id-ID', options);
        }

        // Fungsi untuk memformat angka menjadi format Rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(angka);
        }

        // Mengambil elemen dan mengubah formatnya
        document.getElementById('tanggal').innerText = formatTanggal('{{ $data->slot->tanggal }}');
        document.getElementById('tanggal_dp').innerText = formatTanggal('{{ $data->tgl_pembayaran_dp }}');
        document.getElementById('tanggal_sisa').innerText = formatTanggal('{{ $data->tgl_pembayaran_sisa }}');
        document.getElementById('uang_muka').innerText = formatRupiah('{{ $data->dp }}');
        document.getElementById('sisa_pembayaran').innerText = formatRupiah('{{ $data->sisa_pembayaran }}');

        window.print();
    </script>
</body>

</html>
