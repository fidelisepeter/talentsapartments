@extends('layouts.main')

@section('style')
@endsection
@section('page-title', 'New Guest')
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
                                <span>Guest Info</span>
                            </button>
                            {{-- <button class="multisteps-form__progress-btn" type="button" title="Final">Submit</button> --}}
                        </div>
                        <div id="message-box"></div>
                    </div>
                </div>
                <!--form panels-->
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="multisteps-form__form mb-8" id="create-lawyer-form" action="/guest/store" method="POST">
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
                                            <label>Type</label>
                                            <select class="multisteps-form__select form-control" name="type" required>
                                                <option disabled>-select-</option>
                                                <option value="Student">Student</option>
                                                <option value="Visitor">Visitor</option>
                                                <option value="Relation">Relation</option>
                                            </select>
                                            
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Date</label>
                                            <input class="multisteps-form__input form-control" type="date"
                                                name="date" placeholder="" required />
                                        </div>
                                    </div>
                                    
                                    <div class="button-row d-flex mt-4">
                                        
                                        <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Send"
                                            >Send</button>
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
            //             url: "/lawyer/match",
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



            $("#create-lawyer-button").click(function() {

                const message = [];
                const required = [];
                const suggested = [];



                if (!$("input[name='first_name']").val()) {
                    message.push({
                        type: 'required',
                        message: 'Guest first name is required',
                    });
                }

                if (!$("input[name='last_name']").val()) {
                    message.push({
                        type: 'required',
                        message: 'Guest last name is required',
                    });
                }

                if (!$("input[name='email']").val()) {
                    message.push({
                        type: 'required',
                        message: 'Guest email is required',
                    });
                }

                if (!$("input[name='phone_number']").val()) {
                    message.push({
                        type: 'required',
                        message: 'Guest phone number is required',
                    });
                }

                if (!$("input[name='password']").val()) {
                    message.push({
                        type: 'required',
                        message: 'Password is required',
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
