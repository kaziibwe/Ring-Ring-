<x-layout_admin>

    <div class="pagetitle">
        <h1>Subcategory</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Goods</li>
                <li class="breadcrumb-item active">Subcategory</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->


    <div class="card">
        <div class="card-body">
            <br>
            <a href="{{ route('dashboard.addsubcategory') }}">
                <button type="button" class="btn btn-primary">Add Subcategory</button>
            </a>
            <br>
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>

                        <th scope="col">Active</th>
                        <th scope="col">Featured</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = 1;
                    @endphp
                    @unless ($subcategories->isEmpty())
                        @foreach ($subcategories as $subcategory)
                            <tr>
                                <th scope="row">{{ $sn++ }}</th>
                                <td>{{ $subcategory->name }}</td>
                                <td>
                                    <img src="{{ $subcategory->image ? asset('storage/' . $subcategory->image) : asset('../assets/img/profile-img.jpg') }}"
                                        alt="Profile" class="rounded-circle" width="50px">

                                </td>

                                <td>{{ $subcategory->Active }}</td>
                                <td>{{ $subcategory->Featured }}</td>


                                <td>
                                    <a href="{{ route('dashboard.editsubcategory', ['subcategory' => $subcategory->id]) }}">
                                        <button type="button" class="btn btn-success">Edit</button>
                                    </a>
                                </td>
                                <td>
                                    <form method="post"
                                        action="{{ route('dashboard.deletesubcategory', ['subcategory' => $subcategory->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                        @endforeach
                    @else
                        <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                            No Subcateory available!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endunless
                    <!-- End Table with hoverable rows -->

                    </tr>

                </tbody>
            </table>
            <!-- End Table with hoverable rows -->

        </div>
    </div>
</x-layout_admin>
