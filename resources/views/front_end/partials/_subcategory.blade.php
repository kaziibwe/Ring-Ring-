<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
            class="bg-secondary pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3">

        {{-- @foreach ($categories as $category)
            @foreach ($category->subcategories as $subcategory)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <a class="text-decoration-none"
                        href="{{ route('front.productpage', ['subcategory' => $subcategory->id]) }}">
                        <div class="cat-item d-flex align-items-center mb-4">
                            <div class="overflow-hidden" style="width: 100px; height: 100px;">
                                <img class="img-fluid"
                                    src="{{ $subcategory->image ? asset('storage/' . $subcategory->image) : asset('../assets/img/profile-img.jpg') }}"
                                    alt="categories">
                            </div>
                            <div class="flex-fill pl-3">
                                <h6> {{ $subcategory->name }}</h6>
                                <small class="text-body">{{ $subcategory->total_units }} Products</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @endforeach --}}






        <section class="product">
            <div class="backgroundcolor">
                <center>
            <div class="scrollword"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                Scroll Rigth and Left  <span><i class="fa fa-arrow-right" aria-hidden="true"></i>
            </span></div>
        </center>
        </div>
            <!-- <button class="pre-btn"><img src="images/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="images/arrow.png" alt=""></button> -->
            <div class="product-container">
                <div class="product-card">
                    <div class="product-image image-container">

                        <img src="{{ asset('assets/img/product-1.jpg') }}" class="product-thumb" alt="">
                        

                    </div>
                    <div class="product-info image-container">


                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-2.jpg') }}" class="product-thumb" alt="">
                        
                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-3.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-4.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-5.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-2.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-1.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image image-container">

                        <img src="{{ asset('assets/img/product-1.jpg') }}" class="product-thumb" alt="">
                        

                    </div>
                    <div class="product-info image-container">


                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-2.jpg') }}" class="product-thumb" alt="">
                        
                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-3.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-4.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-5.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-2.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-1.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>

            </div>





            <div class="backgroundcolor1">



            </div>





            <div class="product-container">
                <div class="product-card">
                    <div class="product-image image-container">

                        <img  src="{{ asset('assets/img/product-1.jpg') }}" class="product-thumb" alt="">
                        

                    </div>
                    <div class="product-info image-container">


                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-2.jpg') }}" class="product-thumb" alt="">
                        
                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-3.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-4.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-5.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-2.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-1.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image image-container">

                        <img src="{{ asset('assets/img/product-1.jpg') }}" class="product-thumb" alt="">
                        

                    </div>
                    <div class="product-info image-container">


                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-2.jpg') }}" class="product-thumb" alt="">
                        
                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-3.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-4.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-5.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-2.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
                <div class="product-card">
                    <div class="product-image">

                        <img src="{{ asset('assets/img/product-1.jpg') }}" class="product-thumb" alt="">

                    </div>

                </div>
            </div>



        </section>













    </div>
</div>
