@props(['product'])
<div class="row px-xl-5">
    <div class="col-lg-5 mb-30">
        <div id="product-carousel" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner bg-light">
                @unless ($product->productgalleries->isEmpty())
                    @foreach ($product->productgalleries as $index => $productgallery)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img class="w-100 h-100"
                                src="{{ $productgallery->image ? asset('storage/' . $productgallery->image) : asset('../assets/img/profile-img.jpg') }}"
                                alt="Image">
                        </div>
                    @endforeach
                @else
                    <p>No Image In the Gallery</p>
                @endunless
            </div>


            <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                <i class="fa fa-2x fa-angle-left text-dark"></i>
            </a>
            <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                <i class="fa fa-2x fa-angle-right text-dark"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-7 h-auto mb-30">
        <div class="h-100 bg-light p-30">
            <h3>{{ $product->name }}</h3>
            <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
                </div>
                <small class="pt-1">(99 Reviews)</small>
            </div>
            <h3 class="font-weight-semi-bold mb-4">



                @php
                $dis = $product->discount / 100;
            @endphp
                @if ($product->discount > 0)
                       Discount:   <i  class="spacing_dis btn-primary">-{{ $product->discount }} % </i>
                            <p>
                        <h5>
                            Sh{{ number_format($product->price - $dis, 2) }}
                        </h5>
                        <h6 class="text-muted ml-2"><del>Sh{{ number_format($product->price, 2) }}</del>
                        </h6>
                    </p>
                @else
                    @if ($product->price)

                            <h5>
                                Sh{{ number_format($product->price, 2) }}
                            </h5>
                        @else

                                <h6>
                                    <x-pricerange :pricerangesCsv="$product->priceranges" />
                                </h6>
                    @endif

@endif
            </h3>





            {{-- <form action="">

                <p class="mb-4">{{ $product->info }}</p>

                @if ($product->colors && $product->sizes)
                    <!-- Product with both color and size entities -->
                    <x-product_size :sizesCsv="$product->sizes" />
                    <x-product_color :colorsCsv="$product->colors" />
                @elseif ($product->colors)
                    <!-- Product with color entity only -->
                    <x-product_color :colorsCsv="$product->colors" />
                @elseif ($product->sizes)
                    <!-- Product with size entity only -->
                    <x-product_size :sizesCsv="$product->sizes" />
                @endif


            </form> --}}
            <p>+ shipping from UGX 3,900 to Central Business District.</p>


            <div class="d-flex align-items-center mb-4 pt-2">
                {{-- <div class="input-group quantity mr-3" style="width: 130px;">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-minus">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control bg-secondary border-0 text-center" value="1">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-plus">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div> --}}
                {{-- <button onclick="window.location.href = '{{ route('front.add_to_cart', $product->id) }}'"
                    class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                    Cart</button> --}}
                    <a class="open-size-modal" data-bs-toggle="modal"
                    data-bs-target="#productSizeModal{{ $product->id }}"
                    href="{{ route('front.product_modal_data', $product->id) }}">
                    <button
                    class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                    Cart</button>
                </a>
            </div>
            <div class="d-flex pt-2">
                <strong class="text-dark mr-2">Share on:</strong>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
