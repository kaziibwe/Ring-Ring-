<x-layout_admin>
    <div class="pagetitle">
        <h1>Products</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Goods</li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard.manageproductgarallery') }}">Manage
                        Product Gallery</a></li>
                <li class="breadcrumb-item">Add Product Gallery</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="col-lg-10">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">General Form Elements</h5>

                <!-- General Form Elements -->




                <form method="POST"
                    action="{{ route('dashboard.updateproductgallery', ['productgallery' => $productgallery->id]) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Product</label>


                        <div class="col-sm-10">
                            <select name="product_id" class="form-select" aria-label="Default select example">
                                <option selected>Select the Products</option>
                                @unless ($products->isEmpty())
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                @else
                                    <option value=""> No Products Found</option>

                                @endunless
                            </select>
                            @error('product')
                                <code>{{ $message }}</code>
                            @enderror

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <div class="col-md-8 col-lg-9">
                                <img src="{{ $productgallery->image ? asset('storage/' . $productgallery->image) : asset('../assets/img/profile-img.jpg') }}"
                                    alt="Profile" width="200px">
                            </div>
                            @error('image')
                                <code>{{ $message }}</code>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">New Image</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"> Add Product Gallery</button>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>

</x-layout_admin>
