<x-layout_store>
    <div class="pagetitle">
        <h1>Manage Orders </h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item"> Orders & Payments </li>
            <li class="breadcrumb-item active">Manage Orders</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

       <div class="card">
           <div class="card-body">
             <h5 class="card-title">Manage Order</h5>

             <!-- Table with hoverable rows -->
             <table class="table table-hover">
               <thead>
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">Tracking No</th>
                   <th scope="col">Customer Name</th>
                   <th scope="col">Payment Mode</th>
                   <th scope="col">Order Date</th>
                   <th scope="col">Order Status</th>
                   <th scope="col"> Total</th>
                   <th scope="col">contact</th>
                   <th scope="col">Action</th>

                 </tr>

               </thead>
               <tbody>
                @php
                $sn=1;
            @endphp
            @unless ($orders->isEmpty())
            @foreach ( $orders as $order )

                 <tr>
                   <th scope="row">{{ $sn++ }}</th>
                   <td>{{ $order->tracking_no }}</td>
                   <td>{{ $order->name }}</td>
                   <td>{{ $order->payment_mode }}</td>
                   <td>{{ $order->orderdate }}</td>
                   <td>

                    @if ($order->Order_status === 'ordered')
                    <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> {{ $order->Order_status }}</span>
                    @elseif ($order->Order_status === 'On Delivery')
                    <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> {{ $order->Order_status }}</span>
                    @elseif ($order->Order_status === 'Delivered')
                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> {{ $order->Order_status }}</span>
                    @elseif ($order->Order_status === 'Processed')
                    <span class="badge bg-dark"><i class="bi bi-folder me-1"></i> Processed</span>

                    @endif
                   </td>
                   <td>Sh{{ number_format($order->calculated_total, 2, '.', ',') }}</td>
                   <td>{{ $order->number }}</td>
                   <td>  <button type="button" class="btn btn-success" onclick="window.location.href = '{{ route('dashboard.manageorderdetailstore', ['order' => $order->id]) }}'">View</button></td>


                 </tr>
                 @endforeach
                 @else
                 <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                    No Order Available!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>

                 @endunless


               </tbody>
             </table>
             <!-- End Table with hoverable rows -->

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
         </div>
</x-layout_store>


