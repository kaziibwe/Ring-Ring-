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
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
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

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}

.shadow-none {
    box-shadow: none!important;
}

    </style>
</head>
    <div class="container">
        <div class="main-body">

              <!-- Breadcrumb -->
              <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                  <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                  <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
              </nav>
              <!-- /Breadcrumb -->

              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                <img src="{{ asset('../assets/img/avatar.jpg') }}" alt="Customer" class="rounded-circle" width="150">
                        <div class="mt-3">
                          <h4>John Doe</h4>
                          <p class="text-textially mb-1">Full Stack Developer</p>
                          <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                          {{-- <button class="btn btn-primary">Follow</button>
                          <button class="btn btn-outline-primary">Message</button> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">

                        <div class="card-body">

                          <div class="row">
                            <center><a href="{{ route('custemer.orders') }}"><h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">ORDERS</i></h6></a></center>

                         <p>  <a class="btn btn-info " target="__blank" href="{{ route('custemer.orders') }}">View Order</a>
                              <a class="btn btn-info " target="__blank" href="{{ route('custemer.orders') }}">View Comments</a></p>

                            {{-- @unless ( $customerOrders->isEmpty())
                            @foreach ($customerOrders as $orders)

                            <div class="col-sm-3">
                              <h6 class="mb-0">1</h6>
                            </div>
                            <div class="col-sm-9 text-textially">
                                <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">View Order</a>
                              </div>


                              @endforeach

                              @endunless --}}
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">2</h6>
                            </div>
                            <div class="col-sm-9 text-textially">
                              Ring-@jukmuh.alfjle
                              <a class="btn btn-info " target="__blank" href="{{ route('custemer.orders') }}">View Order</a>

                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">3</h6>
                            </div>
                            <div class="col-sm-9 text-textially">
                                Ring-@jukmuh.alfjle
                                <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">View Order</a>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                <h6 class="mb-0">4</h6>
                              </div>
                              <div class="col-sm-9 text-textially">
                                 Ring-@jukmuh.alfjle
                                <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">View Order</a>

                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-3">
                                <h6 class="mb-0">5

                                </h6>
                              </div>
                              <div class="col-sm-9 text-textially">
                                Ring-@jukmuh.alfjle <i class="fa-solid fa-eye"></i>
                                <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">View Order</a>

                              </div>
                            </div>
                            <hr>

                          </div>
                        </div>
                </div>
                    @auth('customer')

                <div class="col-md-8">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">

                          <div class="col-sm-3">
                            <h6 class="mb-0">Full Name</h6>
                          </div>
                          <div class="col-sm-9 text-textially">
                            {{ auth('customer')->user()->name }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                          </div>
                          <div class="col-sm-9 text-textially">
                            {{ auth('customer')->user()->email }}                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Phone</h6>
                          </div>
                          <div class="col-sm-9 text-textially">
                            {{ auth('customer')->user()->number }}                          </div>
                        </div>
                        <hr>


                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-textially">
                            {{ auth('customer')->user()->street }},{{ auth('customer')->user()->division }},{{ auth('customer')->user()->city }}
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-12">
                              <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endauth





                      <div class="card mb-3">
                        <div class="card-body">
                          <div class="row">
                            <center><h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">COMMENTS</i></h6></center>

                            <div class="col-sm-3">
                              <h6 class="mb-0">1</h6>
                            </div>
                            <div class="col-sm-9 text-textially">
                              Ring-@jukmuh.alfjle
                              <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">View Comments</a>

                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-textially">
                                Ring-@jukmuh.alfjle
                                <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">View Comments</a>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-textially">
                              (239) 816-9029
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                <h6 class="mb-0">Mobile</h6>
                              </div>
                              <div class="col-sm-9 text-textially">
                                (320) 380-4539
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-3">
                                <h6 class="mb-0">Addres</h6>
                              </div>
                              <div class="col-sm-9 text-textially">
                                Bay Area, San Francisco, CA
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-12">
                                <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                              </div>
                            </div>
                          </div>
                        </div>





            </div>
        </div>

      </div>
  </div>

</x-layout_client>
