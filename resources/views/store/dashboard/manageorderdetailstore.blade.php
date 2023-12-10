<x-layout_store>
    <div class="pagetitle">
        <h1>Manage Orders </h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item"> Orders & Payments </li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.manageorderstore') }}">Manage Orders</a></li>
            <li class="breadcrumb-item active">View Order Details</li>

          </ol>
        </nav>
      </div><!-- End Page Title -->



      <section class="section">
        <div class="row ">

      <div class="col-lg-12 ">


        <div class="card">
            <div class="card-body">
              <h5 class="card-title">User Details   </h5>

              <!-- List group with active and disabled items -->
              <ul class="list-group list-group-flush">
                <p> <strong>Customer Name</strong>:{{ $order->name }}</p></li>
                <p><strong>Email</strong>       :{{ $order->email }}</p>
                <p><strong>Phone Number</strong>   :{{ $order->number }}</p>
                <p><Strong>Location</Strong>    : <b>City--</b>{{ $order->city }}, <b>Division</b> {{ $order->division }}, <b>Street</b> {{ $order->street }}</p>
              </ul>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Order Details</h5>

              <!-- List group with active and disabled items -->
              <ul class="list-group list-group-flush">
                <p> <strong>Tracking No</strong>:{{ $order->tracking_no }}</p></li>
                <p><strong>Order Date</strong>       :{{ $order->orderdate }}</p>
                <p><strong>Email</strong>       :{{ $order->email }}</p>
                <p><strong>Payment Mode</strong>   :{{ $order->payment_mode }}</p>
                <p><strong>Order Status Message</strong>   :

                @if ($order->Order_status === 'ordered')
                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> {{ $order->Order_status }}</span>
                @elseif ($order->Order_status === 'On Delivery')
                <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> {{ $order->Order_status }}</span>
                @elseif ($order->Order_status === 'Delivered')
                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> {{ $order->Order_status }}</span>
                @endif
            </p>
              </ul>
            </div>
          </div>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title"> Order Details</h5>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"> image</th>
                    <th scope="col"> Product Name</th>
                    <th scope="col"> Quantity</th>
                    <th scope="col"> Price</th>
                    <th scope="col"> Size</th>
                    <th scope="col"> color</th>
                    <th scope="col">total</th>
                  </tr>

                </thead>
                <tbody>
                 @php
                 $sn=1;
             @endphp
            @foreach ($order->orderitems as $orderitem)


                  <tr>
                    <th scope="row">{{ $sn++ }}</th>
                    <td>
                        {{-- {{ $orderitem->photo }} --}}
                        <img src="{{ $orderitem->photo ? asset('storage/'.$orderitem->photo) : asset('../assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle" width="50px">

                    </td>
                    <td>{{ $orderitem->product_name }}</td>
                    <td>{{ $orderitem->quantity }}</td>\
                    <td>{{ $orderitem->price }}</td>
                    <td>{{ $orderitem->item_sizes }}</td>
                    <td>{{ $orderitem->item_colors }}</td>
                    <td>total</td>

                  </tr>
                  @endforeach



                </tbody>
              </table>








              <p> <strong> Shipping</strong>:Sh{{ number_format($order->shipping_fee, 2, '.', ',') }}</p></li>
              <p><strong>Total</strong>     : Sh{{ number_format($order->calculated_total, 2, '.', ',') }}</p>

          </div>
        </div>

        </div>

    </div>
    </section>


</x-layout_store>

