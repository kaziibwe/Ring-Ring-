<x-layout_delivaryman>
    {{-- <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>

          <!-- List group With badges -->
          <ul class="list-group">
            @foreach ($orders as $order)

            <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p>Name : {{ $order->name }}</p> <br>
                    <p>Order Id</p><br>
                    <p>Location</p><br>
              <span class="badge bg-primary rounded-pill">14</span>
            </li>
            @endforeach

          </ul><!-- End List With badges -->

        </div>
      </div> --}}

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Processed Orders for Delivary</h5>

            <!-- Default List group -->
            <ul class="list-group">
                @foreach ($orders as $order)
                    <li class="list-group-item">
                        <p><strong>Name</strong> : {{ $order->name }}</p>
                        <p><strong>Tracking No</strong>: {{ $order->tracking_no }}</p>
                        <p><strong>Location</strong>:{{ $order->street }},{{ $order->division }},{{ $order->city }}</p>

                        <form action="{{ route('dashboard.ondeliveryorder') }}" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                        </form>
                    </li>
                @endforeach


            </ul><!-- End Default List group -->

        </div>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <!-- Loop through the available pages -->
            @for ($i = 1; $i <= $orders->lastPage(); $i++)
                <li class="page-item {{ $orders->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item">
                <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</x-layout_delivaryman>
