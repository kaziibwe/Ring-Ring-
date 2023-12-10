<x-layout_admin>

    <div class="pagetitle">
        <h1> Adverts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Adverts</li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard.managecategory') }}">Manage Adverts</a>
                </li>
                <li class="breadcrumb-item">Add Advert </li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> Form Elements</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('dashboard.updateadvert', ['advert' => $advert->id]) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf


                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ $advert->name }}">
                        </div>
                        @error('name')
                            <code>{{ $message }}</code>
                        @enderror
                    </div>


                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <div class="col-md-8 col-lg-9">
                                <img src="{{ $advert->image ? asset('storage/' . $advert->image) : asset('../assets/img/profile-img.jpg') }}"
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
                                value="{{ $advert->image }}">


                            @error('image')
                                <code>{{ $message }}</code>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label"> Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" name="description">
                    {{ $advert->description }}
                </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"> Add Advert</button>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>

</x-layout_admin>
