@extends('layouts.guest')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Cek Sertifikat</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head">

                        </div>
                        <div class="card-body">
                            <form action="{{ route('cek-sertifikat') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Nomor Sertifikat</label>
                                    <input type="text" class="form-control input-element" name="nomor" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Cek</button>
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

        var cleave = new Cleave('.input-element', {
            prefix: 'RC',
            delimiter: ' ',
            blocks: [2, 3, 3],
            uppercase: true
        });

        @if(Session::has('error'))
        swal({
            title: "Maaf!",
            text: "{{ Session::get('error') }}",
            icon: "error"
        });
        @endif
    </script>
@endsection
