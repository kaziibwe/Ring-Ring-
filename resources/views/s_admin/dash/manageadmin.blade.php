<x-layout_s_admin>

    <div class="pagetitle">
        <h1>Manage Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dash.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Admin</li>
                <li class="breadcrumb-item active">Manage Admin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body"> <br>
            <a href="{{ route('dash.addadmin') }}">
                <button type="button" class="btn btn-primary">Add admin</button>
            </a>
            {{-- <h5 class="card-title">Manage Main Category</h5> --}}

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">street</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone No</th>
                        <th scope="col">Division</th>
                        {{-- <th scope="col">City</th>
                        <th scope="col">Country</th> --}}
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = 1;
                    @endphp
                    @unless ($admins->isEmpty())
                        @foreach ($admins as $admin)
                            <tr>
                                <th scope="row">{{ $sn++ }}</th>
                                <td>{{ $admin->name }}</td>
                                <td> <img
                                        src="{{ $admin->image ? asset('storage/' . $admin->image) : asset('../assets/img/profile-img.jpg') }}"
                                        alt="Profile" class="rounded-circle" width="50px">
                                </td>
                                <td>{{ $admin->street }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->number }}</td>
                                <td>{{ $admin->division }}</td>
                                {{-- <td>{{ $admin->city }}</td>
                                <td>{{ $admin->country }}</td> --}}

                                <td>
                                    {{-- <a
                                    href="{{ route('dash.editadmin', ['admin' => $admin->id]) }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>                                </td> --}}
                                    <form method="post"
                                    action="{{ route('dash.deleteadmin', ['admin' => $admin->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                                No  Admin available!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endunless

                    </tbody>
                </table>
                <!-- End Table with hoverable rows -->

            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="{{ $admins->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <!-- Loop through the available pages -->
                    @for ($i = 1; $i <= $admins->lastPage(); $i++)
                        <li class="page-item {{ $admins->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $admins->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link" href="{{ $admins->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </x-layout_s_admin>
