<!--
=========================================================
* Soft UI Dashboard PRO - v1.0.9
=========================================================

* Product Page:  https://www.creative-tim.com/product/soft-ui-dashboard-pro
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Form - Talents Apartment
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.9" rel="stylesheet" />
    
    {{-- <script src="../assets/js/plugins/sweetalert.min.js"></script> --}}
    <script src="{{ asset('/assets/js/plugins/sweetalert.min.js') }}"></script>
</head>

<body class="">
    <div class="d-none">
        @if ($message = session('success'))
            {{ $message }}
            <script>
                //  Swal.fire('Success!', '{{ $message }}', 'success' );
                 Swal.fire("Success", "{{ $message }}", "success");
            </script>
        @endif
    
    
        @if ($message = session('error'))
            {{ $message }}
            <script>
                Swal.fire("Error", "{{ $message }}", "error");
            </script>
        @endif
    
    
        @if ($message = session('warning'))
            {{ $message }}
            <script>
                Swal.fire("Warning", "{{ $message }}", "warning");
            </script>
        @endif
    
    
        @if ($message = session('info'))
            {{ $message }}
            <script>
                Swal.fire("Info", "{{ $message }}", "info");
            </script>
        @endif
    </div>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
<!-- Navbar -->
  
<nav
class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
<div class="container-fluid">
    <a class="navbar-brand font-weight-bolder ms-sm-3"
        href="/" rel="tooltip"
        title="" data-placement="bottom" target="_blank">
        <img src="/logo-transparent.png" class="navbar-brand-img h-100 rounded " alt="main_logo" style="width: 100px;">
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-toggle="collapse"
        data-target="#navigation" aria-controls="navigation" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
        </span>
    </button>
    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0" id="navigation">
        <ul class="navbar-nav navbar-nav-hover ms-lg-5 ps-lg-5 w-100">
            <li class="nav-item dropdown dropdown-hover mx-2">
                <a Href="/" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    Home
                </a>

            </li>
            <li class="nav-item dropdown dropdown-hover mx-2">
                <a Href="/#rooms" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    Rooms
                </a>

            </li>
            <li class="nav-item dropdown dropdown-hover mx-2">
                <a Href="/#features" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    Features
                </a>

            </li>
            <li class="nav-item dropdown dropdown-hover mx-2">
                <a Href="/#contact" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    Contact
                </a>

            </li>
                
           
           
            <li class="nav-item ms-lg-auto my-auto ms-3 ms-lg-0">
                <a href="/login"
                class="btn btn-sm bg-gradient-info  btn-round mb-0 me-1 mt-2 mt-md-0">Login</a>
        
                <a href="https://api.whatsapp.com/send/?phone=2348069578636&text&type=phone_number&app_absent=0"
                class="btn btn-sm bg-gradient-success  btn-round mb-0 me-1 mt-2 mt-md-0">WhatsApp</a>
                
                
               <a data-toggle="modal" data-target="#call-me-back"
                class="btn btn-sm  bg-gradient-dark  btn-round mb-0 me-1 mt-2 mt-md-0">Call Me Back</a>
            </li>

        </ul>
    </div>
</div>
</nav>
<!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain mt-7">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Make Registration Form Payment
                                        </h4>
                                    <p class="mb-0 text-sm">
                                        Select payment form below and check your email for further instruction
                                    </p>
                                    <p class="mb-0 text-sm">
                                        To start your Application Process we require you pay a form fee for Registration.
                                    </p>
                                </div>

                                <div class="card-body">
                                    <div class="">

                                        <div id="pay_with_card"
                                            class="card bg-gradient-primary card-background-mask-primary">
                                            {{-- <div class="cursor-pointer"> --}}
                                            {{-- <div class="full-background"
                                    style="background-image: url('../../../assets/img/curved-images/curved1.jpg')">
                                </div> --}}
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <h5 class="text-white font-weight-bolder mb-0">
                                                                Online Payment
                                                            </h5>
                                                            <p id="online_online_payment_text"
                                                                class="text-white text-sm mb-0 opacity-7">
                                                                {{-- Pay using your Debit Card (master card, visa, verse, etc..) --}}
                                                                <span class="">Online Payment Not Available</span>, <br> USE BANK TRANSFER BELOW
                                                                </p>

                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-md">
                                                            <img class="w-60 mt-2"
                                                                src="../assets/img/logos/mastercard.png" alt="logo">
                                                        </div>
                                                    </div>
                                                </div>
                                                <form role="form" id="buyForm">
                                                    <input id="_token" type="hidden"
                                                        value="{{csrf_token()}}">
                                                        <input id="transaction_id" type="hidden"
                                                        value="{{ $applicant->transaction_id }}">
                                                    <input id="phone_number" type="hidden"
                                                        value="{{ $applicant->phone_number }}">
                                                    <input id="email" type="hidden"
                                                        value="{{ $applicant->email }}">
                                                    <input id="full_name" type="hidden"
                                                        value="{{ $applicant->full_name }}">
                                                    <input id="application_no" type="hidden"
                                                        value="{{ $applicant->application_no }}">
                                                    <input id="amount" type="hidden"
                                                        value="{{ $applicant->amount }}">
                                                    <div id="online_online_payment_button"
                                                        class="mt-3 d-flex bg-gray-100 border-radius-lg p-3">
                                                        <h4 class="my-auto">
                                                            <span
                                                                class="text-secondary text-sm me-1">N</span>{{ number_format($applicant->amount) }}</span>
                                                        </h4>
                                                        <button class="btn btn-outline-dark mb-0 ms-auto" type="submit"
                                                            {{-- onclick="payWithPaystack()" --}}

                                                            onclick="payWithPaystackDeactivated()"
                                                            
                                                            >
                                                            Pay Now
                                                        </button>
                                                        {{-- <a href="javascript:;" class="btn btn-outline-dark mb-0 ms-auto">Apply</a> --}}
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        <div id="pay_with_transfer" class="card bg-gradient-primary mt-4">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <h5 class="text-white font-weight-bolder mb-0">
                                                                Bank Transfer
                                                            </h5>
                                                            <p class="text-white text-sm mb-0 opacity-7">Transfer Cash
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-md">
                                                            <i class="ni ni-check-bold text-dark text-lg opacity-10"
                                                                aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="pay_with_transfer_text" class="d-none mt-3">
                                                    <p class="text-xs text-white mb-0 opacity-7 font-weight-bold">
                                                      Please attach form number to payment description during payment</span>  
                                                    </p>
                                                    <p class="text-xs text-white mt-3 mb-0">
                                                       <span class="font-weight-bolder mb-0">Form Number: </span>
                                                       <span class="opacity-7 mb-0">{{ $applicant->application_no }}</span>        
                                                    </p>
                                                    {{-- <span
                                                        class="text-white text-sm mb-0 mt-3 font-weight-bolder"
                                                        >
                                                        Click Here for Instructions </span> --}}
                                                   
                                                    <button class="btn btn-white p-2 mb-0 mt-3"
                                                        type="button" data-toggle="modal" data-target="#bank_transfer_instructions">
                                                        Intructions
                                                    </button>
                                                    <button class="btn btn-outline-white p-2 mb-0 mt-3" data-toggle="modal" data-target="#direct_payment_confirm"
                                                        type="button">
                                                        Continue?
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="pay_with_transfer" class="card bg-gradient-primary mt-4">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <h5 class="text-white font-weight-bolder mb-0">
                                                                Direct Payment
                                                            </h5>
                                                            <a href="" class="text-white text-sm mb-0 opacity-7" data-toggle="modal" data-target="#direct_pay_instructions">
                                                                Click Here for Instructions 
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-md">
                                                            <i class="ni ni-diamond text-dark text-lg opacity-10"
                                                                aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div
                                class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
                                <img src="../assets/img/shapes/pattern-lines.svg" alt="pattern-lines"
                                    class="position-absolute opacity-4 start-0">
                                <div class="position-relative">
                                    <img class="max-width-500 w-100 position-relative z-index-2"
                                        src="../assets/img/illustrations/chat.png" alt="chat-img">
                                </div>
                                
                                <h4 class="mt-5 text-white font-weight-bolder">"Attention is the new currency"</h4>
                                <p class="text-white">The more effortless the writing looks, the more effort the writer
                                    actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bank Transfer Instructions Model -->
            <div class="modal fade" id="bank_transfer_instructions" tabindex="-1" role="dialog"
                aria-labelledby="bank_transfer_instructions" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bank Transfer</h5>
                            <button type="button" class="btn-close text-dark" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-3">
                            <h6 class="mb-2 font-weight-bolder">Step 1</h6>
                            <p class=" text-sm mb-0 font-weight-bolder">Transfer full amount of N{{ number_format($applicant->amount) }} to the account belo</p>
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <p class="text-xs  font-weight-bold mb-0">Amount:</p>
                                    <h6 class="text-sm  opacity-7 bmb-0">N{{ number_format($applicant->amount) }}
                                    </h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-xs   font-weight-bold mb-0">Bank:</p>
                                    <h6 class="text-sm  opacity-7 bmb-0">
                                        {{ DB::table('settings')->value('bank_name') }}</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-xs  font-weight-bold mb-0">Account Name:</p>
                                    <h6 class="text-sm  opacity-7 bmb-0">
                                        {{ DB::table('settings')->value('business_name') }}</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-xs  font-weight-bold mb-0">Accoun Number:</p>
                                    <h6 class="text-sm  opacity-7 bmb-0">
                                        {{ DB::table('settings')->value('bank_account') }}</h6>
                                </div>
                            </div>
                            
                            <p class=" text-sm mb-0 opacity-7">Write Form Number {{ $applicant->application_no }} in The Reference Portion</p>
                            <h6 class="my-2 font-weight-bolder">Step 2</h6>
                            


                            <p class=" text-sm mb-0">Come back to the Bank Transfer Portion</p>
                            <p class=" text-sm mb-2">Select <b>Continue</b> and add the following information</p>
                            <p class=" text-sm mb-0"><span class="text-dark font-weight-bolder">Bank Transaction ID</span> (from the bank transfer transaction)</p>
                            <p class=" text-sm mb-0"><span class="text-dark font-weight-bolder">Sender Name</span>  (from the transaction)</p>
                            <p class=" text-sm mb-0"><span class="text-dark font-weight-bolder">Bank Name</span> (bank the transfer originated from)</p>
    
                            <h6 class="my-2 font-weight-bolder">Step 3</h6>
                            <p class=" text-sm mb-0">Checck your email and especially your junk email for further information.</p>
                            <p class=" text-sm text-info mb-0">(After office hours transfer may take longer)</p>
                            
                                <a href="https://api.whatsapp.com/send?phone={{ DB::table('settings')->value('whatsapp_number') }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success mt-3">
                                    <i class="fab fa-whatsapp"></i>
                                    <span class="btn-inner--text">CLick here to contact Us on WhatsApp</span>
                                </a>
                                
                        </div>
                       
                    </div>
                </div>
            </div>

            <!-- Direct Pay Instructions Model -->
            <div class="modal fade" id="direct_pay_instructions" tabindex="-1" role="dialog"
                aria-labelledby="direct_pay_instructions" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Direct Payment</h5>
                            <button type="button" class="btn-close text-dark" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-3">
                            <p class=" text-sm mb-0 font-weight-bolder">To make Direct Payment Go to Our Office</p>
                            <p class=" text-sm mb-0 opacity-7">Meet and contact our sales maanager to assist in registration</p>
                            <p class=" text-sm mb-0 opacity-7">On confirmation a message will be sent to your email address to complete registration</p>

                                <p class="text-xs text-bold mt-3 text-primary mb-0 opacity-7 font-weight-bold">
                                    Please note your form number as our sales manager might ask of it</span>  
                                  </p>
                                <p class="text-xs mt-3 mb-3 font-weight-bolder ">
                                    <span class="font-weight-bolder mb-0">Form Number: </span>
                                    <span class="opacity-7 mb-0">{{ $applicant->application_no }}</span>        
                                 </p>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Direct Payment Model -->
            <div class="modal fade" id="direct_payment_confirm" tabindex="-1" role="dialog"
                aria-labelledby="direct_payment_confirm" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm Your Payment</h5>
                            <button type="button" class="btn-close text-dark" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-3">
                            <p class=" text-sm mb-0 font-weight-bolder">To confirm your payment please fill the form and submit</p>
                            {{-- <form role="form" id="buyForm" action="/confirm_payment">
                                @csrf
                                <div class="">
                                    <label>Transaction ID</label>
                                    <input class="form-control" type="hidden" value="bank_transfer" name="type">
                                    <input class="form-control" type="hidden" value="{{ $applicant->application_no }}" name="application_no">
                                  
                                    <input class="form-control" type="text" placeholder="eg. TRNS56UK6QGG" onfocus="focused(this)" onfocusout="defocused(this)" name="reference">
                                  </div>
                            <div class="button-row d-flex mt-4">
                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Next">Confrim Transaction</button>
                              </div>

                            </form> --}}
                            <form role="form" id="buyForm" action="/send_payment_info" method="POST">
                                @csrf
                                {{-- <input class="form-control" type="hidden" value="bank_transfer" name="type"> --}}
                                    <input class="form-control" type="hidden" value="{{ $applicant->application_no }}" name="application_no">
                                  
                                <div class="">
                                    <label>Bank Transaction ID</label>
                                    <input class="form-control" type="text" name="bank_transaction_id">
                                    
                                    <label>Sender Name</label>
                                    <input class="form-control" type="text" name="sender_name">
                                    
                                    <label>Bank Name</label>
                                    <input class="form-control" type="text" name="bank_name">
                                  
                                </div>
                            <div class="button-row d-flex mt-4">
                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Next">Send Details</button>
                              </div>

                            </form>

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
        
<div class="modal fade" id="call-me-back">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Call Me Back</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
              </div>
            <form class="form-horizontal" method="POST" action="/call-me-back"
                enctype="multipart/form-data">
                {{ csrf_field() }}
  
                <div class="modal-body contact-form">
  
  
  <p>Complete the form and we will call you back!</p>
  {{-- <div class="row text-center py-3 mt-3">
    <div class="col-4 mx-auto">
     <input type="text" class="form-control" name="name" placeholder="Enter Your Name" data-error="Name is required." required="required">
                        <div class="help-block with-errors"></div>
    </div>
  </div> --}}
  
    
                    <div class="single-form form-group mt-3">
                        <input type="text" class="form-control"  name="name" placeholder="Enter Your Name" data-error="Name is required." required="required">
                        <div class="help-block with-errors"></div>
                    </div>
  
                    <div class="single-form form-group mt-3">
                        <input type="email" class="form-control"  name="email" placeholder="Email" data-error="Name is required." required="required">
                        <div class="help-block with-errors"></div>
                    </div>
  
                    <div class="single-form form-group mt-3">
                        <input type="tel" class="form-control"  name="phone" placeholder="Phone" data-error="Name is required." required="required">
                        <div class="help-block with-errors"></div>
                    </div>
  
                    <div class="single-form form-group">
                        <button class="btn btn-sm  bg-gradient-info  btn-round mb-0 me-1 mt-2 mt-md-0" type="submit">Call Me Back</button>
                        <button type="button" class="btn btn-sm bg-gradient-dark btn-round mb-0 me-1 mt-2 mt-md-0" data-dismiss="modal">Close</button>
      
                    </div>
                </div>
                {{-- <div class="modal-footer justify-content-between">
  
                    <div class="single-form form-group">
                        <button class="main-btn" type="submit">Call Me Back</button>
                    </div>
                </div> --}}
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
      <div class="container">
        <div class="row">
  
        </div>
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              {{ config('app.name', 'Laravel') }}
              ©
              <script>
                  document.write(new Date().getFullYear())
              </script>,
              made with ❤️ by
              <a href="http://alresia.com" class="font-weight-bold" target="_blank">Alresia Inc</a>
          </p>
          </div>
        </div>
      </div>
    </footer>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    {{-- <script src="../dashboard-assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="../dashboard-assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="../dashboard-assets/js/plugins/perfect-scrollbar.min.js"></script> --}}



    {{-- <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script> --}}
    <!-- Kanban scripts -->
    <script src="../assets/js/plugins/dragula/dragula.min.js"></script>
    <script src="../assets/js/plugins/jkanban/jkanban.js"></script>
    <!-- Payment scripts -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="../assets/js/payment-process.js"></script>
    <script src="../assets/js/plugins/sweetalert.min.js"></script>

    <script src="../assets/js/sweetalert.min.js"></script>

    <script>
         function payWithPaystackDeactivated() {
                const requiredButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn bg-gradient-success',
                                cancelButton: 'btn bg-gradient-danger',
                                closeButton: 'btn bg-gradient-primary'
                            },
                            buttonsStyling: false,
                        })
                        requiredButtons.fire({
                            title: 'Something went wrong!',
                            text: 'Sorry this option is not available right now',
                            icon: 'error',
                            showCloseButton: true,
                        })
            }
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script>
        // Limit user from selecting more than one amenities
        $(document).ready(function() {


           


            $('#pay_with_card').hover(
                function() {
                    // alert('wo')
                    $('#online_online_payment_button').removeClass('d-none');
                    // $('#online_online_payment_text').removeClass('d-none').text(
                    //     'Pay using your Debit Card (master card, visa, verse, etc..)'
                    //     )
                    $('#online_online_payment_text').removeClass('d-none').html(
                        '<span class="">Online Payment Not Available</span>, <br> USE BANK TRANSFER BELOW'
                        )
                        $('#pay_with_transfer_text').addClass('d-none');
                },
                function() {
                    // $('#online_online_payment_button').addClass('d-none');
                    // $('#online_online_payment_text').text('Pay using your Card...')

                });

                $('#pay_with_transfer').hover(
                function() {
                    $('#online_online_payment_button').addClass('d-none');
                    $('#online_online_payment_text').text('Pay using your Card...')
                    $('#pay_with_transfer_text').removeClass('d-none');
                    // $('#online_online_payment_text').removeClass('d-none').text(
                    //     'Pay using your Debit Card (master card, visa, verse, etc..)')
                },
                function() {
                    // $('#pay_with_transfer_text').addClass('d-none');
                    // $('#online_online_payment_text').text('Pay using your Card...')

                });

            $('#online_online_payment_button').click(
                function() {
                    // alert('wo')
                    $('#online_online_payment_button').removeClass('d-none');
                    // $('#online_online_payment_text').removeClass('d-none').text(
                    //     'Pay using your Debit Card (master card, visa, verse, etc..)')
                    $('#online_online_payment_text').removeClass('d-none').text(
                        '<span class="">Online Payment Not Available</span>, <br> USE BANK TRANSFER BELOW')
                });


        });
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.9"></script>
</body>

</html>
