<x-layout_s_admin>

    <div class="pagetitle">
        <h1>Manage Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dash.index') }}">Home</a></li>
                <li class="breadcrumb-item"> Administrator</li>
                <li class="breadcrumb-item active">Manage Supper Admin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body"> <br>
            <a href="{{ route('dash.adds_admin') }}">
                <button type="button" class="btn btn-primary">Add S_admin</button>
            </a>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">%share</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $sn = 1;
                @endphp
                @unless ($superadmins->isEmpty())
                    @foreach ($superadmins as $superadmin)
                    <tr>
                        <th scope="row">{{ $sn++ }}</th>
                        <td>{{ $superadmin->name }}</td>
                        <td>10</td>
                        <td>{{ $superadmin->role }}</td>


                        <td>
                            <button type="button" class="btn btn-success">Edit</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>

                    </tr>
                    @endforeach
                    @else
                    <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                        No Super Admin available!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endunless
                </tbody>
            </table>
            <!-- End Table with hoverable rows -->

        </div>
    </div>
</x-layout_s_admin>
