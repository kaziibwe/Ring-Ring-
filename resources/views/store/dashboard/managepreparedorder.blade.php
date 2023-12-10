<x-layout_store>

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        @foreach ($orders as $order)
                            <h5 class="card-title">Order #{{ $order->id }}</h5>
                            <p>
                            <button type="button" class="btn btn-warning"><i class="bi bi-exclamation-triangle"></i>view Pdf</button>
                            <button type="button" class="btn btn-info"><i class="bi bi-info-circle"></i>Print Pdf</button>
                            {{-- form to all the allow the delivery men to see the delivary --}}
                            <form method="POST" action="{{ route('dashboard.updateorderprogress', ['order' => $order->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-dark"><i class="bi bi-folder"></i>Prepared</button>
                            </form>
                           </p>
                            <!-- List group with Links and buttons -->
                            @foreach ($groupedOrderItems[$order->id] as $productName => $orderItems)
                                <p>{{ $productName }}</p>

                                <div class="list-group">
                                    @foreach ($orderItems as $orderItem)
                                        <button type="button" class="list-group-item list-group-item-action">
                                            {{ $orderItem['quantity'] }} x {{ $orderItem['price'] }} <br>
                                            {{ $orderItem['item_colors'] }} <br>
                                            {{ $orderItem['item_sizes'] }}
                                        </button>
                                    @endforeach
                                </div><!-- End List group with Links and buttons -->
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

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
</x-layout_store>
