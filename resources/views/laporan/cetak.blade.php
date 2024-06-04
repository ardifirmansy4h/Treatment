<!DOCTYPE html>
<html>

<head>
    <title>Pdf</title>
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <h3 class="text-center m-4">Aesthetic.id</h3>
    <div class="m-5">
        <table class="table table-bordered">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $data->slot->tanggal }}</td>
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
                <td>
                    Jenis Treatment
                </td>
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
                <td>{{ $data->dp }}</td>
            </tr>
            <tr>
                <td>Tanggal Pembayaran Uang Muka</td>
                <td>:</td>
                <td>{{ $data->tgl_pembayaran_dp }}</td>
            </tr>
            <tr>
                <td>Pembayaran Sisa</td>
                <td>:</td>
                <TD>{{ $data->sisa_pembayaran }}</TD>
            </tr>
            <td>Tanggal Pembayaran Sisa</td>
            <td>:</td>
            <td>{{ $data->tgl_pembayaran_sisa }}</td>
            </tr>
        </table>
        <h3 class="text-center m-4">Terima kasih telah berkunjung !</h3>
    </div>

</body>
<script>
    window.print();
</script>

</html>
