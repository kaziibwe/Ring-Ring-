<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <script
      src="https://kit.fontawesome.com/66aa7c98b3.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="{{ asset('../css/form_style.css') }}" />
  </head>

<body>
    <div class="container">
    <form class="form-1" method="POST" action="{{ route('front.authenticate') }}">
        @csrf

        <h1>Login</h1>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required  value="{{ old('email') }}"/>
        @error('email')
        <code> <center style="color: red;">{{$message}}</center></code>
        @enderror


        <label for="password">Password</label>
        <input type="password" name="password" id="password" required  value="{{ old('password') }}" />
        @error('password')
        <code> {{$message}}</code>
        @enderror
        <span>Forgot Password</span>
        <button>Login</button>

        <!-- .........///sign-up///.......... -->

        <p>Or SignUp Using
        <a href="{{ route('front.register') }}">Register Page</a> <strong>OR</strong></p>
        <div class="icons">
          <a href="https://www.facebook.com/" target="blank"
            ><i class="fab fa-facebook-f"></i
          ></a>
          <a href="https://twitter.com/" target="blank"
            ><i class="fab fa-twitter"></i
          ></a>
          <a href="https://mail.google.com/" target="blank"
            ><i class="fab fa-google"></i
          ></a>
        </div>
      </form>
    </div>
  </body>



</html>
