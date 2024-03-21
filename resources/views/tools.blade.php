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
                            <h1 class="h3 mb-2 text-gray-800">Tools</h1>
                        </div>
                    </div>

                    <!-- Activity Log Button -->
                    <div class="mb-4">
                        <a href="{{ route('activity.log') }}" class="btn btn-primary">View Activity Log</a>
                    </div>

                    <!-- Export Button -->
                    <div class="mb-4">
                        <form action="{{ route('export.customers') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                Export Customers
                            </button>
                        </form>
                    </div>


                    <!-- Import Form -->
                    <div class="mb-4">
                        <form action="{{ route('import.customers') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="importFile">Import Customers</label>
                                <input type="file" class="form-control-file" id="importFile" name="import_file" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Import
                            </button>
                        </form>
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
