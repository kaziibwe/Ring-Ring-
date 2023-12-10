<x-layout_admin>
    <div class="pagetitle">
        <h1>Main Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Goods</li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard.managecategory') }}">MainCategory</a></li>
                <li class="breadcrumb-item">Edit Category </li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">General Form Elements</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('dashboard.updatecategory', ['category' => $category->id]) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                            @error('name')
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
                                    value="no">
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
                                    value="no">
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
                            <button type="submit" class="btn btn-primary"> Add Category</button>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>

</x-layout_admin>
