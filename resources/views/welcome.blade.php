@extends('layouts.guest')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Mau Cetak atau Cek Sertifikat?</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-hero">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-print"></i>
                            </div>
                            <h4>Cetak Sertifikat</h4>
                            <div class="card-description">Udah ikutan kelas di Raih Cita dan pengen ambil sertifikatnya?
                                Nahh! klik tombol dibawah ya :)</div>
                            <a href="/cetak-sertifikat" class="btn btn-warning mt-3">
                                Cetak Sertifikat
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-hero">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h4>Cek Sertifikat</h4>
                            <div class="card-description">Ragu sama keaslian sertifikat? Pengen Cek keaslian sertifikat? langsung aja klik link dibawah
                                ini :)</div>
                            <a href="/cek-sertifikat" class="btn btn-warning mt-3">
                                Cek Sertifikat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </section>


</div>

@endsection
