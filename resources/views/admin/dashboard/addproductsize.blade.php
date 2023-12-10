<x-layout_admin>
    <div class="pagetitle">
        <h1>Products</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Goods</li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard.manageproduct') }}">Manage Product </a>
                </li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard.manageproductsize') }}">Manage Product
                        Size </a></li>
                <li class="breadcrumb-item">Add Product Size</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="col-lg-10">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">General Form Elements</h5>

                <!-- General Form Elements -->



                <form method="POST" action="{{ route('dashboard.addproductsize') }}" enctype="multipart/form-data">

                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Add Product</label>


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
                        <label for="inputText" class="col-sm-2 col-form-label">Sizes</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="XS or S or M or L or XL "
                                name="itemsizes" value="{{ old('itemsizes') }}">
                        </div>
                    </div>
                    @error('itemsizes')
                        <code>{{ $message }}</code>
                    @enderror
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="itemprice" value="{{ old('itemprice') }}">
                            @error('itemprice')
                                <code>{{ $message }}</code>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Unities</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="8" name="unities"
                                value="{{ old('unities') }}">
                            @error('unities')
                                <code>{{ $message }}</code>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Colors</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Red,yellow,blue" name="itemcolors"
                                value="{{ old('itemcolors') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"> Add Product Size</button>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>
</x-layout_admin>
