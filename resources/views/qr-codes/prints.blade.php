@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-3 mt-3">
            <h4>Yazdırma işlemleri</h4>
            <p>Aşağıda seçilen seçeneklere göre QR kod yazdırma listesi hazırlanacaktır</p>
            <form class="print" action="{{ route('qr_codes.prints.filtered') }}" method="get">
                <div class="mb-3">
                    <label for="size" class="form-label">QR Kodu Boyutu</label>
                    <select class="form-control selectpicker" data-size="5" data-live-search="true" id="size" name="size" required>
                        <option value="" selected>Seçiniz</option>
                        <option value="15">15px X 15px</option>
                        <option value="25">25px X 25px</option>
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i * 50 }}">{{ $i * 50 }}px X {{ $i * 50 }}px</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">QR Kod Başlığı (Opsiyonel)</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Başlık">
                </div>
                <div class="mb-3">
                    <label for="floors" class="form-label">Kat Bilgisi</label>
                    <select class="form-control selectpicker" data-size="5" data-live-search="true" id="floors" name="floors[]" multiple data-actions-box="true">
                        @foreach($floors as $floor)
                            <option value="{{ $floor }}">{{ empty($floor) ? 'Boş' : $floor }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="categories" class="form-label">Kategori</label>
                    <select class="form-control selectpicker" data-size="5" data-live-search="true" id="categories" name="categories[]" multiple data-actions-box="true">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="text_category" value="1" name="text_category" checked>
                        <label class="form-check-label" for="text_category">QR Kod altında kategori adı yazsın</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="text_title" value="1" name="text_title" checked>
                        <label class="form-check-label" for="text_title">QR Kod altında başlığı yazsın</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="text_desc" value="1" name="text_desc">
                        <label class="form-check-label" for="text_desc">QR Kod altında açıklaması yazsın</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="text_floor" value="1" name="text_floor">
                        <label class="form-check-label" for="text_floor">QR Kod altında kat bilgisi yazsın</label>
                    </div>
                </div>
                <div class="mb-3 d-grid">
                    <button type="submit" class="btn btn-primary">Filtrele ve Yazdır</button>
                </div>
            </form>
        </div>
    </div>

@endsection
