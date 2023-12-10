@props(['sizesCsv'])

@php
    $sizes = explode(',', $sizesCsv);
@endphp

<div class="d-flex mb-3">
    <strong class="text-dark mr-3">Sizes:</strong>
    <form>
        @foreach ($sizes as $index => $size)
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="size-{{ $index }}" name="sizes">
                <label class="custom-control-label" for="size-{{ $index }}">{{ $size }}</label>
            </div>
        @endforeach
    </form>
</div>
