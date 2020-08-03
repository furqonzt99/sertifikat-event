@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Dashboard') }}</h1>
        </div>

        <div class="section-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Event</h4>
                    <div class="card-header-action">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($event as $event)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h4>{{ $event->nama }}</h4>
                                    <div class="card-header-action">
                                        <a href="{{ route('detail-event', $event->id) }}"
                                            class="btn btn-primary">Detail</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2 text-muted">{{ $event->tgl_mulai }} - {{ $event->tgl_selesai }}
                                    </div>
                                    <br>
                                    <div class="chocolat-parent">
                                        <a href="{{ asset ('storage/'. $event->sertifikat) }}" class="chocolat-image"
                                            title="Just an example">
                                            <div data-crop-image="285"
                                                style="overflow: hidden; position: relative; height: 285px;">
                                                <img alt="image" src="{{ asset ('storage/'. $event->sertifikat) }}"
                                                    class="img-fluid">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-warning" id="edt" data-toggle="modal" data-target="#edit"
                                            data-id_evt="{{ $event->id }}" data-nama="{{ $event->nama }}"
                                            data-tgl_mulai="{{ $event->tgl_mulai }}"
                                            data-tgl_selesai="{{ $event->tgl_selesai }}">Edit</button>
                                        <button class="btn btn-danger trigger--fire-modal-1"
                                            data-confirm="Yakin?|Anda ingin melanjutkan?"
                                            data-confirm-yes="location.href = '{{ route('hapus-event', $event->id) }}';">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
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
                <h4 class="modal-title">Tambah Event</h4>
                <div class="card-header-action">
                    <a data-dismiss="modal" class="btn btn-icon btn-danger" href="#"><i class="fas fa-times"></i></a>
                </div>
            </div>
            <!-- body modal -->
            <div class="modal-body">
                <form action="{{ route('tambah-event') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama Event</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai Event</label>
                        <input type="date" class="form-control" name="tgl_mulai">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai Event</label>
                        <input type="date" class="form-control" name="tgl_selesai">
                    </div>
                    <div class="form-group">
                        <label>File Template Sertifikat (Maksimal 2MB)</label>
                        <input type="file" class="form-control" name="sertifikat">
                    </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Event</h4>
                <div class="card-header-action">
                    <a data-dismiss="modal" class="btn btn-icon btn-danger" href="#"><i class="fas fa-times"></i></a>
                </div>
            </div>
            <!-- body modal -->
            <div class="modal-body">
                <form action="" id="up_evt" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama Event</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai Event</label>
                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai Event</label>
                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai">
                    </div>
                    <div class="form-group">
                        <label>File Template Sertifikat (Maksimal 2MB)</label>
                        <input type="file" class="form-control" name="sertifikat">
                    </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
@error('sertifikat')
<script>
    swal({
        title: "Gagal!",
        text: "{{ $message}} Ukuran Maksimal 2MB",
        icon: "error"
    });
</script>

@enderror
<script>
    $(document).ready(function() {
        $(document).on('click', '#edt', function() {
            var id_evt = $(this).data('id_evt');
            var nama = $(this).data('nama');
            var tgl_mulai = $(this).data('tgl_mulai');
            var tgl_selesai = $(this).data('tgl_selesai');

            var url = '{{ route('update-event', ':id_evt') }}';
            url = url.replace(':id_evt', id_evt);

            $('#up_evt').attr('action', url);
            $('#nama').val(nama);
            $('#tgl_mulai').val(tgl_mulai);
            $('#tgl_selesai').val(tgl_selesai);
        })
    })
</script>
@endsection
