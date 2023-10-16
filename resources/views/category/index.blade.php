@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Kategori Ekle
            </div>
            <div class="card-body">
                <form class="row g-3 add" action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <div class="col-sm-9">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Kategori.." required />
                            <label for="name">Kategori Başlığı</label>
                        </div>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary mb-3">EKLE</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="py-3 mt-3">
            <div class="row justify-content-end align-items-center gap-1">
                <div class="col-sm-3">
                    <form class="row g-1" method="get">
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
                    <th scope="col">ID</th>
                    <th scope="col">Kategori Başlığı</th>
                    <th scope="col">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>
                            <form class="delete" action="{{ route('categories.delete', $category->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger px-3">SİL</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $categories->links() }}

        </div>

    </div>


    @push('scripts')
        <script>
            $(function() {
                $('form.add').validate({
                    rules: {
                        name: { required : true }
                    },
                    highlight: function (element) {
                        $(element).closest('.form-floating').removeClass('has-success').addClass('has-error');
                    },
                    unhighlight: function (element) {
                        $(element).closest('.form-floating').removeClass('has-error').addClass('has-success');
                    },
                    errorPlacement: function( label, element ) {
                        label.insertAfter(element.parent());
                    },
                    submitHandler: function(form, e) {
                        e.preventDefault();

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
                $('form.delete').each(function() {
                    $(this).validate({
                        submitHandler: function(form, e) {
                            e.preventDefault();

                            if (!confirm('Kategori siliniyor, onaylıyor musunuz?')) {
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
