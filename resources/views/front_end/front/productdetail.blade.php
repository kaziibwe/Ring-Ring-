<x-layout_client>
    @include('front_end.partials.menu')


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">



        <x-product_detail :product="$product" />





        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>{{ $product->description }}.</p>
                        </div>
                        <div class="tab-pane fade  " id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>{{ $product->information }}.</p>
                            <div class="row">

                                <x-outline1 :outlinesCsv="$product->outlines" />
                                <x-outline2 :outline_tagsCsv="$product->outline_tags" />

                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">1 review for "Product Name"</h4>
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1"
                                            style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam
                                                ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod
                                                ipsum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked
                                        *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review"
                                                class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May
                Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">

                    @foreach ($recentProducts as $product)
                        <div class="product-item bg-light">
                            <a href="{{ route('front.productdetail', ['product' => $product->id]) }}">

                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100"
                                    src="{{ $product->image ? asset('storage/' . $product->image) : asset('../assets/img/profile-img.jpg') }}"
                                    alt="">
                                {{-- <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('front.add_to_cart', $product->id) }}"><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('front.productdetail', ['product' => $product->id]) }}"><i
                                            class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-search"></i></a>
                                </div> --}}
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $product->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>sh

                                        @if (isset($product->price))
                                            <?php
                                            $formattedPrice = number_format($product->price, 0, '', ',');

                                            echo $formattedPrice;
                                            ?>
                                        @endif
                                    </h5>
                                    {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                                <a class="open-size-modal" data-bs-toggle="modal"
                                data-bs-target="#productSizeModal{{ $product->id }}"
                                href="{{ route('front.product_modal_data', $product->id) }}">
                                <button
                                class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                                Cart</button>
                            </a>
                            </div>



                  <a  href="{{ route('front.productdetail', ['product' => $product->id]) }}" class="text-primary padding-detail">details</a>
                            </a>
                        </div>


                    @endforeach




                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


    {{-- footer starts from here --}}
</x-layout_client>



{{-- include the model to get the choice of goods in the short curt --}}

@include('front_end.partials._cartchoice')
