<x-layout_admin>
    <div class="pagetitle">
        <h1>Manage Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item"> Manage Users</li>
                <li class="breadcrumb-item active">Manage Users</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <br><br>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Manage User</h5>

            <!-- Table with hoverable rows -->

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Street</th>
                                    <th scope="col"> Division</th>
                                    <th scope="col">City</th>                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sn = 1;
                                @endphp
                                @unless ($customers->isEmpty())
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <th scope="row">{{ $sn++ }}</th>
                                            <td>{{ $customer->name }}</td>
                                            <td>
                                                <img src="{{ $customer->image ? asset('storage/' . $customer->image) : asset('../assets/img/profile-img.jpg') }}"
                                                    alt="Profile" class="rounded-circle" width="50px">

                                            </td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->number }}</td>
                                            <td>{{ $customer->street }}</td>
                                            <td>{{ $customer->division }}</td>
                                            <td>{{ $customer->city }}</td>







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
                                <a class="page-link" href="{{ $customers->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <!-- Loop through the available pages -->
                            @for ($i = 1; $i <= $customers->lastPage(); $i++)
                                <li class="page-item {{ $customers->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $customers->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item">
                                <a class="page-link" href="{{ $customers->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
</x-layout_admin>
