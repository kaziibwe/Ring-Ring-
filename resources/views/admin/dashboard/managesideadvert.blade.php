<x-layout_admin>
    <div class="pagetitle">
        <h1>Side Adverts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item">Manage Adverts</li>
                <li class="breadcrumb-item active">Manage Side Adverts </li>

            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body"> <br>
            <a href="{{ route('dashboard.addsideadvert') }}">
                <button type="button" class="btn btn-primary">Add Side Advert</button>
            </a> <br>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Descount</th>
                        <th scope="col">image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = 1;
                    @endphp


                    @unless ($sideadverts->isEmpty())
                        @foreach ($sideadverts as $sideadvert)
                            <tr>
                                <td>{{ $sn++ }}</td>

                                <td>{{ $sideadvert->name }}</td>
                                <td>{{ $sideadvert->description }}</td>
                                <td>
                                    <img src="{{ $sideadvert->image ? asset('storage/' . $sideadvert->image) : asset('../assets/img/profile-img.jpg') }}"
                                        alt="Profile" class="rounded-circle" width="50px">

                                </td>


                                <td>

                                    <a href="{{ route('dashboard.editsideadvert', ['sideadvert' => $sideadvert->id]) }}">
                                        <button type="button" class="btn btn-success">Edit</button>
                                    </a>
                                </td>
                                <td>

                                    <form method="post"
                                        action="{{ route('dashboard.deletesideadvert', ['sideadvert' => $sideadvert->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                        @endforeach
                    @else
                        <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                            No Side Advert available!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endunless


                    </tr>

                </tbody>
            </table>
            <!-- End Table with hoverable rows -->

        </div>
    </div>
</x-layout_admin>
