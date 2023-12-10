<x-layout_admin>
    <div class="pagetitle">
        <h1>Main Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Goods</li>
                <li class="breadcrumb-item active">MainCategory</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body"> <br>
            <a href="{{ route('dashboard.addcategory') }}">
                <button type="button" class="btn btn-primary">Add Category</button>
            </a>
            {{-- <h5 class="card-title">Manage Main Category</h5> --}}

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">SN</th>
                        <th scope="col">Name</th>
                        <th scope="col">Active</th>
                        <th scope="col">Featured</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = 1;
                    @endphp

                    @unless ($categories->isEmpty())
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $sn++ }}</th>
                                <td> {{ $category->name }}</td>
                                <td>{{ $category->Active }}</td>
                                <td>{{ $category->Featured }}</td>
                                <td>

                                    {{--
                <a href="{{ route('dashboard.editcategory', ['id' => $category->id]) }}">
                    <button type="button" class="btn btn-success">Edit</button>
                </a> --}}

                                    <a href="{{ route('dashboard.editcategory', ['category' => $category->id]) }}">
                                        <button type="button" class="btn btn-success">Edit</button>
                                    </a>



                                </td>
                                <td>

                                    {{-- <form  method="post" action="{{ route('dashboard.deletecategory', ['category' => $category->id]) }}">
                        @method('DELETE')
                        @csrf
                    <button type="button" class="btn btn-danger">Delete</button>
                    </form> --}}

                                    <form method="post"
                                        action="{{ route('dashboard.deletecategory', ['category' => $category->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                        @endforeach
                    @else
                        <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                            No Cateory available!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endunless
                    <!-- End Table with hoverable rows -->

                    </td>
                    </tr>
                </tbody>
            </table>


        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="{{ $categories->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <!-- Loop through the available pages -->
                @for ($i = 1; $i <= $categories->lastPage(); $i++)
                    <li class="page-item {{ $categories->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</x-layout_admin>
