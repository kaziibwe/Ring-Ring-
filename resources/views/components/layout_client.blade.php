<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ring Ring | Eccommerce | e-shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('../lib/animate/animate.min.css" rel="stylesheet') }}">
    <link href="{{ asset('../lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('../css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('../css/flip.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


    {{-- js for search function  starts here --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    {{-- js for search function  ends here --}}

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    {{-- for cart --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


    <script src="//unpkg.com/alpinejs" defer></script>
    <script type="text/javascript"></script>




    <script>
var availableTags = [];
$.ajax({
    method: "GET",
    url: '{{ route('front.productsearch') }}',
    success: function(response) {
        availableTags = response; // Assign the response data to availableTags
        startAutocomplete(availableTags); // Call the function with the populated data
    }
});

function startAutocomplete(availableTags) {
    $("#search_product").autocomplete({
        source: availableTags
    });
}


    </script>




    {{-- font owasame icons --}}
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    {{-- <style type="text/css"> --}}
    <style>
        .flex_wrap {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .paddingpop {
            padding-left: 5%
        }

        .nav-link {
            display: block;
            padding: 0.5rem 1rem;
        }

        .navbar-nav .dropdown-menu {
            position: static;
            float: none;
        }


        @media (min-width:992px) {
            .smallscreen {
                display: none;
            }
        }

        .spacing_helo {
            margin-right: 10%;
        }

        .spacing_dis {
            margin-left: 20%;

        }

        .padding-detail {
            padding-left: 70%;
            margin-bottom: 0;
        }
    </style>

    </head>

    <body>
        <!-- Topbar Start -->
        <div>
            <marquee class="text-primary"> <span class="paddingpop">Shop with RING RING. </span> <span
                    class="paddingpop">Contact us for more information or if the is a problem Call at +346 567
                    5678</span> <span class="paddingpop">Welcome to Ring Ring the <strong>HOME</strong> or products and
                    Servies </span> <span class="paddingpop">Check on <strong>Tourism</strong> </span> </marquee>

        </div>
        <center><x-flash_message /></center>



        </div>


        <div class="container-fluid">

            <div class="row bg-secondary py-1 px-xl-5">
                <div class="col-lg-6 d-none d-lg-block">

                    <div class="d-inline-flex align-items-center h-100">
                        <a class="text-body mr-3" href="">About</a>
                        <a class="text-body mr-3" href="">Contact</a>
                        <a class="text-body mr-3" href="">Help</a>
                        <a class="text-body mr-3" href="">FAQs</a>
                    </div>

                </div>

                <div class="col-lg-6 text-center text-lg-right">

                    @auth('customer')
                        <span class="spacing_helo"> Welcome <strong>{{ auth('customer')->user()->name }} </strong></span>
                        <button type="submit" onclick="window.location.href = '{{ route('front.customerprofile') }}'"
                            class="btn btn-primary">Profile</button>

                        <div class="d-inline-flex align-items-center">
                            <form action="{{ route('front.logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Logout</button>
                            </form>
                        @else
                            <div class="flex_wrap">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">My Account</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item"
                                            onclick="window.location.href='{{ route('front.login') }}'" type="button">Sign
                                            in</button>
                                        <button class="dropdown-item"
                                            onclick="window.location.href='{{ route('front.register') }}'"
                                            type="button">Sign
                                            up</button>


                                    </div>
                                </div>
                            @endauth






                            {{ $slot }}


                            <!-- Footer Start -->
                            <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
                                <div class="row px-xl-5 pt-5">
                                    <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                                        <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                                        <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd
                                            clita et
                                            et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
                                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123
                                            Street,
                                            New York, USA</p>
                                        <p class="mb-2"><i
                                                class="fa fa-envelope text-primary mr-3"></i>info@example.com
                                        </p>
                                        <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345
                                            67890
                                        </p>
                                    </div>
                                    <div class="col-lg-8 col-md-12">
                                        <div class="row">
                                            <div class="col-md-4 mb-5">
                                                <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                                                <div class="d-flex flex-column justify-content-start">
                                                    <a class="text-secondary mb-2" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Home</a>
                                                    <a class="text-secondary mb-2" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Our Shop</a>
                                                    <a class="text-secondary mb-2" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                                                    <a class="text-secondary mb-2" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                                                    <a class="text-secondary mb-2" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Checkout</a>
                                                    <a class="text-secondary" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Contact Us</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-5">
                                                <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                                                <div class="d-flex flex-column justify-content-start">
                                                    <a class="text-secondary mb-2" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Home</a>
                                                    <a class="text-secondary mb-2" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Our Shop</a>
                                                    <a class="text-secondary mb-2" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                                                    <a class="text-secondary mb-2" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                                                    <a class="text-secondary mb-2" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Checkout</a>
                                                    <a class="text-secondary" href="#"><i
                                                            class="fa fa-angle-right mr-2"></i>Contact Us</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-5">
                                                <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                                                <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                                                <form action="">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                            placeholder="Your Email Address">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary">Sign Up</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                                                <div class="d-flex">
                                                    <a class="btn btn-primary btn-square mr-2" href="#"><i
                                                            class="fab fa-twitter"></i></a>
                                                    <a class="btn btn-primary btn-square mr-2" href="#"><i
                                                            class="fab fa-facebook-f"></i></a>
                                                    <a class="btn btn-primary btn-square mr-2" href="#"><i
                                                            class="fab fa-linkedin-in"></i></a>
                                                    <a class="btn btn-primary btn-square" href="#"><i
                                                            class="fab fa-instagram"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border-top mx-xl-5 py-4"
                                    style="border-color: rgba(256, 256, 256, .1) !important;">
                                    <div class="col-md-6 px-xl-0">
                                        <p class="mb-md-0 text-center text-md-left text-secondary">
                                            &copy; <a class="text-primary" href="#">Domain</a>. All Rights
                                            Reserved.
                                            Designed
                                            by
                                            <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                                        </p>
                                    </div>
                                    <div class="col-md-6 px-xl-0 text-center text-md-right">
                                        <img class="img-fluid" src="img/payments.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <!-- Footer End -->


                            <!-- Back to Top -->
                            <a href="#" class="btn btn-primary back-to-top"><i
                                    class="fa fa-angle-double-up"></i></a>


                            <!-- JavaScript Libraries -->

                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
                                integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
                            </script>
                            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
                            <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
                            <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>


                            <!-- Template Javascript -->
                            <script src="{{ asset('js/flip.js') }}"></script>

                            {{-- <script src="{{ asset('js/main.js') }}"></script> --}}
                            <script src="{{ asset('js/main.js') }}"></script>

                            <script type="text/javascript">
                                $(".cart_remove").click(function(e) {
                                    e.preventDefault();

                                    var ele = $(this);

                                    if (confirm("Do you really want to remove?")) {
                                        $.ajax({
                                            url: '{{ route('remove_from_cart') }}',
                                            method: "DELETE",
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                id: ele.parents("tr").attr("data-id")
                                            },
                                            success: function(response) {
                                                window.location.reload();
                                            }
                                        });
                                    }
                                });


                                $(document).ready(function() {
                                    $(".cart_update").change(function() {
                                        var form = $(this).closest("form");
                                        form.submit(); // Submit the form to update the cart
                                    });
                                });



                                // $('.modal').on('show.bs.modal', function (event) {
                                //             var button = $(event.relatedTarget); // Button that triggered the modal
                                //             var modal = $(this); // Modal that is being shown
                                //             var url = button.attr('href'); // URL from the link's href attribute

                                //             // Load content using AJAX and update modal body
                                //             $.ajax({
                                //                 url: url,
                                //                 method: 'GET',
                                //                 success: function (data) {
                                //                     modal.find('.modal-body').html(data); // Update modal content
                                //                 }
                                //             });
                                //         });
                            </script>
    </body>

    </html>
