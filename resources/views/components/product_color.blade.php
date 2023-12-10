{{-- @props(['colorsCsv'])

<!-- Assuming this is your Blade view where you're using the component -->

    <!-- x-product_color.blade.php component file -->
    @props(['colorsCsv'])

    @php
    $colors = explode(',', $colorsCsv);
    @endphp

    <div class="d-flex mb-4">
            @foreach ($colors as $index => $color)
            <div class="custom-control custom-radio custom-control-inline form-check">
                <input type="radio" class="custom-control-input" id="color-{{ $index }}" name="colors">
                <label class="custom-control-label" for="color-{{ $index }}">{{ $color }}</label>
            </div>
            @endforeach


    </div> --}}


<!-- resources/views/components/product_color1.blade.php -->

@props(['colorsCsv'])

@php
    $colors = explode(',', $colorsCsv);
@endphp

<div class="d-flex mb-4">

    @foreach ($colors as $index => $color)
        <div class="form-check">
            <input type="checkbox" name="selected_colors[]" id="color-{{ $index }}" value="{{ $color }}">

            <label class="form-check-label" for="color-{{ $index }}">
                {{ $color }}
            </label>
        </div>
    @endforeach
</div>
