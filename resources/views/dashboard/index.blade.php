@extends('template.main')

@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pasien</h4>
                    </div>
                    <div class="card-body">
                        {{ $data['totalPasien'] }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Belum Selesai</h4>
                    </div>
                    <div class="card-body">
                        {{ $data['belumSelesai'] }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Selesai</h4>
                    </div>
                    <div class="card-body">
                        {{ $data['selesai'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card text-center">
        <img class="card-img-top" src="holder.js/100px180/" alt="">
        <div class="card-body">
            <h4 class="card-title">Pendapatan Bulan {{ $data['bulanSekarang'] }}</h4>
            <p class="card-text">{{ $data['jumlahPendapatan'] }}</p>
        </div>
    </div>
@endsection
