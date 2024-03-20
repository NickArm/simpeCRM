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
                            <h1 class="h3 mb-2 text-gray-800">Payments</h1>
                        </div>
                        <div class="col text-right ">
                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                data-target="#newcustomerModal">Add
                                New Payment</button>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Service</th>
                                            <th>Price</th>
                                            <th>Payment Date</th>
                                            <th>Payment Type</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    @foreach ($payments as $b)
                                        <tr class="odd gradeX">

                                            <td>
                                                {{ $b->servicetocustomer->customer->fname }} {{ $b->servicetocustomer->customer->lname }}</a>
                                            </td>

                                            <td>
                                                {{ $b->servname }}
                                            </td>
                                            <td>
                                                {{ $b->price }}
                                            </td>
                                            <td>
                                                {{ $b->payment_date }}
                                            </td>
                                            <td>
                                                {{ $b->payment_type }}
                                            </td>
                                            <td>
                                                {{ $b->notes }}
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



    <x-main_scripts></x-main_scripts>
</body>

</html>
