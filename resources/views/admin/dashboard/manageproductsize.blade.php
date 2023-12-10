<x-layout_admin>
    <div class="pagetitle">
        <h1>product Sizes</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Goods</li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard.manageproduct') }}">Manage product</a>
                </li>
                <li class="breadcrumb-item active">Manage Product Size</li>


            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body"> <br>
            <button type="button" onclick="window.location.href = '{{ route('dashboard.addproductsize') }}'"
                class="btn btn-primary">Add Product Size</button>
            <br>
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">size</th>
                        <th scope="col">Price</th>
                        <th scope="col">Unities</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = 1;
                    @endphp
                    @unless ($productsizes->isEmpty())
                        @foreach ($productsizes as $productsize)
                            <tr>
                                <th scope="row">{{ $sn++ }}</th>
                                <td>{{ $productsize->itemsizes }}</td>
                                <td>{{ $productsize->itemprice }}</td>
                                <td>{{ $productsize->unities }}</td>
                                <td>
                                    <a href="{{ route('dashboard.editproductsize', ['productsize' => $productsize->id]) }}">
                                        <button type="button" class="btn btn-success">Edit</button>
                                    </a>
                                <td>


                                    <form method="post"
                                        action=" {{ route('dashboard.deleteproductsize', ['productsize' => $productsize->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                </td>
                        @endforeach
                    @else
                        <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                            No productsizes available!
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
                    <a class="page-link" href="{{ $productsizes->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <!-- Loop through the available pages -->
                @for ($i = 1; $i <= $productsizes->lastPage(); $i++)
                    <li class="page-item {{ $productsizes->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $productsizes->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{ $productsizes->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</x-layout_admin>
