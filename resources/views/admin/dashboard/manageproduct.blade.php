<x-layout_admin>
    <div class="pagetitle">
        <h1>Products</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Goods</li>
                <li class="breadcrumb-item active">Manage Products</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body"> <br>
            <button type="button" onclick="window.location.href = '{{ route('dashboard.addproduct') }}'"
                class="btn btn-primary">Add Product</button>
            <button type="button" onclick="window.location.href = '{{ route('dashboard.manageproductsize') }}'"
                class="btn btn-secondary">Manage Sizes</button>
            <br>
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Number</th>
                        <th scope="col">Image</th>
                        <th scope="col">color</th>
                        <th scope="col">Size</th>
                        <th scope="col">Active</th>
                        <th scope="col">Featured</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = 1;
                    @endphp
                    @unless ($products->isEmpty())
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $sn++ }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->numberunit }}</td>

                                <td>
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('../assets/img/profile-img.jpg') }}"
                                        alt="Profile" class="rounded-circle" width="50px">

                                </td>
                                <td>{{ $product->color }}</td>
                                <td>{{ $product->size }}</td>
                                <td>{{ $product->Active }}</td>
                                <td>{{ $product->featured }}</td>
                                <td>
                                    <a href="{{ route('dashboard.editproduct', ['product' => $product->id]) }}">
                                        <button type="button" class="btn btn-success">Edit</button>
                                    </a>
                                </td>
                                <td>

                                    <form method="post"
                                        action="{{ route('dashboard.deleteproduct', ['product' => $product->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                        @endforeach
                    @else
                        <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                            No Products available!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <!-- End Table with hoverable rows -->

                    @endunless
                    </tr>

                </tbody>
            </table>
            <!-- End Table with hoverable rows -->

        </div>


        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <!-- Loop through the available pages -->
                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</x-layout_admin>
