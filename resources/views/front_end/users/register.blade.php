<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Form</title>
    <script
      src="https://kit.fontawesome.com/66aa7c98b3.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="{{ asset('../css/style.css') }}" />

  </head>
  <body>




        <!-- Checkout Start -->
        <div class="container-fluid">
            <br><br><br>
            <div class="row px-xl-5">
                <div class="col-lg-8 ">
                   <center> <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Register  Below</span></h5></center>
                    <div class="bg-light p-30 mb-5">
                        <form action="{{ route('front.registering') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Full Name</label>
                                <input class="form-control" type="text" name="name"  value="{{old('name')}}">
                                @error('name')
                               <code> <p class="text-danger text-xs mt-1">{{$message}}</p></code>
                                 @enderror
                            </div>

                            <div class="col-md-6 form-group ">
                                <label>E-mail</label>
                                <input class="form-control" type="text" name="email" value="{{old('email')}}">
                                @error('email')
                                <code> <p class="text-danger text-xs mt-1">{{$message}}</p></code>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" name="number" type="text" value="{{old('number')}}">
                                @error('number')
                                <code> <p class="text-danger text-xs mt-1">{{$message}}</p></code>
                                 @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address 1 Street </label>
                                <input class="form-control"  name="street" type="text" value="{{old('street')}}">
                                @error('street')
                                <code> <p class="text-danger text-xs mt-1">{{$message}}</p></code>
                                 @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Division / Subcounty </label>
                                <input class="form-control" type="text" name="division" value="{{old('division')}}">
                                @error('division')
                                <code> <p class="text-danger text-xs mt-1">{{$message}}</p></code>
                                 @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" name="city" value="{{old('city')}}">
                                @error('city')
                                <code> <p class="text-danger text-xs mt-1">{{$message}}</p></code>
                                 @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" type="password" value="{{old('password')}}">
                                @error('password')
                                <code> <p class="text-danger text-xs mt-1">{{$message}}</p></code>
                                 @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation" value="{{old('password_confirmation')}}">
                                @error('password_confirmation')
                                <code> <p class="text-danger text-xs mt-1">{{$message}}</p></code>
                                 @enderror
                            </div>

                            <button type="submit"  class="btn btn-block btn-primary font-weight-bold py-3">Register</button>
                            <div >
                                <br>
                                <div>

                                    <label >Already have an account?
                                        <a href="{{ route('front.login') }}">Login</a>   </label>
                                </div>
                            </div>



                        </div>

                    </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- Checkout End -->

  </body>
</html>
