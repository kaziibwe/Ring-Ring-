  <x-layout_client>
      @include('front_end.partials.menu')


      <!-- Carousel Start -->
      <div class="container-fluid mb-3">
          <div class="row px-xl-5">
              <div class="col-lg-8">

                  {{--  the home advert starts here --}}
                  @include('front_end.partials._homeAdvert')

                  {{--  the home advert ends here --}}

              </div>

              <div class="col-lg-4">
                  {{-- @foreach ($topSideAdverts as $sideAdvert)
                      <div class="product-offer mb-30" style="height: 200px;">
                          <img class="img-fluid"
                              src="{{ $sideAdvert->image ? asset('storage/' . $sideAdvert->image) : asset('../assets/img/profile-img.jpg') }}"
                              alt="">
                          <div class="offer-text">
                              <h6 class="text-white text-uppercase">{{ $sideAdvert->description }}</h6>
                              <h3 class="text-white mb-3">{{ $sideAdvert->name }}</h3>
                              <a href="" class="btn btn-primary">Shop Now</a>
                          </div>
                      </div>
                  @endforeach --}}



 <center>
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="{{ asset('assets/img/news-1.jpg') }}" width="90%">
  {{-- <div class="text">Caption Text</div> --}}
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="{{ asset('assets/img/news-2.jpg') }}" width="90%">
  {{-- <div class="text">Caption Two</div> --}}
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="{{ asset('assets/img/news-3.jpg') }}" width="90%">
  {{-- <div class="text">Caption Three</div> --}}
</div>

</div>


<br>

<div style="text-align:center">
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
</div>
</center>

<center>
    <div class="about-us">
 <p> HOW TO US THE SITE </p>
 <p> Steps to use the website</p>
 <p> TOURISM CHECKOUT</p>
 <p> Explore Tourism in Africa</p>
 <p> TOURISM CHECKOUT</p>
 <p> Explore Tourism in Africa</p>

    </div>
</center>

              </div>
          </div>





          <!-- Featured Start -->
          <div class="container-fluid pt-5">

            <div class="disappear-above-category">
              <div class="row px-xl-5 pb-3">
                  <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                      <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                          <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                          <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                      <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                          <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                          <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                      <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                          <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                          <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                      <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                          <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                          <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                      </div>
                  </div>
              </div>
          </div>
        </div>
          <!-- Featured End -->


          <!-- Categories Start -->
          @include('front_end.partials._subcategory')
          <!-- Categories End -->


          <!-- Featured Products Start -->
          @include('front_end.partials.featured_product')

          <!-- Featured Products End -->


          <!-- Offer Start -->
          <div class="container-fluid pt-5 pb-3">
              <div class="row px-xl-5">
                  @foreach ($middleSideAdverts as $sideAdvert)
                      <div class="col-md-6">

                          <div class="product-offer mb-30" style="height: 300px;">
                              <img class="img-fluid"
                                  src="{{ $sideAdvert->image ? asset('storage/' . $sideAdvert->image) : asset('../assets/img/profile-img.jpg') }}"
                                  alt="">
                              <div class="offer-text">
                                  <h6 class="text-white text-uppercase">{{ $sideAdvert->description }}</h6>
                                  <h3 class="text-white mb-3">{{ $sideAdvert->name }}</h3>
                                  <a href=""style="color:#3b3e41 ;" class="btn hover-btn btn-primary" >Shop Now</a>
                              </div>
                          </div>

                      </div>
                  @endforeach


              </div>
          </div>
          <!-- Offer End -->


          <!-- Products Start -->
          @include('front_end.partials._recent_product')
          <!-- Products End -->


          <!-- Vendor Start -->
          <div class="container-fluid py-5">
              <div class="row px-xl-5">
                  <div class="col">
                      <div class="owl-carousel vendor-carousel">
                          <div class="bg-light p-4">
                              <img src="{{ asset('img/vendor-1.jpg') }}" alt="">
                          </div>
                          <div class="bg-light p-4">
                              <img src="{{ asset('img/vendor-2.jpg') }}" alt="">
                          </div>
                          <div class="bg-light p-4">
                              <img src="{{ asset('img/vendor-3.jpg') }}" alt="">
                          </div>
                          <div class="bg-light p-4">
                              <img src="{{ asset('img/vendor-4.jpg') }}" alt="">
                          </div>
                          <div class="bg-light p-4">
                              <img src="{{ asset('img/vendor-5.jpg') }}" alt="">
                          </div>
                          <div class="bg-light p-4">
                              <img src="{{ asset('img/vendor-6.jpg') }}" alt="">
                          </div>
                          <div class="bg-light p-4">
                              <img src="{{ asset('img/vendor-7.jpg') }}" alt="">
                          </div>
                          <div class="bg-light p-4">
                              <img src="{{ asset('img/vendor-8.jpg') }}" alt="">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Vendor End -->
  </x-layout_client>
