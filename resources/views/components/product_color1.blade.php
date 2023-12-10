{{-- <!-- resources/views/components/product_color1.blade.php -->

@props(['itemcolorsCsv'])

@php
$itemcolors = explode(',', $itemcolorsCsv);
@endphp

<div class="d-flex mb-4">
    <strong class="text-dark mr-3">Colors:</strong>

    @foreach ($itemcolors as $index => $itemcolor)
    <div class="form-check">
        <input
            type="checkbox"
            name="selected_itemcolors[]"
            id="itemcolor-{{ $index }}"
            value="{{ $itemcolor }}"
        >

        <label class="form-check-label" for="itemcolor-{{ $index }}">
            {{ $itemcolor }}
        </label>
    </div>
    @endforeach
</div> --}}

@props(['itemcolorsCsv', 'sizeId'])

@php
    $itemcolors = explode(',', $itemcolorsCsv);
@endphp

<div class="d-flex mb-4">
    <strong class="text-dark mr-3">Colors:</strong>
    @foreach ($itemcolors as $index => $itemcolor)
        <div class="form-check">
            <input type="checkbox" name="selected_colors[{{ $sizeId }}][]"
                id="color-{{ $sizeId }}-{{ $index }}" value="{{ $itemcolor }}">

            <label class="form-check-label" for="color-{{ $sizeId }}-{{ $index }}">
                {{ $itemcolor }}
            </label>
        </div>
    @endforeach
</div>
