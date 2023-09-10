@extends('layouts.main')
@section('page-title', 'Email Template')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
    {{-- Stay --}}
@else
    {{ Session::flash('error', 'You are not permited to view that page') }}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert  alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
        </div>
    </div>




    <div class="row">
        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">New User Registration </h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template for user registration <br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[middle_name]</code> and
                        <code>[verification_code]</code>
                        where <small>[verification_code]</small> is the generated verification code,
                        <code>[payment_type]</code>, <code>[payment_amount]</code>, <code>[payment_method]</code>,
                        <code>[application_number]</code>, <code>[transaction_id]</code>, <code>[invoice_link]</code>
                    </p>
                    <form action="/update_email_template" method="post">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        {{-- <div id="editor">
                            <p>Hello World!</p>
                            <p>Some initial <strong>bold</strong> text</p>
                            <p><br></p>
                          </div> --}}
                        <textarea name="new_user_registration_message" id="new_user_registration_message" class="form-control" rows="7">{{ DB::table('settings')->value('new_user_registration_message') }}</textarea>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Application Status</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template for Application Status <br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[middle_name]</code> and
                        <code>[type]</code>, <code>[message]</code>
                        where <small>[type]</small> is the type of document approved.
                    </p>
                    <form action="/update_email_template" method="post">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="approved_document_message" id="approved_document_message" class="form-control" rows="7">{{ DB::table('settings')->value('approved_document_message') }}</textarea>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">School Details Approved</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template When school details has been approved <br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[middle_name]</code> and
                        <code>[pass]</code>
                        where <small>[pass]</small> is the generated password.
                    </p>
                    <form action="/update_email_template" method="post">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="school_details_approved_message" id="school_details_approved_message" class="form-control"
                            rows="7">{{ DB::table('settings')->value('school_details_approved_message') }}</textarea>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Rent Archived</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template When rent is been archived <br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[middle_name]</code> and
                        <code>[pass]</code>
                        where <small>[pass]</small> is the generated password.
                    </p>
                    <form action="update_email_template" method="post">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="rent_archived_message" id="rent_archived_message" class="form-control" rows="7">{{ DB::table('settings')->value('rent_archived_message') }}</textarea>

                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Rent Approved</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template When rent has been approved <br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[middle_name]</code>
                        {{-- and --}}
                        {{-- <code>[pass]</code>
                        where <small>[pass]</small> is the generated password. --}}
                    </p>
                    <form action="update_email_template" method="post">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="rent_approved_message" id="rent_approved_message" class="form-control" rows="7">{{ DB::table('settings')->value('rent_approved_message') }}</textarea>

                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Guarantor Form Email</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template When guarantor form is sent <br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[middle_name]</code>,
                        <code>[guarantor_first_name]</code>, <code>[guarantor_last_name]</code>,
                        <code>[guarantor_title]</code>, <code>[session_year]</code>
                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="guarantor_form_message" id="guarantor_form_message" class="form-control" rows="7">{{ DB::table('settings')->value('guarantor_form_message') }}</textarea>
                        <h6>Guarantor form file</h6>
                        <input type="file" class="form-control mb-3" name="guarantor_form_file" id="">
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Attestation Form Email</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template When attestation form is sent <br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[middle_name]</code>,
                        <code>[session_year]</code>
                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="attestation_form_message" id="attestation_form_message" class="form-control" rows="7">{{ DB::table('settings')->value('attestation_form_message') }}</textarea>
                        <h6>Attestation form file</h6>
                        <input type="file" class="form-control mb-3" name="attestation_form_file" id="">
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Health Form Email</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template When health form is sent <br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[middle_name]</code>,
                        <code>[session_year]</code>
                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="health_form_message" id="health_form_message" class="form-control" rows="7">{{ DB::table('settings')->value('health_form_message') }}</textarea>
                        <h6>Health form file</h6>
                        <input type="file" class="form-control mb-3" name="health_form_file" id="">
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Manual Payment Confirmation</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template When ever you make a bank tranfer or direct payment for user <br>
                        use <code>[full_name]</code>, <code>[transaction_id]</code>, <code>[type]</code>,
                        <code>[link]</code> and
                        <code>[auth]</code>
                        where <small>[auth]</small> is to show user email and password only during buying of form and where
                        <small>[link]</small> is the url to direct user back to the payment page.
                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="manual_payment_confirmation_message" id="manual_payment_confirmation_message" class="form-control"
                            rows="7">{{ DB::table('settings')->value('manual_payment_confirmation_message') }}</textarea>
                        {{-- <h6>Guarantor form file</h6>
                        <input type="file" class="form-control mb-3" name="guarantor_form_file"
                                            id="" > --}}
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Rent Expiring Date Close</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template resident rent is about to expirer <br>
                        use <code>[first_name]</code>, <code>[middle_name]</code>, <code>[last_name]</code>,
                        <code>[expiring_date]</code>
                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="rent_expiring_message" id="rent_expiring_message" class="form-control" rows="7">{{ DB::table('settings')->value('rent_expiring_message') }}</textarea>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Rent Expired Message</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template resident rent is about to expirer <br>
                        use <code>[first_name]</code>, <code>[middle_name]</code>, <code>[last_name]</code>,
                        <code>[expiring_date]</code>
                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="rent_expired_message" id="rent_expired_message" class="form-control" rows="7">{{ DB::table('settings')->value('rent_expired_message') }}</textarea>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Application Recieved Message</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template when user application is recieved <br>
                        use <code>[first_name]</code>, <code>[middle_name]</code>, <code>[last_name]</code>,
                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="application_recieved_message" id="application_recieved_message" class="form-control" rows="7">{{ DB::table('settings')->value('application_recieved_message') }}</textarea>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">New Staff Email</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template to new staff <br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[email]</code>,
                        <code>[password]</code>,
                        <code>[note]</code>, <code>[role]</code>, <code>[supervisor]</code>, <code>[position]</code>,
                        <code>[salary]</code>, <code>[department]</code>,
                        <code>[supervisor_first_name]</code>, <code>[supervisor_middle_name]</code>,
                        <code>[supervisor_last_name]</code>, <code>[supervisor_email]</code>,
                        <code>[supervisor_phone_number]</code>
                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="new_staff_created_email" id="new_staff_created_email" class="form-control" rows="7">{{ DB::table('settings')->value('new_staff_created_email') }}</textarea>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">New Document to Lawyer Email</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template to that will be sent to lawyer when new document is uplaoded <br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[email]</code>,
                        <code>[document_title]</code>, <code>[document_type]</code>, <code>[document_url]</code>,

                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="new_staff_created_email" id="new_staff_created_email" class="form-control" rows="7">{{ DB::table('settings')->value('new_staff_created_email') }}</textarea>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Rent Renewal request</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template to that will be sent to admin after user request for rent renewal<br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[email]</code>,
                        <code>[link]</code>

                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="renewal_request_template" id="renewal_request_template" class="form-control" rows="7">{{ DB::table('settings')->value('renewal_request_template') }}</textarea>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Rent Renewal Status</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Input custom template to that will be sent to user after admin approve or decline renewal request
                        <br>
                        use <code>[first_name]</code>, <code>[last_name]</code>, <code>[email]</code>,
                        <code>[status]</code>, <code>[link]</code>, <code>[room_name]</code>,<code>[moveoutdate-45]</code>
                        where 45 can be any number of your choice

                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hiddent" value="application_status"> --}}
                        <textarea name="renewal_status_template" id="renewal_status_template" class="form-control" rows="7">{{ DB::table('settings')->value('renewal_status_template') }}</textarea>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Rent Renewal Notice</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Message to display when user rent is close to due date <code>[moveoutdate-45]</code>
                        where 45 can be any number of your choice
                    </p>
                    <form action="update_email_template" method="post" enctype="multipart/form-data">
                        @csrf
                        <textarea name="rent_renewal_notice" id="rent_renewal_notice" class="form-control" rows="7">{{ DB::table('settings')->value('rent_renewal_notice') }}</textarea>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">submit</button>
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>




    </div>

    <div class="modal fade" id="update-profile">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update</h4>

                </div>
                <form class="form-horizontal" method="POST" action="{{ route('profile.updatepersonalinfo') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name" class="col-md-12 control-label">First Name</label>

                                    <div class="col-md-12">
                                        <input id="first_name" type="text" class="form-control"
                                            value="{{ auth()->user()->first_name }}" name="first_name" required>

                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                                    <label for="middle_name" class="col-md-12 control-label">Middle Name</label>

                                    <div class="col-md-12">
                                        <input id="middle_name" type="text" class="form-control"
                                            value="{{ auth()->user()->middle_name }}" name="middle_name" required>

                                        @if ($errors->has('middle_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('middle_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name" class="col-md-12 control-label">Last Name</label>

                                    <div class="col-md-12">
                                        <input id="last_name" type="text" class="form-control"
                                            value="{{ auth()->user()->last_name }}" name="last_name" required>

                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label for="photo" class="col-md-12 control-label">Profile Photo</label>

                            <div class="col-md-12">
                                <input required class="form-input ms-auto form-control" placeholder="500" type="file"
                                    name="photo" id="">

                                @if ($errors->has('photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer justify-content-between">

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
@section('script')

    {{-- <script src="../assets/js/plugins/summernote/js/summernote-bs4.js"></script> --}}
    <script src="../assets/js/plugins/quill.min.js"></script>
    <script src="../assets/js/plugins/ckeditor/ckeditor.js"></script>
    <script>
        $(function() {
            //Add text editor
            // $('#editor').summernote({
            //     height: 100,
            //     placeholder: 'Start Typing....',
            // });
            //         if (document.getElementById('editor')) {
            //   var quill = new Quill('#editor', {
            //     theme: 'snow' // Specify theme in configuration
            //   });
            // CKEDITOR.replace( 'editor' );
            CKEDITOR.replace('new_user_registration_message');
            CKEDITOR.replace('approved_document_message');
            CKEDITOR.replace('school_details_approved_message');
            CKEDITOR.replace('rent_approved_message');
            CKEDITOR.replace('rent_archived_message');
            CKEDITOR.replace('guarantor_form_message');
            CKEDITOR.replace('attestation_form_message');
            CKEDITOR.replace('health_form_message');
            CKEDITOR.replace('manual_payment_confirmation_message');
            CKEDITOR.replace('application_recieved_message');
            CKEDITOR.replace('new_staff_created_email');
            CKEDITOR.replace('lawyer_new_document_email');
            CKEDITOR.replace('rent_renewal_notice');


        });
    </script>
@endsection
