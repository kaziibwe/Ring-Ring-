<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent
            Products</span></h2>

            <a href="{{ route('front.cart') }}" class="btn btn-primary px-0 ml-3">
                <i class="fas fa-shopping-cart "></i>
                <span class="badge text-secondary   border border-secondary rounded-circle"
                    style="padding-bottom: 2px;">{{ count((array) session('cart')) }}</span> <span> Got to cart</span>
            </a>
<br><br>
    <div class="row px-xl-5">
        @foreach ($recentProducts as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <a href="{{ route('front.productdetail', ['product' => $product->id]) }}">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100"
                                src="{{ $product->image ? asset('storage/' . $product->image) : asset('../assets/img/profile-img.jpg') }}"
                                alt="">

                            {{-- <div class="product-action">

                                <a class="btn btn-outline-dark btn-square open-size-modal" data-bs-toggle="modal"
                                    data-bs-target="#productSizeModal{{ $product->id }}"
                                    href="{{ route('front.product_modal_data', $product->id) }}">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square"
                                    href="{{ route('front.productdetail', ['product' => $product->id]) }}"><i
                                        class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="fa fa-search"></i></a>
                            </div> --}}
                        </div>
                        @php
                            $dis = $product->discount / 100;
                        @endphp
                        <div class="text-center py-4">
                            @if ($product->discount > 0)
                                <a class="h6 text-decoration-none text-truncate"
                                    href="{{ route('front.productdetail', ['product' => $product->id]) }}">{{ $product->name }}
                                </a>
                                <i class="spacing_dis btn-primary">-{{ $product->discount }} % </i>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>
                                        Sh{{ number_format($product->price - $dis, 2) }}
                                    </h5>
                                    <h6 class="text-muted ml-2"><del>Sh{{ number_format($product->price, 2) }}</del>
                                    </h6>
                                </div>
                            @else
                                @if ($product->price)
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="{{ route('front.productdetail', ['product' => $product->id]) }}">{{ $product->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>
                                            Sh{{ number_format($product->price, 2) }}
                                        </h5>
                                    @else
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="{{ route('front.productdetail', ['product' => $product->id]) }}">{{ $product->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h6>
                                                <x-pricerange :pricerangesCsv="$product->priceranges" />
                                            </h6>
                                @endif
                        </div>
        @endif
        <div class="d-flex align-items-center justify-content-center mb-1">
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small>(99)</small> <br>

        </div>
        {{ $product->numberunit }} units Remaining
        {{-- <a  href="" class=" btn btn-primary">Add to Cart</a> --}}
        {{-- <a href="" class="btn btn-primary">Shop Now</a> --}}



        <a class="open-size-modal" data-bs-toggle="modal" data-bs-target="#productSizeModal{{ $product->id }}"
            href="{{ route('front.product_modal_data', $product->id) }}">
            <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                Cart</button>
        </a>


    </div>
    <a href="{{ route('front.productdetail', ['product' => $product->id]) }}"
        class="text-primary padding-detail">details</a>

</div>

</a>


</div>
@endforeach
</div>
</div>

{{-- include the model to get the choice of goods in the short curt --}}

@include('front_end.partials._cartchoice')
