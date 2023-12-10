<x-layout_admin>
    <div class="pagetitle">
        <h1>Products</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Goods</li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard.manageproduct') }}">Manage Products</a>
                </li>
                <li class="breadcrumb-item">Edit Product </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="col-lg-10">


        <div class="card">
            <div class="card-body">
                <h5 class="card-title">General Form Elements</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('dashboard.updateproduct', ['product' => $product->id]) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Category</label>


                        <div class="col-sm-10">
                            <select name="subcategory_id" class="form-select" aria-label="Default select example">
                                <option selected>Select the Category</option>
                                @unless ($subcategories->isEmpty())
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                @else
                                    <option value=""> No Subcategories Found</option>

                                @endunless
                            </select>
                            @error('subcategory')
                                <code>{{ $message }}</code>
                            @enderror

                        </div>



                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                        <select name="supplier_id" class="form-select" aria-label="Default select example">
                            <option selected>Select the supplier</option>
                            @unless ($suppliers->isEmpty())
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            @else
                                <option value=""> No suppliers Found</option>

                            @endunless
                        </select>
                        @error('supplier')
                            <code>{{ $message }}</code>
                        @enderror

                    </div>
                </div>


                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                        </div>
                        @error('name')
                            <code>{{ $message }}</code>
                        @enderror
                    </div>


                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <div class="col-md-8 col-lg-9">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('../assets/img/profile-img.jpg') }}"
                                    alt="Profile" width="200px">
                            </div>
                            @error('name')
                                <code>{{ $message }}</code>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">New Image</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="formFile" name="image"
                                value="{{ $product->image }}">
                            @error('image')
                                <code>{{ $message }}</code>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="price" value="{{ $product->price }}">
                            @error('price')
                                <code>{{ $message }}</code>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Discount in %</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="discount"
                                value="{{ $product->discount }}">
                            @error('discount')
                                <code>{{ $message }}</code>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Color</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Red,yellow,blue" name="colors"
                                value="{{ $product->colors }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Price Ranges</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="12000-18000" name="priceranges"
                                value="{{ $product->priceranges }}">
                        </div>
                    </div>

                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Active</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Active" id="gridRadios1"
                                    value="yes">
                                <label class="form-check-label" for="gridRadios1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Active" id="gridRadios2"
                                    value="no" checked>
                                <label class="form-check-label" for="gridRadios2">
                                    No
                                </label>
                            </div>

                    </fieldset>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Featured</legend>


                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="featured" id="gridRadios1"
                                    value="yes">
                                <label class="form-check-label" for="gridRadios1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="featured" id="gridRadios2"
                                    value="no" checked>
                                <label class="form-check-label" for="gridRadios2">
                                    No
                                </label>
                            </div>

                    </fieldset>


                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Numbers of units</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="2" name="numberunit"
                                value="{{ $product->numberunit }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Specifications</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="info" rows="2">
                    {{ $product->info }}

                </textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label"> Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="6" name="description">
                    {{ $product->description }}

                </textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label"> Information</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="6" name="information">
                    {{ $product->information }}

                </textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label"> Key Features</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="6" name="outlines">
                    {{ $product->outlines }}

                </textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label"> What's in the Box</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="6" name="outline_tags">
                    {{ $product->outline_tags }}

                </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"> Edit Product</button>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>
</x-layout_admin>
