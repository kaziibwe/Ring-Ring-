<x-layout_admin>

    <div class="pagetitle">
        <h1>Side Adverts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Adverts</li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard.managecategory') }}">Manage Side
                        Adverts</a></li>
                <li class="breadcrumb-item">Add Side Advert </li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add the Side Adverts below</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('dashboard.addsideadvert') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
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

                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label"> Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="6" name="description" placeholder="Enter the Description">
                    {{ old('description') }}
                </textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"> Add Side Advert</button>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>
</x-layout_admin>
