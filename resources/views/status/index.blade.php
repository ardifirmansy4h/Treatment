@extends('template.main')
@section('content')
    <div class="section-header">
        <h1>Status Pasien</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Pasien Belum Selesai</h4>
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
                                @foreach ($proses as $item)
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
                        <h4>Pasien Sudah Selesai</h4>
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
                                    <th>Uang Muka</th>
                                    <th>Sisa Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selesai as $item)
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
                                        <td class="text-nowrap">{{ 'Rp ' . number_format($item->sisa_pembayaran, 0, ',', '.') }}</td>
                                        <td><div class="btn btn-primary">Cetak</div></td>
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
