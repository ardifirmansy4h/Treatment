@extends('template.main')
@section('content')
    <div class="section-header">
        <h1>Pendaftaran Pasien</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-header d-flex justify-content-between">
                        <h4></h4>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#pendaftaranModal">Tambah</a>
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
                                    <th>Usia</th>
                                    <th>Alamat</th>
                                    <th>Jenis Treatment</th>
                                    <th>Keterangan</th>
                                    <th>Uang Muka</th>
                                    <th>Tanggal Pembayaran Uang Muka </th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <input type="hidden" name="idB" value="{{ $item->id }}">

                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->slot->tanggal)->translatedFormat('d F Y') }}
                                        </td>
                                        <td class="waktu">{{ $item->slot->jam->waktu }}</td>
                                        <td class="nama">{{ $item->nama }}</td>
                                        <td class="gender">{{ $item->jenis_kelamin }}</td>
                                        <td class="usia">{{ $item->usia }}</td>
                                        <td class="alamat">{{ $item->alamat }}</td>
                                        <td class="jenis" data-jenis="{{ $item->jenis_id }}">{{ $item->jenis->nama }}</td>
                                        <td class="keterangan">{{ $item->keterangan }}</td>
                                        <td class="text-nowrap dp" data-dp="{{ $item->dp }}">
                                            {{ 'Rp ' . number_format($item->dp, 0, ',', '.') }}</td>
                                        <td class="tgl_dp" data-tgldp="{{ $item->tgl_pembayaran_dp }}">
                                            {{ \Carbon\Carbon::parse($item->tgl_pembayaran_dp)->translatedFormat('d F Y') }}
                                        <td>
                                            @if ($item->status == 1)
                                                Belum Selesai
                                            @elseif ($item->status == 2)
                                                Selesai
                                            @else
                                                Status Tidak Diketahui
                                            @endif
                                        </td>
                                        <td class="d-flex flex-nowrap">
                                            @if ($item->status == 1)
                                                <a href="#" class="btn btn-success mr-2"
                                                    onclick="setId({{ $item->id }})" data-toggle="modal"
                                                    data-target="#selesaiModal">Selesai</a>
                                                <a href="/pendaftaran/edit/{{ $item->id }}" id="btn-editt"
                                                    class="btn btn-warning mr-2" data-toggle="modal"
                                                    data-target="#pendaftaranModalEdit">Edit</a>
                                            @endif

                                            <a href="" class="btn btn-danger delete-pendaftaran"
                                                data-id="{{ $item->id }}">Hapus</a>
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


    @if (session('slotBelumPenuh'))
        <div class="card">
            <h4 class="text-center dt-center">Daftar slot yang belum penuh:</h4>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session('slotBelumPenuh') as $slott)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($slott->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $slott->jam->waktu }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

@endsection
@section('modal')
    <div class="modal fade" id="selesaiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Selesai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/pendaftaran/selesai" method="post" enctype="multipart/form-data" id="selesaiForm">
                        @csrf
                        <label for="">Tanggal Pembayaran</label>
                        <input type="date" name="tanggal" class="form-control"required>
                        <input type="number" name="sisa" class="form-control mt-2" placeholder="Sisa Pembayaran"
                            required>
                        <input type="hidden" name="id" id="itemId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pendaftaranModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/pendaftaran/tambah" method="post" enctype="multipart/form-data">
                        @csrf
                        <select name="slot" class="form-control mt-3" required>
                            <option value="">Pilih Tanggal & Jam</option>
                            @foreach ($slot as $item)
                                <option value="{{ $item->id }}">Tanggal
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }} & Jam
                                    {{ $item->jam->waktu }} </option>
                            @endforeach
                        </select>
                        <input type="text" name="nama" class="form-control mt-3" placeholder="Nama" required>
                        <select name="jenis_kelamin" class="form-control mt-3" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <input type="number" name="usia" class="form-control mt-3" placeholder="Usia" required>
                        <textarea name="alamat" class="form-control mt-3" cols="30" rows="10" placeholder="Alamat" required></textarea>

                        <select name="jenis" class="form-control mt-3" required>
                            <option value="">Pilih Jenis Treatment</option>
                            @foreach ($jenis as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>

                        <textarea name="keterangan" class="form-control mt-3" cols="30" rows="10" placeholder="Keterangan" required></textarea>
                        <input type="number" name="dp" class="form-control mt-3" placeholder="Uang Muka" required>
                        <label for="" class="mt-3">Tanggal Pembayaran Uang Muka</label>
                        <input type="date" name="tanggal_pembayaran" class="form-control mt-3" placeholder="Tanggal"
                            required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pendaftaranModalEdit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/pendaftaran/edit" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="pendaftaranIDEdit" name="id" class="form-control" readonly>
                        <input id="namaEdit" type="text" name="nama" class="form-control mt-3"
                            placeholder="Nama" required>
                        <select id="genderEdit" name="jenis_kelamin" class="form-control mt-3" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <input type="number" id="usiaEdit" name="usia" class="form-control mt-3"
                            placeholder="Usia" required>
                        <textarea id="alamatEdit" name="alamat" class="form-control mt-3" cols="30" rows="10"
                            placeholder="Alamat" required></textarea>

                        <select id="jenisEdit" name="jenis" class="form-control mt-3" required>
                            <option value="">Pilih Jenis Treatment</option>
                            @foreach ($jenis as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>

                        <textarea id="keteranganEdit" name="keterangan" class="form-control mt-3" cols="30" rows="10"
                            placeholder="Keterangan" required></textarea>

                        <input type="number" id="dpEdit" name="dp" class="form-control mt-3"
                            placeholder="Uang Muka" required>
                        <label for="" class="mt-3">Tanggal Pembayaran Uang Muka</label>
                        <input type="date" id="tglPembayaranEdit" name="tanggal_pembayaran" class="form-control mt-3"
                            placeholder="Tanggal" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('hapus')
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-primary" id="deleteButton">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function setId(id) {
            document.getElementById('itemId').value = id;
        }

        $('#btn-editt').on('click', function(e) {
            e.preventDefault();
            var id = $(this).closest('tr').find('input[name="idB"]').val();
            var nama = $(this).closest('tr').find('.nama').text();
            var gender = $(this).closest('tr').find('.gender').text();
            var alamat = $(this).closest('tr').find('.alamat').text();
            var usia = $(this).closest('tr').find('.usia').text();
            var dp = $(this).closest('tr').find('.dp').data('dp');
            var keterangan = $(this).closest('tr').find('.keterangan').text();
            var tglPembayaranDp = $(this).closest('tr').find('.tgl_dp').data('tgldp');
            var jenis = $(this).closest('tr').find('.jenis').data('jenis');

            $('#pendaftaranIDEdit').val(id);
            $('#namaEdit').val(nama);
            $('#genderEdit').val(gender);
            $('#alamatEdit').val(alamat);
            $('#usiaEdit').val(usia);
            $('#keteranganEdit').val(keterangan);
            $('#dpEdit').val(dp);
            $('#tglPembayaranEdit').val(tglPembayaranDp);
            $('#jenisEdit').val(jenis);

            $('#pendaftaranModalEdit').modal('show');
        });
    </script>
@endpush
