<div style="display: flex; gap: 50px; align-items: baseline">
    <div style="width: 100px; border: solid 1px #999;">
        <img src="{{ asset('qrcodes/'.$qrcode->qr_code) }}" style="height: 100px" />
        <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->category->name }}</p>
        <h4 style="text-align: center;margin:0; padding: 5px">{{ $qrcode->title }}</h4>
        <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->description }}</p>
    </div>
    <div style="width: 100px; border: solid 1px #999;">
        <img src="{{ asset('qrcodes/'.$qrcode->qr_code) }}" style="height: 100px" />
        <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->category->name }}</p>
        <h4 style="text-align: center;margin:0; padding: 5px">{{ $qrcode->title }}</h4>
    </div>
    <div style="width: 100px; border: solid 1px #999;">
        <img src="{{ asset('qrcodes/'.$qrcode->qr_code) }}" style="height: 100px" />
        <h4 style="text-align: center;margin:0; padding: 5px">{{ $qrcode->title }}</h4>
    </div>
</div>
<hr>
<div style="display: flex; gap: 25px; align-items: baseline">
    <div style="width: 150px; border: solid 1px #999;">
        <img src="{{ asset('qrcodes/'.$qrcode->qr_code) }}" style="height: 150px" />
        <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->category->name }}</p>
        <h4 style="text-align: center;margin:0; padding: 5px">{{ $qrcode->title }}</h4>
        <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->description }}</p>
    </div>
    <div style="width: 150px; border: solid 1px #999;">
        <img src="{{ asset('qrcodes/'.$qrcode->qr_code) }}" style="height: 150px" />
        <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->category->name }}</p>
        <h4 style="text-align: center;margin:0; padding: 5px">{{ $qrcode->title }}</h4>
    </div>
    <div style="width: 150px; border: solid 1px #999;">
        <img src="{{ asset('qrcodes/'.$qrcode->qr_code) }}" style="height: 150px" />
        <h4 style="text-align: center;margin:0; padding: 5px">{{ $qrcode->title }}</h4>
    </div>
</div>
<hr>
<div style="display: flex; gap: 15px; align-items: baseline">
    <div style="width: 225px; border: solid 1px #999;">
        <img src="{{ asset('qrcodes/'.$qrcode->qr_code) }}" style="height: 225px" />
        <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->category->name }}</p>
        <h4 style="text-align: center;margin:0; padding: 5px">{{ $qrcode->title }}</h4>
        <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->description }}</p>
    </div>
    <div style="width: 225px; border: solid 1px #999;">
        <img src="{{ asset('qrcodes/'.$qrcode->qr_code) }}" style="height: 225px" />
        <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->category->name }}</p>
        <h4 style="text-align: center;margin:0; padding: 5px">{{ $qrcode->title }}</h4>
    </div>
    <div style="width: 225px; border: solid 1px #999;">
        <img src="{{ asset('qrcodes/'.$qrcode->qr_code) }}" style="height: 225px" />
        <h4 style="text-align: center;margin:0; padding: 5px">{{ $qrcode->title }}</h4>
    </div>
</div>

<script>
    window.print();
</script>
