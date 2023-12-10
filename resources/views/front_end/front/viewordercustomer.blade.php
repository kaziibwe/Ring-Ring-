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
                            <h6 class="d-flex align-items-center mb-3"><i
                                    class="material-icons text-info mr-2">All Orders</i></h6>
                        </center>

                        @unless ($customerOrders->isEmpty())
                            @foreach ($customerOrders as $order)
                            <div>
                                <div class="col-sm-3">

                                </div>
                                <div class="col-sm-9 text-textially">
                                   <strong><span class="mb-0">{{ $loop->iteration }}</span></strong>
                                    {{ $order->tracking_no }}
                                    {{ $order->orderdate }}
                                    <a class="btn btn-info" target="__blank"
                                    {{-- href="{{ route('custemer.ordersdetails', ['order' => $order->id]) }}"> --}}
                                    href = '{{ route('customer.ordersdetails', ['order' => $order->id]) }}'>
                                    Order Details
                                 </a>


                                </div>
                                <br>

                        </div>
                        @endforeach

                    @endunless
               </div>
            </div>
        </div>
    </div>
    </div>
</x-layout_client>
