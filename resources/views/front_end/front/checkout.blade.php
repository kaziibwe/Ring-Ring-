<x-layout_client>
    @include('front_end.partials.menu')



    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->

    @php
        $sn = 1;
    @endphp
    @php $total = 0   @endphp


    @foreach ($cartItems as $cartItemId => $cartItem)
        @php $total += $cartItem['price'] * $cartItem['quantity']   @endphp
    @endforeach

    <form action="{{ route('front.ordering') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span
                            class="bg-secondary pr-3">Billing Address</span></h5>
                    <p class="text-primary"><strong>Edit the Delivary Destination if neccessary</strong></p>
                    <div class="bg-light p-30 mb-5">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Full Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="email" name="email" value='{{ $user->email }}'>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" name="number" value='{{ $user->number }}'>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address 1 Or Street</label>
                                <input class="form-control" type="text" name="street" value='{{ $user->street }}'>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Division / Subcounty</label>
                                <input class="form-control" type="text" name="division"
                                    value='{{ $user->division }}'>
                            </div>
                            {{-- <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select">
                                <option selected>United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div> --}}
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" name="city" value='{{ $user->city }}'>
                            </div>
                            {{-- <div class="col-md-6 form-group">
                            <label>Password</label>
                            <input class="form-control" type="password"  value='{{ $user->password }}' >
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" value='{{ $user->password }}'>
                        </div> --}}


                        </div>
                    </div>
                </div>



                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span
                            class="bg-secondary pr-3">Order Total</span></h5>
                    <div class="bg-light p-30 mb-5">


                        <div class="border-bottom pt-3 pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>Sh{{ number_format($total, 2, '.', ',') }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                @php
                                    $shipping = 0.05 * $total;
                                @endphp
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">Sh{{ number_format($shipping, 2, '.', ',') }}</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                @php
                                    $calculatedTotal = $total + $shipping;
                                @endphp
                                <h5>Sh{{ number_format($calculatedTotal, 2, '.', ',') }}</h5>

                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span
                                class="bg-secondary pr-3">Payment</span></h5>
                        <div class="bg-light p-30">


                            <input type="hidden" name="calculated_total" value="{{ $calculatedTotal }}">
                            <input type="hidden" name="shipping_fee" value="{{ $shipping }}">

                            @foreach ($cartItems as $cartItemId => $cartItem)
                                <input type="hidden" name="cart_items[{{ $cartItemId }}][quantity]"
                                    value="{{ $cartItem['quantity'] }}">
                                    <input type="hidden" name="cart_items[{{ $cartItemId }}][supplierId]"
                                    value="{{ $cartItem['supplierId'] }}">
                                <input type="hidden" name="cart_items[{{ $cartItemId }}][product_name]"
                                    value="{{ $cartItem['product_name'] }}">
                                <input type="hidden" name="cart_items[{{ $cartItemId }}][price]"
                                    value="{{ $cartItem['price'] }}">

                                @if (!empty($cartItem['item_sizes']))
                                    <input type="hidden" name="cart_items[{{ $cartItemId }}][item_sizes]"
                                        value="{{ $cartItem['item_sizes'] }}">
                                @endif

                                @if (!empty($cartItem['item_colors']))
                                    @if (is_array($cartItem['item_colors']))
                                        <input type="hidden" name="cart_items[{{ $cartItemId }}][item_colors]"
                                            value="{{ implode(',', $cartItem['item_colors']) }}">
                                    @else
                                        <input type="hidden" name="cart_items[{{ $cartItemId }}][item_colors]"
                                            value="{{ $cartItem['item_colors'] }}">
                                    @endif
                                @endif

                                <!-- Include a hidden input field for the image (if needed) -->
                                {{-- <input type="hidden" name="cart_items[{{ $cartItemId }}][photo]" value="{{ $cartItem['photo'] ? asset('storage/'.$cartItem['photo']) : asset('../assets/img/profile-img.jpg') }}"> --}}
                                <input type="hidden" name="cart_items[{{ $cartItemId }}][photo]"
                                    value="{{ asset('storage/' . $cartItem['photo']) }}">
                            @endforeach

                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_mode"
                                        id="directcheck" value="mobile_payment " checked>
                                    <label class="custom-control-label" for="directcheck">Mobile Money</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_mode"
                                        id="paypal" value="pay_on_delivery">
                                    <label class="custom-control-label" for="paypal">Pay On Delivery</label>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="bank_payment"
                                        id="banktransfer" value="bank_transfer">
                                    <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                                </div>
                            </div>
                            <button class="btn btn-block btn-primary font-weight-bold py-3" type="submit">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Checkout End -->
    </form>


</x-layout_client>
