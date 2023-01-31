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
                <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                    <div class="container-xl px-4">
                        <div class="page-header-content">
                            <div class="row align-items-center justify-content-between pt-3">
                                <div class="col-auto mb-3">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-user">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg></div>
                                        Account Settings - Profile
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main page content-->
                <div class="container-xl px-4 mt-4">
                    <!-- Account page navigation-->
                    <nav class="nav nav-borders">
                        <a class="nav-link" data-toggle="tab" role="tab" href="#profile"
                            aria-controls="profile">Profile</a>
                        <a class="nav-link" data-toggle="tab" role="tab" href="#services"
                            aria-controls="services">Services</a>
                        <a class="nav-link" data-toggle="tab" role="tab" href="#payments"
                            aria-controls="services">Payments</a>
                    </nav>
                    <hr class="mt-0 mb-4">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="services-tab">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    <form id="single_customer_form">
                                        {{ csrf_field() }}
                                        <!-- Form Row-->
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (first name)-->
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="inputFirstName">First
                                                    name</label>
                                                <input class="form-control" id="inputFirstName" type="text"
                                                    placeholder="Enter your first name" value="{{ $cus->fname }}">
                                            </div>
                                            <!-- Form Group (last name)-->
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="inputLastName">Last name</label>
                                                <input class="form-control" id="inputLastName" type="text"
                                                    placeholder="Enter your last name" value="{{ $cus->lname }}">
                                            </div>
                                        </div>
                                        <!-- Form Row        -->
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (organization name)-->
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="inputOrgName">Company
                                                    name</label>
                                                <input class="form-control" id="inputOrgName" type="text"
                                                    placeholder="Enter your organization name"
                                                    value="{{ $cus->company }}">
                                            </div>
                                            <!-- Form Group (location)-->
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="inputLocation">Address</label>
                                                <input class="form-control" id="inputLocation" type="text"
                                                    placeholder="Enter your location" value="{{ $cus->address }}">
                                            </div>
                                        </div>

                                        <!-- Form Row-->
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (phone number)-->
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="inputPhone">Phone
                                                    number</label>
                                                <input class="form-control" id="inputPhone" type="tel"
                                                    placeholder="Enter your phone number" value="{{ $cus->phone }}">
                                            </div>
                                            <!-- Form Group (email)-->
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="inputEmailAddress">Email
                                                    address</label>
                                                <input class="form-control" id="inputEmailAddress" type="email"
                                                    placeholder="Enter your email address"
                                                    value="{{ $cus->email }}">
                                            </div>
                                        </div>
                                        <!-- Save changes button-->
                                        <button class="btn btn-primary" type="button">Save changes</button>
                                        <!-- Add Service button-->
                                        <button class="btn btn-primary" type="button" data-toggle="modal"
                                            data-target="#addServiceModal">Add Service</button>
                                        <!-- Send Message button-->
                                        <button class="btn btn-primary" type="button" data-toggle="modal"
                                            data-target="#messageModal">Send Message</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="services" role="tabpanel"
                            aria-labelledby="services-tab">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Services</div>

                                <div class="card-body text-center">
                                    <table class="table table-bordered" id="dataTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Service</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Εxpiration</th>
                                                <th>Reminder</th>
                                                <th>Paid</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        @foreach ($services as $b)
                                            <tr class="odd gradeX">

                                                <td>
                                                    {{ $b->service_name }}
                                                </td>
                                                <td>
                                                    {{ $b->notes }}
                                                </td>

                                                <td>
                                                    {{ $b->price }}
                                                </td>
                                                <td>
                                                    {{ $b->expiration }}
                                                </td>
                                                <td>
                                                    <input type="checkbox" <?php if ($b->reminder) {
                                                        echo 'checked';
                                                    } ?> data-toggle="toggle"
                                                        id="reminder_changer">

                                                </td>
                                                <td>
                                                    <a href="#" style="font-size: 0.5rem;"
                                                        class="btn 
                                                        <?php if (empty($b->payment_id)) {
                                                            echo 'btn-danger';
                                                        } else {
                                                            echo 'btn-success';
                                                        } ?>
                                                        
                                                         btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <span class="text"><?php if (empty($b->payment_id)) {
                                                            echo 'unpaid';
                                                        } else {
                                                            echo 'paid';
                                                        } ?></span>
                                                    </a>
                                                    <input hidden value="{{ $b->id }}"
                                                        name="getservicetocustomer_id"
                                                        class="getservicetocustomer_id">
                                                    <?php if (empty($b->payment_id)) {
                                                        echo '<a style="font-size: 10px;" onclick="openpaynowmdal(' . $b->id . ')" href="#">PAY NOW</a>';
                                                    } else {
                                                        echo '<a style="font-size: 10px;"   href="#">VIEW PAYMENT</a>';
                                                    } ?>


                                                </td>
                                                <td>
                                                    <form action="/delete_service_from_user" method="post">
                                                        {{ csrf_field() }}
                                                        <input hidden type="text" name="service_id"
                                                            value="{{ $b->id }}">
                                                        <input hidden type="text" name="customer_id"
                                                            value="{{ $cus->id }}">
                                                        <a type="submit"
                                                            class="submit-form delete_service_from_user"><i
                                                                style="color: red;" class="fa-solid fa-trash"></i></a>
                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </table>
                                    <!-- Add Service button-->
                                    <div class="row"> <button
                                            style="margin-top: 20px;
                                        margin-left: 12px;"
                                            class="btn btn-primary" type="button" data-toggle="modal"
                                            data-target="#addServiceModal">Add Service</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="payments" role="tabpanel"
                            aria-labelledby="payments-tab">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Payments</div>

                                <div class="card-body text-center">
                                    <table class="table table-bordered" id="dataTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Service Name</th>

                                                <th>Payment Date</th>
                                                <th>Price</th>
                                                <th>Type</th>
                                                <th>Notes</th>

                                            </tr>
                                        </thead>
                                        @foreach ($payments as $b)
                                            <tr class="odd gradeX">

                                                <td>

                                                    {{ $b->servname }}
                                                </td>
                                                <td>
                                                    {{ $b->payment_date }}
                                                </td>

                                                <td>
                                                    {{ $b->price }}€
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
                                    <!-- Add Service button-->
                                    <div class="row"> <button
                                            style="margin-top: 20px;
                                        margin-left: 12px;"
                                            class="btn btn-primary" type="button" data-toggle="modal"
                                            data-target="#addPaymentModal">Add Payment</button>
                                    </div>
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

        <!-- Message Modal -->
        <div class="modal" id="messageModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Send Message to {{ $cus->fname }} {{ $cus->lname }}</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <form method="POST" action="/sendmessage">
                        @csrf
                        <div class="modal-body">

                            <input readonly name="email" type="email" class="form-control" id="email"
                                value="{{ $cus->email }}">

                            <div class="form-group">
                                <label for="message">Write your message</label>
                                <textarea class="form-control" name="your_message" id="message" rows="3"></textarea>
                            </div>

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Send</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Add Service Modal -->
        <div class="modal" id="addServiceModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Add Service to {{ $cus->fname }} {{ $cus->lname }}</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <form method="POST" action="/addservicetocustomer">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->

                                <input hidden id="customer_id" name="customer_id" type="text"
                                    value="{{ $cus->id }}">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="inputOrgName">Choose Service</label>
                                    @php
                                        $services = App\Http\Controllers\ServicesController::show();
                                    @endphp
                                    <select class="form-control" name="service_id" id="service_id">
                                        @foreach ($services as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>


                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-12">
                                    <label class="small mb-1" for="expiration">Expiration</label>
                                    <input class="form-control" id="expiration" name="expiration" type="date">
                                </div>

                                <div class="col-md-12">
                                    <label class="small mb-1" for="price">Price</label>
                                    <input class="form-control" id="price" name="price" type="number">
                                </div>
                            </div>

                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-12">
                                    <label class=" mb-1" for="inputEmailAddress">Set Reminder</label>
                                    <input type="checkbox" id="reminder" name="reminder">
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-12">
                                    <label class=" mb-1" for="inputEmailAddress">Is paid?</label>
                                    <input type="checkbox" id="paid_status" name="paid_status">
                                </div>
                                <div class="col-md-12">
                                    <label class=" mb-1" for="inputEmailAddress">Notes</label>
                                    <input type="text" id="notes" name="notes">
                                </div>
                            </div>

                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Add Payment Modal -->
        <div class="modal" id="addPaymentModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Add Payment for {{ $cus->fname }} {{ $cus->lname }}</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <form method="POST" action="/addpayment">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->

                                <input hidden id="customer_id" name="customer_id" type="text"
                                    value="{{ $cus->id }}">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="inputOrgName">Choose UnPaid Service</label>

                                    <select class="form-control" name="servicetocustomer_id"
                                        id="servicetocustomer_id">
                                        @foreach ($unpaid_payments as $s)
                                            <option>Choose Unpaid Service</option>
                                            <option value="{{ $s->id }}">
                                                {{ $s->servname }} - Expiration:{{ $s->expiration }} -
                                                Price:{{ $s->price }}€
                                            </option>
                                        @endforeach
                                    </select>


                                </div>
                                <div class="col-md-12">
                                    <label class="small mb-1" for="custom_servce">Or Create a Custom Service</label>
                                    <input class="form-control" id="custom_servce" name="custom_servce"
                                        type="text">
                                </div>

                                <!-- Form Group (location)-->
                                <div class="col-md-12">
                                    <label class="small mb-1" for="payment_date">Payment Date</label>
                                    <input class="form-control" id="payment_date" name="payment_date"
                                        type="date">
                                </div>

                                <!-- Form Group (location)-->
                                <div class="col-md-12">
                                    <label class="small mb-1" for="price">Price</label>
                                    <input class="form-control" id="price" name="price" type="text">
                                </div>

                                <div class="col-md-12">
                                    <label class="small mb-1" for="payment_type">Payment Type</label>
                                    <select class="form-control" name="payment_type" id="payment_type">
                                        <option value="cash">Cash</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="epos">ePos</option>
                                        <option value="paypal">Paypal</option>
                                    </select>

                                </div>
                                <div class="col-md-12">
                                    <label class="small mb-1" for="notes">Notes</label>
                                    <input class="form-control" id="notes" name="notes" type="text">
                                </div>

                            </div>

                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('.submit-form').on('click', function(e) {
                    e.preventDefault();
                    let form = $(this).closest('form');
                    let formActionUrl = form.attr('action');
                    let type = form.attr('method');
                    let formData = form.serialize();
                    $.ajax({
                        url: formActionUrl,
                        type: type,
                        data: formData,
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                        }
                    });
                });

                $('#paynowbtn').on('click', function(e) {
                    e.preventDefault();
                    $('#addPaymentModal').modal('show');
                    document.getElementById('servicetocustomer_id').value = document.getElementsByClassName(
                        'getservicetocustomer_id').value
                    console.log(document.getElementsByClassName('getservicetocustomer_id').value);
                })
            });

            function openpaynowmdal(id) {
                $('#addPaymentModal').modal('show');
                document.getElementById('servicetocustomer_id').value = id;
            }
        </script>
</body>

</html>
