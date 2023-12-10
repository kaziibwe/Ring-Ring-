<x-layout_supplier>
    @auth('supplier')
    <!-- Content for authenticated users -->
    <p>Welcome, Supplier! You can see the orders here.</p>

    {{-- Display the order items here --}}
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">SN</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">image</th>
                <th scope="col">size</th>
                <th scope="col">color</th>

            </tr>
        </thead>
        <tbody>
            @php
                $sn = 1;
            @endphp

            @unless ($orderItems->isEmpty())
            @foreach ($orderItems as $item)
            <tr>
                        <th scope="row">{{ $sn++ }}</th>
                        <td> {{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>

                        <td>
                            <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('../assets/img/profile-img.jpg') }}"
                                alt="Profile" class="rounded-circle" width="50px">

                        </td>
                        <td>{{ $item->item_sizes }}</td>
                        <td>{{ $item->item_colors }}</td>


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
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="{{ $orderItems->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <!-- Loop through the available pages -->
            @for ($i = 1; $i <= $orderItems->lastPage(); $i++)
                <li class="page-item {{ $orderItems->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $orderItems->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item">
                <a class="page-link" href="{{ $orderItems->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

@else
    <!-- Content for unauthenticated users -->
    <p>You must log in as a supplier to view the orders. Please <a href="{{ route('login') }}">log in</a>.</p>
@endauth
</x-layout_supplier>
