@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            @foreach($categories as $category)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $category->name }}</h5>
                        </div>
                        <div class="card-body">
                            <h3>{{ $category->qrcode_count }} QR Kod</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
