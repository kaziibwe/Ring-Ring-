
<x-layout_delivaryman>
{{-- <table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>name</th>
            <th>Tracking No</th>
            <th>Select Delivery Date</th>
            <!-- Add more headers as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>

                <td>{{ $order->tracking_no }}</td>

                <td>{{ $order->deliveries->first()->selectorderdate }}
               <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
            </td>
                <!-- Display other delivery-related information as needed -->
            </tr>
        @endforeach
    </tbody>
</table> --}}


<div class="card">
    <div class="card-body">
        <h5 class="card-title">My Orders for Delivery </h5>

        <!-- Default List group -->
        <ul class="list-group">
            @foreach ($orders as $order)
                <li class="list-group-item">
                    <p><strong>Order Id</strong> : {{ $order->id }}</p>
                    <p><strong>Name</strong> : {{ $order->name }}</p>
                    <p><strong>Phone</strong> : {{ $order->number }}</p>
                    {{-- <p><strong>Phone</strong> : {{ $order->Order_number }}</p> --}}


                    <p><strong>Tracking Id</strong>: {{ $order->tracking_no }}</p>
                    <p><strong>Location</strong>:{{ $order->street }},{{ $order->division }},{{ $order->city }}</p>
                    <p><strong>Selected Order Time</strong>:{{ $order->deliveries->first()->selectorderdate }} </p>
                        @if ($order->payment_mode === 'pay_on_delivery')
                        <p><strong>Give Me</strong>:Sh{{ number_format($order->calculated_total, 2, '.', ',') }}</p>
                        @elseif ($order->payment_mode === 'mobile_payment')
                        <p><strong>Paid</strong>: {{ $order->mobile_payment }}</p>

                        @endif



                        <form action="{{ route('confirm.delivery') }}" method="POST">
                        @csrf
                        <input type="hidden" id="tracking_no" name="tracking_no" value="{{ $order->tracking_no }}">

                            <div class="row mb-3">
                                <label for="Order_number" class="col-md-4 col-lg-3 col-form-label">Current
                                    Enter Code</label>
                                <div class="col-md-8 col-lg-9">
                                    <input
                                    name="Order_number"
                                    type="text"
                                    class="form-control order-number-input"
                                    value="{{ old('Order_number') }}"
                                    data-tracking-no="{{ $order->tracking_no }}"
                                    id="Order_number_{{ $order->tracking_no }}"
                                >
                                <span id="verifyOrderCode_{{ $order->tracking_no }}"> </span>

                                    {{-- <input name="Order_number" type="text" class="form-control order-number-input"  value="{{ old('Order_number') }}"
                                    id="Order_number_{{ $order->tracking_no }}">
                                        <span id="verifyOrderCode_{{ $order->tracking_no }}" > </span> --}}
                                    {{-- <input name="Order_number" type="number" class="form-control"  value="{{ old('Order_number') }}"
                                        id="Order_number">
                                        <span id="verifyOrderCode" > </span> --}}
                                        @error('Order_number')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-sm-10">
                                <input type="number" class="form-control" name="Order_number" id="Order_number" maxlength="8"
                                    value="{{ old('Order_number') }}"><span id="verifyOrderCode" > </span>
                                @error('Order_number')
                                    <code>{{ $message }}</code>
                                @enderror
                            </div> --}}
                            <input type="hidden" name="name" value="{{ $order->name }}">
                            <input type="hidden" name="calculated_total" value="{{ $order->calculated_total }}">
                            <input type="hidden" name="payment_mode" value="{{ $order->payment_mode }}">



                        <button type="submit" class="btn btn-warning"><i class="bi bi-exclamation-triangle"></i></button>
                        </form>
                    </td>

                    {{-- <form action="{{ route('dashboard.ondeliveryorder') }}" method="post">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                    </form> --}}
                </li>
            @endforeach


        </ul><!-- End Default List group -->

    </div>
</div>
</x-layout_delivaryman>
