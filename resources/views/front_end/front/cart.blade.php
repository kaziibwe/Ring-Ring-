<x-layout_client>
    @include('front_end.partials.menu')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('font.index') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('front.shop') }}">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>SN</th>
                            <th>details</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php
                            $sn = 1;
                        @endphp
                        @php $total = 0   @endphp
                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity']   @endphp
                                <tr data-id="{{ $id }}">

                                    <td class="align-middle">{{ $sn++ }}</td>
                                    {{-- <td class="align-middle"><img src="{{  $details['photo'] ? asset('storage/'.$details['photo']) : asset('../assets/img/profile-img.jpg') }}" alt="" style="width: 50px;">{{ $details['product_name'] }} <br>{{ $details['item_sizes'] }}</td> --}}
                                    {{-- <td class="align-middle">
                                 <img src="{{ $details['photo'] ? asset('storage/'.$details['photo']) : asset('../assets/img/profile-img.jpg') }}" alt="" style="width: 50px;">
                          {{   $details['product_name'] }} <br>
                                <strong>Available Sizes:</strong>
                                @foreach ($details['item_sizes'] as $size)
                                    {{ $size }} <br>
                                @endforeach

                            </td> --}}
                                    <td class="align-middle">
                                        <img src="{{ $details['photo'] ? asset('storage/' . $details['photo']) : asset('../assets/img/profile-img.jpg') }}"
                                            alt="" style="width: 50px;">
                                        {{ $details['product_name'] }} <br>                                        {{ $details['product_name'] }} <br>
                                        {{-- {{ $details['supplierId'] }} <br> --}}


                                        @if (!empty($details['item_sizes']) && !empty($details['item_colors']))
                                            <br>
                                            <p> <strong> Sizes:</strong>
                                                @php
                                                    $sizes = explode(',', $details['item_sizes']);
                                                @endphp
                                                @foreach ($sizes as $size)
                                                    {{ trim($size) }} <br>
                                                @endforeach
                                            </p>

                                            <!-- ... other content ... -->
                                            @if (!empty($details['item_colors']))
                                                <p>Colors: {{ implode(', ', $details['item_colors']) }}</p>
                                            @else
                                                <p>No colors selected</p>
                                            @endif
                                        @elseif (!empty($details['item_colors']))
                                            <br>
                                            <p>Colors: {{ implode(', ', $details['item_colors']) }}</p>
                                        @elseif (!empty($details['item_sizes']))
                                            <br>
                                            <p> <strong> Sizes:</strong>
                                                @php
                                                    $sizes = explode(',', $details['item_sizes']);
                                                @endphp
                                                @foreach ($sizes as $size)
                                                    {{ trim($size) }} <br>
                                                @endforeach
                                            </p>
                                        @else
                                            {{-- for products with no color and size --}}
                                        @endif






                                    <td class="align-middle">Sh{{ $details['price'] }} </td>
                                    <td class="align-middle">

                                        <form action="{{ route('update_cart') }}" method="post">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <div class="input-group quantity mx-auto" style="width: 100px;">

                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary btn-minus">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>

                                                <input type="number" name="quantity"
                                                    value="{{ $details['quantity'] }}"
                                                    class="form-control form-control-sm bg-secondary border-0 text-center cart_update">


                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary btn-plus">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    @php
                                        $eachtotal = $details['price'] * $details['quantity'];
                                    @endphp
                                    <td class="align-middle"> Sh{{ number_format($eachtotal, 2, '.', ',') }}</td>
                                    <td class="align-middle"><button class="btn btn-sm btn-danger cart_remove "><i
                                                class="fa fa-times"></i></button></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>








            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>Sh{{ number_format($total, 2, '.', ',') }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            @php
                                $shipping = 0.05 * $total;
                            @endphp
                            <h6 class="font-weight-medium">Sh{{ number_format($shipping, 2, '.', ',') }}</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            @php
                                $calculated_total = $total + $shipping;
                            @endphp
                            <h5>Sh{{ number_format($calculated_total, 2, '.', ',') }}</h5>
                        </div>
                        <button class="btn btn-block btn-secondary font-weight-bold my-3 py-3"
                            onclick="window.location.href = '{{ route('front.shop') }}'">Continue Shopping</button>

                        <form action="{{ route('front.checkout') }}" method="POST">
                            @csrf
                            {{-- <input type="hidden" name="action" value="guest"> --}}
                            @foreach ($cart as $cartItemId => $cartItem)
                                <input type="hidden" name="cart_items[{{ $cartItemId }}][quantity]"
                                    value="{{ $cartItem['quantity'] }}">
                                    <input type="hidden" name="cart_items[{{ $cartItemId }}][supplierId]"
                                    value="{{ $cartItem['supplierId'] }}">
                                <input type="hidden" name="cart_items[{{ $cartItemId }}][product_name]"
                                    value="{{ $cartItem['product_name'] }}">
                                <input type="hidden" name="cart_items[{{ $cartItemId }}][price]"
                                    value="{{ $cartItem['price'] }}">
                                @if (!empty($cartItem['item_sizes']) && !empty($cartItem['item_colors']))
                                    <input type="hidden" name="cart_items[{{ $cartItemId }}][item_sizes]"
                                        value="{{ $cartItem['item_sizes'] }}">
                                    <input type="hidden" name="cart_items[{{ $cartItemId }}][item_colors]"
                                        value="{{ implode(',', $cartItem['item_colors']) }}">
                                @elseif (!empty($cartItem['item_colors']))
                                    <input type="hidden" name="cart_items[{{ $cartItemId }}][item_colors]"
                                        value="{{ implode(',', $cartItem['item_colors']) }}">
                                @elseif (!empty($cartItem['item_sizes']))
                                    <input type="hidden" name="cart_items[{{ $cartItemId }}][item_sizes]"
                                        value="{{ $cartItem['item_sizes'] }}">
                                @endif
                                <!-- Include a hidden input field for the image (if needed) -->
                                {{-- <input type="hidden" name="cart_items[{{ $cartItemId }}][photo]" value="{{ $cartItem['photo'] ? asset('storage/'.$cartItem['photo']) : asset('../assets/img/profile-img.jpg') }}"> --}}
                                <input type="hidden" name="cart_items[{{ $cartItemId }}][photo]"
                                    value="{{ asset('storage/' . $cartItem['photo']) }}">
                            @endforeach
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" type="submit">Proceed
                                To Checkout</button>
                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->



</x-layout_client>
