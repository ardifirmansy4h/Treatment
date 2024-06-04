@extends('template.main')
@section('content')
    <div class="section-header">
        <h1>Status Pasien</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <h4>Laporan Bulanan</h4>
            </div>
            <form action="{{ route('laporan.tes') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <select id="bulan" name="bulan" class="form-control">
                        @php
                            $months = [
                                'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember',
                            ];
                        @endphp
                        @foreach ($months as $index => $month)
                            <option value="{{ $index + 1 }}">{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select id="tahun" name="tahun" class="form-control">
                        @php
                            $currentYear = now()->year;
                            $startYear = $currentYear - 4;
                            $endYear = $currentYear + 1;
                        @endphp
                        @for ($year = $startYear; $year <= $endYear; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
