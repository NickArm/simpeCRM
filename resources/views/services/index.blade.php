<!DOCTYPE html>
<html lang="en">

<head>

    @extends('layouts.head')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <x-sidebar></x-sidebar>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <x-topbar></x-topbar>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class='row'>
                        <div class='col'>
                            <h1 class="h3 mb-2 text-gray-800">Services</h1>
                        </div>
                        <div class='col text-right '>
                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                data-target="#newserviceModal">Add
                                New Service</button>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach ($services as $b)
                                        <tr class="odd gradeX">
                                            <td>
                                                {{ $b->id }}
                                            </td>
                                            <td>
                                                {{ $b->name }}
                                            </td>
                                            <td>
                                                {{ $b->description }}
                                            </td>
                                            <td>
                                            <button class="btn btn-info btn-sm btn-edit-service" data-id="{{ $b->id }}" data-toggle="modal" data-target="#editServiceModal">Edit</button>
                                            <form method="POST" action="{{ url('/services/' . $b->id) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm btn-delete-service" data-id="{{ $b->id }}">Delete</button>
                                            </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <x-footer></x-footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Customer Modal -->
    <div class="modal" id="newserviceModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add New Service</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="/service_add" method="post">
                        {{ csrf_field() }}
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Name</label>
                                <input class="form-control" id="name" name="name" type="text"
                                    placeholder="Enter service name">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputLastName">Description</label>
                                <input class="form-control" id="description" name="description" type="text"
                                    placeholder="Enter a description">
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Edit Service Modal -->
<div class="modal" id="editServiceModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Edit Service</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="edit-form" method="post">
                    @csrf
                    @method('PUT') <!-- Specify the HTTP method to use when sending data -->

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="edit-name">Name</label>
                        <input type="text" id="edit-name" name="name" class="form-control" required>
                    </div>

                    <!-- Description Field -->
                    <div class="form-group">
                        <label for="edit-description">Description</label>
                        <input type="text" id="edit-description" name="description" class="form-control" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Service</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <x-main_scripts></x-main_scripts>
    <script>
    function editService(serviceId) {
        $.get('/services/' + serviceId + '/edit', function (service) {
            $('#edit-name').val(service.name);
            $('#edit-description').val(service.description);
            $('#edit-form').attr('action', '/services/' + serviceId);
        });
    }

    $(document).ready(function() {
        $('.btn-edit-service').on('click', function() {
            var serviceId = $(this).data('id'); // Get the ID from the data attribute
            $.ajax({
                url: '/services/' + serviceId + '/edit',
                type: 'GET',
                success: function(service) {
                    $('#edit-name').val(service.name);
                    $('#edit-description').val(service.description);
                    $('#edit-form').attr('action', '/services/' + serviceId);
                    $('#editServiceModal').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        $('.btn-delete-service').on('click', function() {
            var serviceId = $(this).data('id');
            var confirmDelete = confirm('Are you sure you want to delete this service?');
            if (confirmDelete) {
                // Find the form next to this button and submit it
                $(this).closest('form').submit();
            }
        });
    });
    </script>

</body>


</html>
