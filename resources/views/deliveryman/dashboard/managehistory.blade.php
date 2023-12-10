<x-layout_delivaryman>


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">My Delivery History </h5>

            <ul class="list-group">
                @foreach ($deliveryHistory as $delivery)
                    <li class="list-group-item">

                        <p><strong>Number</strong>: {{ $loop->iteration }}</p>
                        <p><strong>Name</strong> : {{ $delivery->name }}</p>
                        <p><strong>Tracking No</strong>: {{ $delivery->tracking_no }}</p>
                        @if ($delivery->payment_mode === 'pay_on_delivery')
                            <p><strong>Gave Me</strong>:Sh{{ number_format($delivery->calculated_total, 2, '.', ',') }}
                            </p>
                        @elseif ($delivery->payment_mode === 'mobile_payment')
                            <p><strong>Paid</strong>: Mobile means</p>
                        @elseif ($delivery->payment_mode === 'bank_payment')
                            <p><strong>Paid</strong>: Bank means</p>
                        @endif
                        <p><strong> Select Order Date</strong>: {{ $delivery->selectorderdate }}</p>
                        <p><strong>Delivered Date</strong>: {{ $delivery->deliveredorderdate }}</p>


                    </li>
                @endforeach


            </ul><!-- End Default List group -->

        </div>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="{{ $deliveryHistory->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <!-- Loop through the available pages -->
            @for ($i = 1; $i <= $deliveryHistory->lastPage(); $i++)
                <li class="page-item {{ $deliveryHistory->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $deliveryHistory->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item">
                <a class="page-link" href="{{ $deliveryHistory->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</x-layout_delivaryman>
