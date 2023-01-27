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
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-2 text-gray-800">Customers</h1>
                        </div>
                        <div class="col text-right ">
                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                data-target="#newcustomerModal">Add
                                New Customer</button>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    @foreach ($customers as $b)
                                        <tr class="odd gradeX">

                                            <td>
                                                <a href="/customer_edit/{{ $b->id }}">{{ $b->fname }}
                                                    {{ $b->lname }}</a>
                                            </td>

                                            <td>
                                                {{ $b->address }}
                                            </td>
                                            <td>
                                                {{ $b->phone }}
                                            </td>
                                            <td>
                                                {{ $b->email }}
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
    <div class="modal" id="newcustomerModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add New Customer</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="/customer_add" method="post">
                        {{ csrf_field() }}
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">First
                                    name</label>
                                <input class="form-control" id="fname" name="fname" type="text"
                                    placeholder="Enter your first name">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" id="lname" name="lname" type="text"
                                    placeholder="Enter your last name">
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="company">Company
                                    name</label>
                                <input class="form-control" id="company" name="company" type="text"
                                    placeholder="Enter your organization name">
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="address">Address</label>
                                <input class="form-control" id="address" name="address" type="text"
                                    placeholder="Enter your location">
                            </div>
                        </div>

                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="phone">Phone
                                    number</label>
                                <input class="form-control" id="phone" name="phone" type="tel"
                                    placeholder="Enter your phone number">
                            </div>
                            <!-- Form Group (email)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="email">Email
                                    address</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter your email address">
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Save changes</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-main_scripts></x-main_scripts>
</body>

</html>
