<div style="width: 250px; border: solid 1px #999;">
    <img src="{{ asset('qrcodes/'.$qrcode->qr_code) }}" style="height: 250px" />
    <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->category->name }}</p>
    <h4 style="text-align: center;margin:0; padding: 5px">{{ $qrcode->title }}</h4>
    <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->description }}</p>
</div>
<script>
    window.print();
</script>
