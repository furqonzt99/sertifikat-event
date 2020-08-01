@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $event->nama }}</h1>
        </div>

        <div class="section-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="card">
                @error('peserta')
                <h1>{{ $message }}</h1>
                @enderror
                <div class="card-header">
                    <h4>Peserta Kelas</h4>
                    <div class="card-header-action">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            Import Peserta
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Provinsi</th>
                            <th>Usia</th>
                            <th>Pekerjaan</th>
                            <th>Institusi</th>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $index => $peserta)
                            <tr>
                                <td>{{ $index +1 }}</td>
                                <td>{{ $peserta->nama }}</td>
                                <td>{{ $peserta->email }}</td>
                                <td>{{ $peserta->provinsi }}</td>
                                <td>{{ $peserta->usia }}</td>
                                <td>{{ $peserta->pekerjaan }}</td>
                                <td>{{ $peserta->institusi }}</td>
                            </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header">
                <h4 class="modal-title">Impor Data Peserta</h4>
                <div class="card-header-action">
                    <a data-dismiss="modal" class="btn btn-icon btn-danger" href="#"><i class="fas fa-times"></i></a>
                </div>
            </div>
            <!-- body modal -->
            <div class="modal-body">
                <form action="{{ route('import-peserta') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $event->id }}">
                    <div class="form-group">
                        <label>File Excel</label>
                        <input type="file" class="form-control" name="peserta">
                    </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Impor</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
