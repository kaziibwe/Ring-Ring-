<x-layout_client>
    @include('front_end.partials.menu')


    <head>
        <style>
            /* body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;
} */
            .main-body {
                padding: 15px;
            }

            .card {
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            }

            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 0 solid rgba(0, 0, 0, .125);
                border-radius: .25rem;
            }

            .card-body {
                flex: 1 1 auto;
                min-height: 1px;
                padding: 1rem;
            }

            .gutters-sm {
                margin-right: -8px;
                margin-left: -8px;
            }

            .gutters-sm>.col,
            .gutters-sm>[class*=col-] {
                padding-right: 8px;
                padding-left: 8px;
            }

            .mb-3,
            .my-3 {
                margin-bottom: 1rem !important;
            }

            .bg-gray-300 {
                background-color: #e2e8f0;
            }

            .h-100 {
                height: 100% !important;
            }

            .shadow-none {
                box-shadow: none !important;
            }
        </style>
    </head>
    <div class="container">
        <div class="main-body">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <center>
                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">All
                                    Details</i></h6>
                        </center>

                        <p> <strong>Order status</strong>:{{ $order->Order_status }}</p>


                        @unless ($order->orderitems->isEmpty())
                        @foreach ($order->orderitems as $orderitem)

                                <div>
                                    <div class="col-sm-3">

                                    </div>
                                    <div class="col-sm-9 text-textially">
                                        <strong><span class="mb-0">{{ $loop->iteration }}</span></strong>
                                        <strong>Name</strong>: {{ $orderitem->product_name }} <br>
                                        <img src="{{ $orderitem->photo ? asset('storage/' . $orderitem->photo) : asset('../assets/img/profile-img.jpg') }}"
                                        alt="Profile" class="rounded-circle" width="50px">

                                
                                       <strong>Price</strong>: {{ $orderitem->price }} <br>
                                        <i>Quantity</i> : <strong>{{ $orderitem->quantity }}</strong> <br>


                                        @if ($orderitem->item_colors)
                                             <strong>Color</strong> : {{ $orderitem->item_colors }} <br>
                                        @endif

                                        @if ($orderitem->item_sizes)
                                             <strong>Size</strong> : {{ $orderitem->item_sizes }}
                                        @endif

                                        {{-- Display the Size if it has a value --}}
                                        @if ($orderitem->size && $orderitem->item_sizes)
                                            <p>Size: {{ $orderitem->item_sizes }}</p>
                                            <p>Color: {{ $orderitem->item_colors }}</p>
                                        @endif

                                        {{-- <p>Quantity: {{ $orderitem->quantity }}</p> --}}
                                        {{-- <p>Price: {{ $orderitem->price }}</p> --}}


                                        {{-- <a class="btn btn-info " target="__blank"
                                            href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">
                                            Order Details</a> --}}
                                            {{-- <p>Size: {{ $orderitem->item_sizes }}</p>
                                            <p>Color: {{ $orderitem->item_colors }}</p> --}}
                                    </div>
                                    <br>

                                </div>
                            @endforeach
                             {{-- you hove  ordered any thing yet. --}}
                        @endunless





                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout_client>
