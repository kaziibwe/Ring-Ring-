@props(['pricerangesCsv'])

@php
    $priceranges = explode('-', $pricerangesCsv);
@endphp
<p>
@foreach ($priceranges as $key => $pricerange)

    <h6>
        Sh{{ number_format($pricerange, 2) }}
        @if (!$loop->last)
            <!-- Check if it's not the last item -->
            - <!-- Add hyphen unless it's the last item -->
        @endif
    </h6>
@endforeach
</p>
