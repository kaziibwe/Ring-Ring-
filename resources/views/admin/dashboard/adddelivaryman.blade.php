<x-layout_admin>



    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">Create Acount for DeliveryMan</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    <p class="text-center small">Enter your Delivaryman details to create account</p>
                                </div>

                                <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('dashboard.deliverymanregistering') }}"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourName" class="form-label"> Fullname</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="yourName"
                                            required>
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
                                        <label for="yourEmail" class="form-label">Your Photo NID Front</label>
                                        <input type="file" name="ninfront" class="form-control" id="yourEmail">
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Your Photo NID Back</label>
                                        <input type="file" name="ninback" class="form-control" id="yourEmail">

                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Your Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}"  class="form-control" id="yourEmail"
                                            required>
                                        <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                        @error('email')
                                        <code>
                                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        </code>
                                    @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Your Phone Number</label>
                                        <input type="text" name="number" value="{{ old('number') }}" class="form-control" id="yourEmail"
                                            required>
                                        <div class="invalid-feedback">Please enter a Phone Number !</div>
                                        @error('number')
                                        <code>
                                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        </code>
                                    @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Your NIN </label>
                                        <input type="text" name="NIN" value="{{ old('NIN') }}"  class="form-control" id="yourEmail"
                                            required>
                                        <div class="invalid-feedback">Please enter a National ID Number !</div>
                                        @error('NIN')
                                        <code>
                                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        </code>
                                    @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Your Street number </label>
                                        <input type="text" name="street" value="{{ old('street') }}"  class="form-control" id="yourEmail"
                                            required>
                                        <div class="invalid-feedback">Please enter a Street Of Residence !</div>
                                        @error('street')
                                        <code>
                                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        </code>
                                    @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Division </label>
                                        <input type="text" name="division" value="{{ old('division') }}"  class="form-control" id="yourEmail"
                                            required>
                                        <div class="invalid-feedback">Please enter Division !</div>
                                        @error('division')
                                        <code>
                                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        </code>
                                    @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">City </label>
                                        <input type="text" name="city" value="{{ old('city') }}"  class="form-control" id="yourEmail"
                                            required>
                                        <div class="invalid-feedback">Please enter City !</div>
                                        @error('city')
                                        <code>
                                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        </code>
                                    @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Country </label>
                                        <input type="text" name="country" value="{{ old('country') }}"  class="form-control" id="yourEmail"
                                            required>
                                        <div class="invalid-feedback">Please enter Country !</div>
                                        @error('country')
                                        <code>
                                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        </code>
                                    @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                                            id="yourPassword" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                        @error('password')
                                        <code>
                                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        </code>
                                    @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"  class="form-control"
                                            id="yourPassword" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                        @error('password_confirmation')
                                        <code>
                                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        </code>
                                    @enderror
                                    </div>

                                    {{-- <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox"
                                                value="" id="acceptTerms" required>
                                            <label class="form-check-label" for="acceptTerms">I agree and accept the
                                                <a href="#">terms and conditions</a></label>
                                            <div class="invalid-feedback">You must agree before submitting.</div>
                                        </div>
                                    </div> --}}

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


</x-layout_admin>
