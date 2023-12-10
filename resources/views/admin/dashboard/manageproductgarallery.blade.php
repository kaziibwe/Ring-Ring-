<x-layout_admin>
    <div class="pagetitle">
        <h1>Product Gallery</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Goods</li>
                <li class="breadcrumb-item active">Manage Product Gallery</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body"> <br>
            <a href="{{ route('dashboard.addproductgarallery') }}">
                <button type="button" class="btn btn-primary">Add Product Gallery</button>
            </a> <br>
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = 1;
                    @endphp
                    @unless ($productgalleries->isEmpty())
                        @foreach ($productgalleries as $productgallery)
                            <tr>
                                <th scope="row">{{ $sn++ }}</th>

                                <td>
                                    <img src="{{ $productgallery->image ? asset('storage/' . $productgallery->image) : asset('../assets/img/profile-img.jpg') }}"
                                        alt="Profile" class="rounded-circle" width="50px">

                                </td>
                                <td>
                                    <a
                                        href="{{ route('dashboard.editproductgallery', ['productgallery' => $productgallery->id]) }}">
                                        <button type="button" class="btn btn-success">Edit</button>
                                    </a>
                                <td>

                                    <form method="post"
                                        action="{{ route('dashboard.deleteproductgallery', ['productgallery' => $productgallery->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                            No Gallery Product available!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endunless
                    </td>
                    </tr>
                </tbody>
            </table>
            <!-- End Table with hoverable rows -->

        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="{{ $productgalleries->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <!-- Loop through the available pages -->
                @for ($i = 1; $i <= $productgalleries->lastPage(); $i++)
                    <li class="page-item {{ $productgalleries->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $productgalleries->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{ $productgalleries->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</x-layout_admin>
