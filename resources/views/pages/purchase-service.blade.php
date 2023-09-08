@extends('layouts.main')
@section('page-title', 'Products')
@if (Auth::user()->role == 'student')
    {{-- Stay --}}
@else
    {{ Session::flash('error', 'You are not permited to view that page') }}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@section('content')

    <div class="row mt-3">
        {{-- <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count($bedspaces) }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Allocated</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $allocated }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Free Bed</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $freespace }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Rooms</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::allRooms()) }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Bedspace</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ DB::table('bed_spaces')->get()->count() }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-sm-8 mt-4 m-auto mt-lg-0">
            <div class="card" id="payment_box"
            data-application_no="{{ $invoice->application_no }}">
                <div class="card-header p-3 pb-0">
                    <h3 class="mb-3">Payment for {{$service->name}}</h3 class="mb-3">
                </div>
                <div class="card-body p-3 pt-1">
                    <p>{{$service->description}}</p>
                    <h5 class="text-center">Choose a method of payment</h5>
                    <div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" 
                        {{-- id="pay_via_online" --}}
                        onclick="payWithPaystackDeactivated()"
                        >
                            <div class="d-flex border border-warning rounded">
                                <div class="avatar avatar-lg">
                                    <img alt="Image placeholder" src="{{ asset('assets/img/logos/mastercard.png') }}">
                                </div>
                                <div class="ms-2 my-auto">


                                    <span class="mb-0" style="color:black">Pay Online</span>
                                    <p class="text-xs mb-0">Mastercard, Verve, Visa, etc</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"  data-toggle="modal" data-target="#direct_payment_confirm">
                            <div class="d-flex border border-dark bg-white rounded">
                                <div class="avatar avatar-lg">
                                    <img alt="Image placeholder" src="{{ asset('assets/img/small-logos/icon-bulb.svg') }}"
                                        height="45">
                                </div>
                                <div class="ms-2 my-auto">
                                    <span class="mb-0" style="color:black">Bank Transfer</span>
                                    <p class="text-xs mb-0">Transfer from your account or bank
                                        branch</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex bg-gray-100 border-radius-lg p-3 my-3">

                        <div>
                            <h6 class="my-auto">

                                <span class="text-secondary text-sm me-1">Invoice No:</span>{{ $invoice->application_no }}

                            </h6>
                            <h4 class="my-auto">
                                <span class="text-secondary text-sm me-1">₦</span>{{ number_format($invoice->amount) }}

                            </h4>
                            <span class="text-secondary text-sm ms-1">Pay using your Debit Card
                                (master card, visa, verse, etc..) or Payment via bank
                                transfer</span>

                        </div>


                    </div>

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
            
            <form role="form" id="buyForm" action="/send_payment_info" method="POST">
                @csrf
                {{-- <input class="form-control" type="hidden" value="bank_transfer" name="type"> --}}
                    <input class="form-control" type="hidden" value="{{ $invoice->application_no }}" name="application_no">
                  
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

@endsection
@section('script')
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="{{asset('/assets/js/services-payment-process.js')}}"></script>
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
            
        // Limit user from selecting more than one amenities
        $(document).ready(function() {
            // $("#updateProduct").click(function() {
            //     alert('ghhgjbj')
            //     // $("#updateProductModel").modal("show")
            // });

            $("#updateProduct").on('click', function() {
                alert('ghhgjbj')
                // $("#updateProductModel").modal("show")
            });

            $('#bed-space').DataTable({
                "paging": true,
                "pagingType": "full_numbers",
                "language": {
                    "paginate": {
                        "previous": "‹",
                        "first": "«",
                        "next": "›",
                        "last": "»",
                    }
                },
                "retrieve": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                "responsive": false,
                "buttons": {
                    "buttons": ["csv", "excel", "pdf", "print"],
                    "dom": {
                        "container": {
                            "tag": "div",
                            "className": "text-end align-items-right"
                        },
                        "collection": {
                            "tag": "div",
                            "className": ""
                        },
                        "button": {
                            "tag": "button",
                            "className": "btn btn-sm bg-gradient-primary",
                            "active": "active",
                            "disabled": "disabled"
                        },

                    }
                },
                "info": false,


            }).buttons().container().appendTo('#bed-space-data');

        });
    </script>
@endsection
