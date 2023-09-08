@extends('layouts.main')
@section('page-title', 'Payment #'.$billing->payment_reference)
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'accountant'  || Auth::user()->role == 'staff')
{{-- Stay --}}
@else
{{ Session::flash('error','You are not permited to view that page') }}
<script>
  window.location.href = "{{ url('/dashboard') }}";
</script>
@endif
@section('content')
    <div class="row pb-5">

        <div class="col-sm-9 mt-4">
            <div class="card">
              <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Payment Information</h6>
              </div>
              <div class="card-body pt-4 p-3">
                <ul class="list-group">
                  <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="mb-3 text-sm">Customer Details</h6>
                      <span class="mb-2 text-xs">Full Name: <span class="text-dark font-weight-bold ms-sm-2"> &nbsp;
                        {{ DB::table('users')->where('id', $billing->user_id)->value('first_name') }}
                        {{ DB::table('users')->where('id', $billing->user_id)->value('middle_name') }}
                        {{ DB::table('users')->where('id', $billing->user_id)->value('last_name') }}</span></span>
                      <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">{{ DB::table('users')->where('id', $billing->user_id)->value('email') }}</span></span>
                      <span class="text-xs">Phone Number: <span class="text-dark ms-sm-2 font-weight-bold">{{ DB::table('users')->where('id', $billing->user_id)->value('phone_number') }}</span></span>
                    </div>

                  </li>
                  <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="mb-3 text-sm">Payment</h6>
                      <span class="mb-2 text-xs">Price: <span class="text-dark font-weight-bold ms-sm-2">{{ App\Helper\Helper::currency(DB::table('rooms')->where('id', $billing->room_id)->value('price')) }}</span></span>
                      <span class="mb-2 text-xs">Reference: <span class="text-dark font-weight-bold ms-sm-2">{{ $billing->payment_reference }}</span></span>
                      <span class="mb-2 text-xs">Status: <span class="text-dark font-weight-bold ms-sm-2">{{$billing->proof_status }}</span></span>
                      <span class="mb-2 text-xs">Payment Date: <span class="text-dark ms-sm-2 font-weight-bold">{{ \Carbon\Carbon::parse($billing->updated_at)->format('j M, Y')  }}</span></span>
                      <span class="text-xs">Validity: <span class="text-dark ms-sm-2 font-weight-bold">1  year [@if($billing->expiring_date)
                       <span class="text-primary">{{\Carbon\Carbon::now()->diffInMonths(\Carbon\Carbon::parse($billing->expiring_date))}} month(s) left</span> ]
                        @endif
                          </span></span>
                    </div>

                  </li>
                  <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="mb-3 text-sm">Room</h6>
                      <span class="mb-2 text-xs">Name: <span class="text-dark font-weight-bold ms-sm-2">{{ DB::table('rooms')->where('id', $billing->room_id)->value('name') }} - {{ DB::table('bed_spaces')->where('id', $billing->bed_space)->value('room_number') }}</span></span>
                      <span class="mb-2 text-xs">Bed space: <span class="text-dark ms-sm-2 font-weight-bold">{{ DB::table('bed_spaces')->where('id', $billing->bed_space)->value('name') }}</span></span>
                      {{-- <span class="text-xs">M: <span class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span> --}}
                    </div>

                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-5 d-none">
            <div class="card h-100 mb-4">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">Other Transaction's</h6>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <i class="far fa-calendar-alt me-2"></i>
                            <small></small>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">From Newest</h6>
                    <ul class="list-group">
                        @foreach (DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->orderBy('updated_at', 'DESC')->get()
            as $finance)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">

                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="fas fa-arrow-down"></i></button>
                                            <a href="/financial/{{$finance->id}}">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">
                                            {{ DB::table('users')->where('id', $finance->user_id)->value('first_name') }}
                                            {{ DB::table('users')->where('id', $finance->user_id)->value('middle_name') }}
                                            {{ DB::table('users')->where('id', $finance->user_id)->value('last_name') }}
                                            ({{ DB::table('rooms')->where('id', $finance->room_id)->value('name') }})</h6>
                                        <span
                                            class="text-xs">{{ \Carbon\Carbon::parse($finance->updated_at)->format('j M h:i A') }}</span>
                                    </div>
                                    </a>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{ App\Helper\Helper::currency($finance->price) }}
                                </div>
                            </li>
                        @endforeach


                </div>
            </div>
        </div>

    </div>
@endsection
