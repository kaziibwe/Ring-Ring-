<x-layout_s_admin>



    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">Create Acount for S_Admin</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    <p class="text-center small">Enter your Delivaryman details to create account</p>
                                </div>
                                <form action="{{ route('dashboard.storesuperadmin') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-12">
                                        <label for="yourName" class="form-label"> Fullname</label>
                                        <input type="text" name="name" class="form-control" id="yourName"
                                            required value="{{ old('name') }}">
                                        <div class="invalid-feedback">Please, enter your name!</div>
                                        @error('name')
                                            <code>
                                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                            </code>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Your Image</label>
                                        <input type="file" name="image" class="form-control" id="yourEmail">
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Your Role</label>
                                        <input type="text" name="role" class="form-control" id="yourEmail">
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Your Email</label>
                                        <input type="email" name="email" class="form-control" id="yourEmail"
                                            required value="{{ old('email') }}">
                                        <div class="invalid-feedback">Please enter a valid Email address!</div>
                                        @error('email')
                                            <code>
                                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                            </code>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword"
                                            required value="{{ old('password') }}">
                                        <div class="invalid-feedback">Please enter your password!</div>
                                        @error('password')
                                            <code>
                                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                            </code>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="yourPassword" required value="{{ old('password_confirmation') }}">
                                        <div class="invalid-feedback">Please enter your password!</div>
                                        @error('password_confirmation')
                                            <code>
                                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                            </code>
                                        @enderror
                                    </div>

                                    <br>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Already have an account? <a href="pages-login.html">Log
                                                in</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

</x-layout_s_admin>
