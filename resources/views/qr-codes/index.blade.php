@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-3 mt-3">
            <div class="row justify-content-end align-items-center gap-1">
                <div class="col-sm-6">
                    <form class="row g-1" method="get">
                        <div class="col-auto">
                            <select class="form-control selectpicker" data-size="5" data-live-search="true" id="c" name="c">
                                <option value="">Tüm Kategoriler</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"@selected(request('c') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="q" class="visually-hidden">Ara</label>
                            <input type="text" class="form-control" id="q" name="q" placeholder="Ara.." value="{{ request('q') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Ara</button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead class="table-light">
                <tr>
                    <th scope="col">QR Kod</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Qr Kod Başlığı</th>
                    <th scope="col">QR Kod Açıklama</th>
                    <th scope="col">Kat</th>
                    <th scope="col">Oluşturma</th>
                    <th scope="col">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($qr_codes as $qr_code)
                    <tr>
                        <td>
                            <img src="{{ asset('qrcodes/' . $qr_code->qr_code) }}" style="height: 48px;">
                        </td>
                        <td>{{ $qr_code->category->name }}</td>
                        <td>{{ $qr_code->title }}</td>
                        <td>{{ $qr_code->description }}</td>
                        <td>{{ $qr_code->floor }}</td>
                        <td>{{ date('Y-m-d', strtotime($qr_code->created_at)) }}</td>
                        <td>
                            <a target="_blank" href="{{ route('qr_codes.print', $qr_code->id) }}" class="btn btn-sm btn-info px-3">YAZDIR</a>
                            <form class="delete" action="{{ route('qr_codes.delete', $qr_code->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger px-3">SİL</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $qr_codes->links() }}

        </div>

    </div>


    @push('scripts')
        <script>
            $(function() {
                $('form.delete').each(function() {
                    $(this).validate({
                        submitHandler: function(form, e) {
                            e.preventDefault();

                            if (!confirm('QR kod siliniyor, geri dönüşü olmayacaktır, onaylıyor musunuz?')) {
                                return false;
                            }

                            $.ajax({
                                url : $(form).attr('action'),
                                method : 'post',
                                data : $(form).serialize(),
                                dataType : 'JSON',
                                beforeSend : function() {

                                },
                                success : function (res) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: res.message,
                                        confirmButtonText: 'Tamam'
                                    }).then((result) => {
                                        if (result) {
                                            location.reload();
                                        }
                                    })
                                },
                                error: function (res) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: res.responseJSON.message,
                                        confirmButtonText: 'Tamam'
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
