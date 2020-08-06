@extends('layouts.guest')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Cetak Sertifikat</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head">

                        </div>
                        <div class="card-body">
                            <form action="{{ route('cetak-sertifikat') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Pilih Kelas</label>
                                    <select class="form-control" name="kelas">
                                        @foreach ($event as $e)
                                        <option value="{{ $e->id }}">{{ $e->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Email Terdaftar</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Cetak</button>
                            </form>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')
    <script>
        @if(Session::has('error'))
            swal({
                title: "Maaf!",
                text: "{{ Session::get('error') }}",
                icon: "error"
            });
        @endif
    </script>
@endsection
