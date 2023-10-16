@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-3 mt-3">

            <form class="add" action="{{ route('qr_codes.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">QR Kod Başlığı</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Başlık" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">QR Kod İçeriği</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="........" required></textarea>
                    <small>Bu içerik QR kod oluşturulduktan sonra değiştirilemez</small>
                </div>
                <div class="mb-3">
                    <label for="floor" class="form-label">Kat Bilgisi</label>
                    <input type="text" class="form-control" id="floor" name="floor" placeholder="Kat, 1. Kat, -1. Kat...">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-control selectpicker" data-size="5" data-live-search="true" id="category_id" name="category_id" required>
                        <option value="" selected>Seçiniz</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 d-grid">
                    <button type="submit" class="btn btn-primary">Oluştur ve Ekle</button>
                </div>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            $(function() {
                $('form.add').validate({
                    submitHandler: function(form, e) {
                        e.preventDefault();

                        if (
                            !confirm('QR kod oluşturduktan sonra içerik değişikliği yapılamaz, işleme devam edilsin mi?')
                        ) {
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
                                        location.href = '{{ route('qr_codes') }}';
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
        </script>
    @endpush
@endsection
