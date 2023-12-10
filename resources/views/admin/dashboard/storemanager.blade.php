<x-layout_admin>
    <div class="pagetitle">
        <h1>Store Manager</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Store manager</li>
                {{-- <li class="breadcrumb-item active">Manage Product Gallery</li> --}}

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body"> <br>
            <a href="{{ route('dashboard.storemanagerregister') }}">
                <button type="button" class="btn btn-primary">Add Store Manager</button>
            </a> <br>
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">NIN</th>

                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = 1;
                    @endphp
                    @unless ($stores->isEmpty())
                        @foreach ($stores as $store)
                            <tr>
                                <th scope="row">{{ $sn++ }}</th>
                                <td>{{ $store->name }}</td>
                                <td>
                                    <img src="{{ $store->image ? asset('storage/' . $store->image) : asset('../assets/img/profile-img.jpg') }}"
                                        alt="Profile" class="rounded-circle" width="50px">

                                </td>
                                <td>{{ $store->email }}</td>
                                <td>{{ $store->number }}</td>
                                <td>{{ $store->NIN }}</td>


                                <td>

                                    <form method="post"
                                        action="{{ route('dashboard.deletestore', ['store' => $store->id]) }}">
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
                    <a class="page-link" href="{{ $stores->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <!-- Loop through the available pages -->
                @for ($i = 1; $i <= $stores->lastPage(); $i++)
                    <li class="page-item {{ $stores->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $stores->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{ $stores->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</x-layout_admin>
