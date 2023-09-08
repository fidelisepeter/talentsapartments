@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('style')
@endsection
@section('page-title', 'Create Staff')
@section('content')


    @php
        if ($errors) {
            $outPut = '<ul class="list-group" style="justify-content: center; padding: 1em 1.6em 0.3em; text-align: left !important;">';
            foreach ($errors->all() as $error) {
                $outPut .= '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><span class="text-danger">*</span> ' . $error . '</li>';
            }
            $outPut .= '<ul>';
        }
        
    @endphp
    {{-- @dd($errors->all()) --}}
    @if ($errors->all())
        <script>
            const requiredButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-gradient-success',
                    cancelButton: 'btn bg-gradient-danger'
                },
                buttonsStyling: false
            })
            requiredButtons.fire({
                title: 'Error',
                html: '{!! html_entity_decode($outPut) !!}',
                showCloseButton: true,
            })
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-5">

                <!--progress bar-->
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-5">
                        <div class="multisteps-form__progress">
                            <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                <span>Staff Info</span>
                            </button>
                            <button class="multisteps-form__progress-btn" type="button" title="Address">Address</button>
                            <button class="multisteps-form__progress-btn" type="button" title="Socials">Profiles</button>
                            <button class="multisteps-form__progress-btn" type="button" title="Profile">Salary</button>
                        </div>
                        <div id="message-box"></div>
                    </div>
                </div>
                <!--form panels-->
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="multisteps-form__form mb-8" id="create-staff-form" action="/staff/save" method="POST">
                            @csrf
                            <!--single form panel-->
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Informations</h5>
                                <p class="mb-0 text-sm">Mandatory information</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>First Name</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                name="first_name" placeholder="eg. Michael" required />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Last Name</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                name="last_name" placeholder="eg. Prior" required />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Phone Number</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                name="phone_number" placeholder="eg. 09012345678" required />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Email Address</label>
                                            <input class="multisteps-form__input form-control" type="email" name="email"
                                                placeholder="eg. name@mail.com" required />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Password</label>
                                            <input class="multisteps-form__input form-control" type="password"
                                                name="password" placeholder="******" required />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Repeat Password</label>
                                            <input class="multisteps-form__input form-control" type="password"
                                                name="password_confirm" placeholder="******" required />
                                        </div>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                            title="Next">Next</button>
                                    </div>
                                </div>
                            </div>
                            <!--single form panel-->
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                                <h5 class="font-weight-bolder">Address</h5>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label>Street</label>
                                            <input class="multisteps-form__input form-control" type="text" name="street"
                                                placeholder="eg. Street 111" />
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>City</label>
                                            <input class="multisteps-form__input form-control" type="text" name="city"
                                                placeholder="eg. Tokyo" />
                                        </div>
                                        <div class="col-6 col-sm-6yyy mt-3 mt-sm-0">
                                            <label>State</label>
                                            <select class="multisteps-form__select form-control" name="state">
                                                <option disabled selected>--Select State--</option>
                                                <option value="Abia">Abia</option>
                                                <option value="Adamawa">Adamawa</option>
                                                <option value="Akwa Ibom">Akwa Ibom</option>
                                                <option value="Anambra">Anambra</option>
                                                <option value="Bauchi">Bauchi</option>
                                                <option value="Bayelsa">Bayelsa</option>
                                                <option value="Benue">Benue</option>
                                                <option value="Borno">Borno</option>
                                                <option value="Cross Rive">Cross River</option>
                                                <option value="Delta">Delta</option>
                                                <option value="Ebonyi">Ebonyi</option>
                                                <option value="Edo">Edo</option>
                                                <option value="Ekiti">Ekiti</option>
                                                <option value="Enugu">Enugu</option>
                                                <option value="FCT">Federal Capital Territory</option>
                                                <option value="Gombe">Gombe</option>
                                                <option value="Imo">Imo</option>
                                                <option value="Jigawa">Jigawa</option>
                                                <option value="Kaduna">Kaduna</option>
                                                <option value="Kano">Kano</option>
                                                <option value="Katsina">Katsina</option>
                                                <option value="Kebbi">Kebbi</option>
                                                <option value="Kogi">Kogi</option>
                                                <option value="Kwara">Kwara</option>
                                                <option value="Lagos">Lagos</option>
                                                <option value="Nasarawa">Nasarawa</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Ogun">Ogun</option>
                                                <option value="Ondo">Ondo</option>
                                                <option value="Osun">Osun</option>
                                                <option value="Oyo">Oyo</option>
                                                <option value="Plateau">Plateau</option>
                                                <option value="Rivers">Rivers</option>
                                                <option value="Sokoto">Sokoto</option>
                                                <option value="Taraba">Taraba</option>
                                                <option value="Yobe">Yobe</option>
                                                <option value="Zamfara">Zamfara</option>
                                            </select>
                                        </div>
                                        {{-- <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                            <label>Zip</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="7 letters" />
                                        </div> --}}
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                            title="Prev">Prev</button>
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                            title="Next">Next</button>
                                    </div>
                                </div>
                            </div>
                            <!--single form panel-->
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder">Profile</h5>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label>Role</label>
                                            <select class="multisteps-form__select form-control" name="role">
                                                <option value="">-select-</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}"> {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @if (count($roles) == 0)
                                                <span class="text-warning text-xxs opacity-7" role="alert">
                                                    <strong>Site don't have any roles for now</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label>Supervisor</label>
                                            <select class="multisteps-form__select form-control" name="supervisor">
                                                <option value="">-select-</option>
                                                @foreach ($supervisors as $supervisor)
                                                    <option value="{{ $supervisor->id }}">
                                                        {{ $supervisor->first_name }}
                                                        {{ $supervisor->middle_name }}
                                                        {{ $supervisor->last_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <label>Department</label>
                                                    <select class="multisteps-form__select form-control"
                                                        name="department">
                                                        <option selected="selected">-select-</option>
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}">
                                                                {{ $department->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if (count($departments) == 0)
                                                        <span class="text-warning text-xxs opacity-7" role="alert">
                                                            <strong>Site don't have any departments for now</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-6 col-sm-6yyy mt-3 mt-sm-0">
                                                    <label>Position</label>
                                                    <input class="multisteps-form__input form-control" type="text"
                                                        name="position" placeholder="eg. Sales Manager" />

                                                </div>
                                                {{-- <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                                    <label>Zip</label>
                                                    <input class="multisteps-form__input form-control" type="text"
                                                        placeholder="7 letters" />
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="button-row d-flex mt-4 col-12">
                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                title="Prev">Prev</button>
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                title="Next">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--single form panel-->
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder">Salary</h5>
                                <div class="multisteps-form__content mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Amount
                                                <small class="text-grey opacity-7">amount without currency symbol</small>
                                            </label>
                                            <input class="multisteps-form__input form-control" type="number"
                                                name="salary" placeholder="eg. 3000" />
                                        </div>
                                        <div class="col-12">
                                            <label>Start Date
                                            </label>
                                            <input class="multisteps-form__input form-control" type="date"
                                                name="start_date" placeholder="eg. 3000" />
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label>Note</label>
                                            <small class="text-grey opacity-7">Note will be attach the email sent to the
                                                user</small>
                                            <textarea class="multisteps-form__textarea form-control" rows="5" name="note"
                                                placeholder="send staff a message. you can add staff password."></textarea>
                                        </div>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                            title="Prev">Prev</button>
                                        <button class="btn bg-gradient-dark ms-auto mb-0" type="button" title="Send"
                                            id="create-staff-button">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {



            //     const getData = (req, success, error) => {
            //         var data = {
            //             _token: $("input[name='_token']").val(),
            //             column: req[0],
            //             value: req[1],
            //         };
            //         alert("Succesdds: " + JSON.stringify(data));
            //         // data._token = $("input[name='_token']").val();
            //         // data.column = req
            //         $.ajax({
            //             url: "/staff/match",
            //             method: "POST",
            //             dataType: 'JSON',
            //             data: data,
            //             success: success,
            //             error: error
            //         });
            //     }

            //     // var data = ['emayilyy','admin@site.com'];

            // function is() {
            //     getData(['email', 'admin@site.com'],
            //                 function(success) {

            //                     if (success.message == 'user_exist') {
            //                         sessionStorage.setItem("key", "value");
            //                         alert("email: " + success.message);

            //                     }
            //                 }
            //             )

            //     alert("emails: " + D);
            //     // var m = await getData(['email', 'admin@site.com'])

            //             // alert("email: " + m);

            // }
            // is()



            $("#create-staff-button").click(function() {

                const message = [];
                const required = [];
                const suggested = [];



                if (!$("input[name='first_name']").val()) {
                    message.push({
                        type: 'required',
                        message: 'Staff first name is required',
                    });
                }

                if (!$("input[name='last_name']").val()) {
                    message.push({
                        type: 'required',
                        message: 'Staff last name is required',
                    });
                }

                if (!$("input[name='email']").val()) {
                    message.push({
                        type: 'required',
                        message: 'Staff email is required',
                    });
                }

                if (!$("input[name='phone_number']").val()) {
                    message.push({
                        type: 'required',
                        message: 'Staff phone number is required',
                    });
                }

                if (!$("input[name='password']").val()) {
                    message.push({
                        type: 'required',
                        message: 'Password is required',
                    });
                }

                if (!$("select[name='role']").val()) {
                    message.push({
                        type: 'suggested',
                        message: 'You have not choosing any Role for this staff',
                    });
                }

                if (!$("select[name='supervisor']").val()) {
                    message.push({
                        type: 'suggested',
                        message: 'You have not choosing any Supervisor for this staff',
                    });
                }

                if ($("input[name='password']").val() !== $("input[name='password_confirm']").val()) {
                    message.push({
                        type: 'required',
                        message: 'Both passwords does not match',
                    });
                }

                message.forEach((arg) => {
                    if (arg.type == 'required') {
                        required.push(
                            '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><span class="text-danger">*</span> ' +
                            arg.message + '</li>');
                    }
                    if (arg.type == 'suggested') {
                        suggested.push(
                            '<li class="list-group-item border-0 ps-0 pt-0 text-sm"> <span class="text-warning">*</span> ' +
                            arg.message + '</li>');
                    }
                });

                const allMessages = [...required, ...suggested];

                var output =
                    '<ul class="list-group" style="justify-content: center; padding: 1em 1.6em 0.3em; text-align: left !important;">';
                allMessages.forEach((message) => {
                    output += message;
                });
                output += '</ul>';



                if (required.length !== 0) {
                    const requiredButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn bg-gradient-success',
                            cancelButton: 'btn bg-gradient-danger'
                        },
                        buttonsStyling: false
                    })
                    requiredButtons.fire({
                        title: 'Error',
                        html: output,
                        showCloseButton: true,
                    })
                } else if (suggested.length !== 0) {
                    const suggestedButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn bg-gradient-success',
                            cancelButton: 'btn bg-gradient-danger'
                        },
                        buttonsStyling: false
                    })

                    suggestedButtons.fire({
                        title: 'Sure?',
                        html: output,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, continue!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            this.form.submit()
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            //   swalWithBootstrapButtons.fire(
                            //     'Cancelled',
                            //     'Your imaginary file is safe :)',
                            //     'error'
                            //   )
                        }
                    })

                } else {
                    this.form.submit();
                }
            });

        });
    </script>
    <script src="{{ asset('/assets/js/plugins/multistep-form.js') }}"></script>
    <!-- Toastr -->
    {{-- <script src="{{ asset('/assets/js/plugins/jquery/jquery-3.3.1.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('/assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/toastr/toastr.min.js') }}"></script> --}}
@endsection
