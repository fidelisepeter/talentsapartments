@extends('layouts.main')
@section('page-title', 'Settings')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'staff')
{{-- Stay --}}
@else
{{ Session::flash('error','You are not permited to view that page') }}
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
    <div class="">
        <div class="page-header min-height-100 border-radius-xl mt-4"
            style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ auth()->user()->photo }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                      </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                           Name: {{ auth()->user()->first_name }} {{ auth()->user()->middle_name }} {{ auth()->user()->last_name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ Str::replaceArray('_', [' '], auth()->user()->role)}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 scrollto" data-toggle="modal"
                                    data-target="#update-profile">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(603.000000, 0.000000)">
                                                        <path class="color-background"
                                                            d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                                                        </path>
                                                        <path class="color-background"
                                                            d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z"
                                                            opacity="0.7"></path>
                                                        <path class="color-background"
                                                            d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z"
                                                            opacity="0.7"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="">Update Profile</span>
                                </a>
                            </li>
                            <div class="moving-tab position-absolute nav-link"
                                style="padding: 0px; transition: all 0.5s ease 0s; transform: translate3d(0px, 0px, 0px); width: 360px;">
                                <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"
                                    role="tab" aria-selected="true">-</a>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-4 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Business Information</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        update business Information here
                    </p>
                    <form action="update_settings" method="post">@csrf

                        <div class="">
                            <label class="form-label">Business
                                Name</label>
                            <input class="form-control" type="text" name="business_name"
                                    value="{{ DB::table('settings')->value('business_name') }}">
                        </div>

                        <div class="">
                            <label class="form-label">Business
                                Bank
                                Name</label>
                                <input class="form-control" type="text" name="bank_name"
                                value="{{ DB::table('settings')->value('bank_name') }}">
                        </div>
                        <div class="">
                            <label class="form-label">Business
                                Bank
                                Account Number</label>
                                <input class="form-control" type="text"
                                    name="bank_account" value="{{ DB::table('settings')->value('bank_account') }}">
                        </div>

                        <div class="">
                            <label class="form-label">Business
                                WhatsApp Number</label>
                                <input class="form-control" type="text"
                                    name="whatsapp_number" value="{{ DB::table('settings')->value('whatsapp_number') }}">
                        </div>

                        <div class=" align-items-center justify-content-center mt-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0">submit</button>
                            </div>
                        </div>

                       
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Passwords</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        Change or update password for this Account
                    </p>
                    <form class="form-horizontal" method="POST" action="{{ route('profile.updatePassword') }}">
                        {{ csrf_field() }}

                        <div class="">
                            <label class="form-label">Old
                                Password</label>
                                <input id="currentPassword" placeholder="*******" type="password" class="form-control"
                                name="currentPassword" required>

                            @if ($errors->has('currentPassword'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('currentPassword') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="">
                            <label class="form-label">New
                                Pasword</label>
                                <input id="newPassword" type="password" class="form-control"
                                    name="newPassword" required>

                                @if ($errors->has('newPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newPassword') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="">
                            <label class="form-label">Confirm
                                New Passwords</label>
                                <input id="newPasswordConfirm" type="password" class="form-control"
                                    name="newPassword_confirmation" required>
                        </div>
                            
                            
                        <div class=" align-items-center justify-content-center mt-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mb-0">Change Password</button>
                            </div>
                        </div>
                            


                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4 mt-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Email Recipients</h6>
                        </div>
                        <div class="col-md-4 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                        who recieves the mail
                    </p>
                    <form action="update_email_recipients" method="post">@csrf

                        <div class="">
                            <label class="form-label">New
                                Registeration</label>
                                <input class="form-control" type="text"
                                    name="reg_email_recipient"
                                    value="{{ DB::table('settings')->value('reg_email_recipient') }}"
                                    placeholder="reservations@talentsapartments.com">
                        </div>
                        <div class="">
                            <label class="form-label">New
                                Payment</label>
                                <input class="form-control" type="text"
                                name="payment_email_recipient"
                                value="{{ DB::table('settings')->value('payment_email_recipient') }}"
                                placeholder="payments@talentsapartments.com">
                        </div>
                        <div class="">
                            <label class="form-label">Files
                                Uploaded</label>
                                <input class="form-control" type="text"
                                    name="file_email_recipient"
                                    value="{{ DB::table('settings')->value('file_email_recipient') }}"
                                    placeholder="documents@talentsapartments.com">
                        </div>
                        <div class="">
                            <label class="form-label">complaints
                                made</label>
                                <input class="form-control" type="text"
                                    name="complaint_email_recipient"
                                    value="{{ DB::table('settings')->value('complaint_email_recipient') }}"
                                    placeholder="complaints@talentsapartments.com">
                        </div>
                        
                           
                            
                           
                        <div class=" align-items-center justify-content-center mt-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-info btn-sm mb-0">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    {{-- <div class="col-12 col-xl-6 mt-5">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">Email Template</h6>
                    </div>
                    <div class="col-md-4 text-end">

                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <p class="text-sm">
                    this message comes after eg 'Hello Ola'
                </p>
                <form action="update_email_template" method="post">@csrf


                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">User
                                Registered:</strong> &nbsp; <input class="form-control" type="text"
                                name="reg_email_template"
                                value="{{ DB::table('settings')->value('reg_email_template') }}"
                                placeholder="has applied for a room please check"></li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">User
                                Submit
                                Payment:</strong> &nbsp; <input class="form-control" type="text"
                                name="payment_email_template"
                                value="{{ DB::table('settings')->value('payment_email_template') }}"
                                placeholder="has submitted a payment please check"></li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">User
                                Submit
                                other files:</strong> &nbsp; <input class="form-control" type="text"
                                name="file_email_template"
                                value="{{ DB::table('settings')->value('file_email_template') }}"
                                placeholder="has uplaoded some files please check"></li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">User makes
                                a
                                complaint:</strong> &nbsp; <input class="form-control" type="text"
                                name="complaint_email_template"
                                value="{{ DB::table('settings')->value('complaint_email_template') }}"
                                placeholder="has made a complaint please check"></li>

                        <li class="list-group-item border-0 ps-0 pb-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-warning btn-sm mb-0">submit</button>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="col-12 col-xl-8 mt-5">
        
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">Manage year</h6>
                        
                    </div>
                    <div class="col-md-4 text-end">

                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <p class="text-sm">
                    create a new year this will close the existing year
                </p>
                <form action="/year" method="post">@csrf

                  
                   <div class="row">
                    <div class="col-sm-6">
                     {{-- <label class="form-label">Form Fee</label> --}}
                         <input class="form-control" type="text"
                             name="year"
                             >
                    </div>
                    <div class="col-sm-6">
                     {{-- <label class="form-label">WhatsApp</label> --}}
                     <input class="btn btn-primary form-control" type="submit"
                         name="registration_form_price"
                         value="create new academic year"
                         >
                    </div>
                </div>
                       
                   
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="mb-0">Agreements and Code of Conduct</h6>
                        <p class="text-sm">Upload Agreements and Code of Conduct PDF file here</p>
                    </div>
                    {{-- <div class="col-md-4 text-end">

                    </div> --}}
                </div>
            </div>
            <div class="card-body p-3">
                
                <form action="update_site_files" method="post" enctype="multipart/form-data">@csrf

                    <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                        <label for="photo" class="col-md-12 control-label">Agreements</label>

                        <div class="col-md-12">
                            <input required class="form-input ms-auto form-control" placeholder="500" type="file"
                                name="agreement" id="">

                            @if ($errors->has('photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                        <label for="photo" class="col-md-12 control-label">Code of conducts</label>

                        <div class="col-md-12">
                            <input required class="form-input ms-auto form-control" placeholder="500" type="file"
                                name="code_of_conduct" id="">

                            @if ($errors->has('photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                       
                        
                       
                    <div class=" amt-3">
                        <div class="mt-3">
                            <button type="submit" class="btn btn-info btn-sm mb-0">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">Other Settings</h6>
                    </div>
                    <div class="col-md-4 text-end">

                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                
                <form action="update_site_settings" method="post">@csrf

                   <div class="row">
                       <div class="col-sm-6">
                        <label class="form-label">Form Fee</label>
                            <input class="form-control" type="text"
                                name="registration_form_price"
                                value="{{ DB::table('settings')->value('registration_form_price') }}"
                                placeholder="">
                       </div>
                       <div class="col-sm-6">
                        <label class="form-label">Complaints Management Role</label>
                        <select class="multisteps-form__select form-control" name="complaints_management_role">
                            <option value="">-select-</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @if (DB::table('settings')->value('complaints_management_role') == $role->name)
                                  selected  
                                @endif> {{ $role->name }}</option>
                            @endforeach
                        </select>
                        @if (count($roles) == 0)
                            <span class="text-warning text-xxs opacity-7" role="alert">
                                <strong>Site don't have any roles for now</strong>
                            </span>
                        @endif
                       </div>
                   </div>
                       
                        
                       
                    <div class=" amt-3">
                        <div class="mt-3">
                            <button type="submit" class="btn btn-info btn-sm mb-0">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4 mt-5">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">OffBar</h6>
                    </div>
                    <div class="col-md-4 text-end">

                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <p class="text-sm">
                    Add PopUp Item on users pages
                </p>
                <form action="update_ofbar" method="post">
                    @csrf

                    <div class="">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="7" >{{ DB::table('ofbar')->value('content') }}</textarea>
                    </div>
                    <div class="mt-3">
                        <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" name="button" type="checkbox" id="flexSwitchCheckDefault" @if (DB::table('ofbar')->value('button') == true) checked @endif >
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Show Button</label>
                          </div>
                    </div>
                    <div class="">
                        <label class="form-label">Buttton Text</label>
                            <input class="form-control" type="text"
                            name="button_text"
                            value="{{ DB::table('ofbar')->value('button_text') }}"
                            >
                    </div>
                    <div class="">
                        <label class="form-label">Buttton url</label>
                            <input class="form-control" type="text"
                            name="button_url"
                            value="{{ DB::table('ofbar')->value('button_url') }}"
                            >
                    </div>
                    
                       
                        
                       
                    <div class=" align-items-center justify-content-center mt-3">
                        <div class="d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-info btn-sm mb-0">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update-profile">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update</h4>

                </div>
                <form class="form-horizontal" method="POST" action="{{ route('profile.updatepersonalinfo') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-body">

                       <div class="row">
                           <div class="col-sm-4">
                            <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-12 control-label">First Name</label>

                                <div class="col-md-12">
                                    <input id="first_name" type="text" class="form-control" value="{{ auth()->user()->first_name }}" name="first_name"
                                        required>

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
                                    <input id="middle_name" type="text" class="form-control" value="{{ auth()->user()->middle_name }}" name="middle_name" required>

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
                                    <input id="last_name" type="text" class="form-control" value="{{ auth()->user()->last_name }}" name="last_name" required>

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
                            <input required class="form-input ms-auto form-control"
                            placeholder="500" type="file" name="photo" id="">

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


@endsection
