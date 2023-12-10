<x-layout_admin>
    <div class="pagetitle">
        <h1>Manage Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item"> Manage Users</li>
                <li class="breadcrumb-item active">Feedback</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <br><br>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Manage Feedback</h5>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Product</th>
                        <th scope="col">Number</th>
                        <th scope="col">Feedback</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Brandon Jacob</td>
                        <td>shirt</td>
                        <td>0785557587</td>
                        <td>
                            my family likes your products . i would like to host you and buy you tea.
                            Thank you for your services we love you so much
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Bridie Kessler</td>
                        <td>shirt</td>
                        <td>0785557587</td>
                        <td>
                            my family likes your products . i would like to host you and buy you tea.
                            Thank you for your services we love you so much
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Ashleigh Langosh</td>
                        <td>shirt</td>
                        <td>0785557587</td>
                        <td>
                            my family likes your products . i would like to host you and buy you tea.
                            Thank you for your services we love you so much
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Angus Grady</td>
                        <td>shirt</td>
                        <td>0785557587</td>
                        <td>
                            my family likes your products . i would like to host you and buy you tea.
                            Thank you for your services we love you so much
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Raheem Lehner</td>
                        <td>shirt</td>
                        <td>0785557587</td>
                        <td>
                            my family likes your products . i would like to host you and buy you tea.
                            Thank you for your services we love you so much
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- End Table with hoverable rows -->

        </div>
    </div>
</x-layout_admin>
