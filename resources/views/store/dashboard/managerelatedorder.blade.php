<x-layout_store>



        <div class="container">
            <h1>Related Orders</h1>

            @foreach ($groupedOrderItems as $productName => $items)
                <h2>Product: {{ $productName }}</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Color</th>
                            <th>Size</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->order->id }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->item_colors }}</td>
                                <td>{{ $item->item_sizes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>



        {{-- <div class="container">
            <h1>Related Orders</h1>

            @foreach ($orders as $order)
                <h2>Order #{{ $order->id }}</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($groupedOrderItems[$order->id] as $product => $items)
                      @php
                          $totalQuantity = 0;
                          $totalPrice = 0;
                      @endphp

                      @foreach ($items as $item)
                          @php
                              $totalQuantity += $item['quantity']; // Access 'quantity' using array notation
                              $totalPrice += $item['price'];       // Access 'price' using array notation
                          @endphp
                      @endforeach

                      <tr>
                          <td>{{ $product }}</td>
                          <td>{{ $totalQuantity }}</td>
                          <td>{{ $totalPrice }}</td>
                      </tr>
                  @endforeach

                    </tbody>
                </table>
            @endforeach
        </div> --}}



    </x-layout_store>



