@props(['outlinesCsv'])

@php
    $outlines = explode('.', $outlinesCsv);
@endphp

<div class="col-md-6">
    <ul class="list-group list-group-flush">
        <h3 class="font-weight-semi-bold mb-4">Key Features</h3>

        @foreach ($outlines as $outline)
            <li class="list-group-item px-0">-
                {{ $outline }}
            </li>
        @endforeach
    </ul>
</div>
