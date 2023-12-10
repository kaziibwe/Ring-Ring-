@props(['outline_tagsCsv'])

@php
    $outline_tagss = explode('.', $outline_tagsCsv);
@endphp

<div class="col-md-6">
    <ul class="list-group list-group-flush">
        <h3 class="font-weight-semi-bold mb-4">What's is in the Box</h3>

        @foreach ($outline_tagss as $outline_tag)
            <li class="list-group-item px-0">-
                {{ $outline_tag }}
            </li>
        @endforeach
    </ul>
</div>
