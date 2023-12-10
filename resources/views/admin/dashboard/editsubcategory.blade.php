<x-layout_admin>
    <div class="pagetitle">
        <h1>SubCategory</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Goods</li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard.managesubcategory') }}">Subcategory</a>
                </li>
                <li class="breadcrumb-item">Edit Subcategory </li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">General Form Elements</h5>

                <!-- General Form Elements -->
                <form method="POST"
                    action="{{ route('dashboard.updatesubcategory', ['subcategory' => $subcategory->id]) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf



                    <div class="row mb-3">

                        Category
                        <div class="col-sm-10">
                            <select name="category_id" class="form-select" aria-label="Default select example">
                                <option selected>Select the Category</option>
                                @unless ($categories->isEmpty())
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @else
                                    <option value=""> No Categories Found</option>

                                @endunless
                            </select>
                            @error('category')
                                <code>{{ $message }}</code>
                            @enderror

                        </div>
                    </div>



                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ $subcategory->name }}" class="form-control">
                            @error('name')
                                <code>{{ $message }}</code>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <div class="col-md-8 col-lg-9">
                                <img src="{{ $subcategory->image ? asset('storage/' . $subcategory->image) : asset('../assets/img/profile-img.jpg') }}"
                                    alt="Profile" width="200px">
                            </div>
                            @error('name')
                                <code>{{ $message }}</code>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="formFile" name="image"
                                value="{{ old('image') }}">
                            @error('image')
                                <code>{{ $message }}</code>
                            @enderror
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
                                @error('Active')
                                    <code>{{ $message }}</code>
                                @enderror
                            </div>

                    </fieldset>
                    <fieldset class="row mb-3">
                        Featured
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Featured" id="gridRadios1"
                                    value="yes">
                                <label class="form-check-label" for="gridRadios1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Featured" id="gridRadios2"
                                    value="no" checked>
                                <label class="form-check-label" for="gridRadios2">
                                    No
                                </label>
                                @error('Featured')
                                    <code>{{ $message }}</code>
                                @enderror
                            </div>

                    </fieldset>

                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"> Add Subcategory</button>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>

</x-layout_admin>
