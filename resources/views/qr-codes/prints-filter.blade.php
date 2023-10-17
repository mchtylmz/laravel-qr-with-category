<div style="display: flex; gap: 3px; flex-wrap: wrap">
    @foreach($qrcodes as $qrcode)
        <div style="width: {{ $size }}px; border: solid 1px #99999950; padding: 5px;">
            <img src="{{ asset('qrcodes/'.$qrcode->qr_code) }}" style="height: {{ $size }}px"/>
            @if($category_info)
                <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->category->name }}</p>
            @endif
            @if($title_info)
                <h4 style="text-align: center;margin:0; padding: 5px">{{ $qrcode->title }}</h4>
            @endif
            @if($desc_info)
            <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->description }}</p>
            @endif
            @if($floor_info)
                <p style="text-align: center;margin:0; padding: 5px;word-break: break-all;">{{ $qrcode->floor }}</p>
            @endif
        </div>
    @endforeach
</div>

<script>
    window.print();
</script>
