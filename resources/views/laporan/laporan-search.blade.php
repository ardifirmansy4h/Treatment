@extends('template.main')
@section('content')
    <div class="section-header">
        <h1>Laporan Bulanan</h1>
    </div>
    <div>
        <div class="card text-center">
            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <div class="card-body">
                <h4 class="card-title">Pendapatan Bulan {{ $data['bulan'] }} Tahun {{ $data['tahun'] }}</h4>
                <p class="card-text">{{ $data['totalPendapatan'] }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Pendapatan Uang Muka</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Jenis Treatment</th>
                                    <th>Keterangan</th>
                                    <th>Uang Muka</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['dataAllUangMuka'] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->slot->tanggal)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ $item->slot->jam->waktu }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->jenis->nama }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td class="text-nowrap">{{ 'Rp ' . number_format($item->dp, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Pendapatan Sisa Pembayaran</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Jenis Treatment</th>
                                    <th>Keterangan</th>
                                    <th>Sisa Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['dataAllPembayaranSisa'] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->slot->tanggal)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ $item->slot->jam->waktu }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->jenis->nama }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td class="text-nowrap">
                                            {{ 'Rp ' . number_format($item->sisa_pembayaran, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="btn btn-primary">Cetak</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
