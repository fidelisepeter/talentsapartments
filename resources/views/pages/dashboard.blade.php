@extends('layouts.main')
@section('page-title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6">
      <div class="card bg-gradient-primary">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 opacity-7"  style="color: white">Bookings</p>
                <h5 class="font-weight-bolder mb-0"  style="color: white">
                    {{ DB::table('rents')->where('year', $viewingYear)->where('status', '!=', 'Approved')->count() }} 
                    @php
                        $new_booking = DB::table('rents')->where('year', $viewingYear)->where('status', '!=', 'Approved')->whereNull('school_check_status')->whereBetween('updated_at', [\Carbon\Carbon::now()->subDays(7), \Carbon\Carbon::now()])->count();
                    @endphp
                    @if ($new_booking != 0)
                    <span class="opacity-2">/</span><span class="opacity-5 text-sm font-weight-bolder">{{ $new_booking }} new</span>
                    @endif
                   
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                <i class="ni ni-cart text-dark text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card bg-gradient-primary mt-4">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 opacity-7"  style="color: white">Residents</p>
                <h5 class="font-weight-bolder mb-0" style="color: white">
                    {{ App\Models\BedSpace::whereNotNull('user_id')->where('year', $viewingYear)->get()->count(); }}
                    @php
                        $new_resident = App\Models\BedSpace::whereNotNull('user_id')->whereBetween('updated_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->where('year', $viewingYear)->get()->count();
                    @endphp
                    @if ($new_resident != 0)
                    <span class="opacity-2">/</span><span class="opacity-5 text-sm font-weight-bolder">{{ $new_resident }} this week</span>
                    @endif
                    
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                <i class="fa fa-users text-dark text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
      <div class="card overflow-hidden">
        <div class="card-header p-3">
          <p class="text-sm mb-0 text-capitalize font-weight-bold">Income</p>
          <h5 class="font-weight-bolder mb-0" id="income">
            N0
            <span class="text-success text-sm font-weight-bolder"></span>
          </h5>
        </div>
        <div class="card-body p-0">
          <div class="chart">
            <canvas id="chart-widgets-2" class="chart-canvas" height="200" width="500" style="display: block; box-sizing: border-box; height: 100px; width: 250.3px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mt-lg-0 mt-4 ">
      <div class="card overflow-hidden">
        <div class="card-header p-3 pb-0">
          <div class="d-flex align-items-center">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
            </div>
            <div class="ms-3">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Rent</p>
              <h5 class="font-weight-bolder mb-0" id="rent_total">
                0
              </h5>
            </div>
            {{-- <div class="progress-wrapper ms-auto w-25">
              <div class="progress-info">
                <div class="progress-percentage">
                  <span class="text-xs font-weight-bold">60%</span>
                </div>
              </div>
              <div class="progress">
                <div class="progress-bar bg-gradient-primary w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div> --}}
          </div>
        </div>
        <div class="card-body mt-3 p-0">
          <div class="chart">
            <canvas id="chart-line-widgets" class="chart-canvas" height="100"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-7 col-md-12">
      <div class="card">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Income channels</h6>
          <div class="d-flex align-items-center">
            <span class="badge badge-md badge-dot me-4">
              <i style="background: #cb0c9f"></i>
              <span class="text-dark text-xs" id="sum_rent">Rent</span>
            </span>
            <span class="badge badge-md badge-dot me-4">
              <i style="background: #3A416F"></i>
              <span class="text-dark text-xs" id="sum_registration">Registration Form</span>
            </span>
            <span class="badge badge-md badge-dot me-4">
              <i style="background: #17c1e8"></i>
              <span class="text-dark text-xs" id="sum_others">Others</span>
            </span>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="600" width="1167" style="display: block; box-sizing: border-box; height: 300px; width: 583.9px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5 col-md-12 mt-4 mt-lg-0">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Room Types</h6>
            <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom">
              <i class="fas fa-info"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-5 col-12 text-center">
              <div class="chart mt-5">
                <canvas id="chart-doughnut" class="chart-canvas" height="400" width="306" style="display: block; box-sizing: border-box; height: 200px; width: 153.1px;"></canvas>
              </div>
              <a href="/room-types" class="btn btn-sm bg-gradient-secondary mt-4">See all</a>
            </div>
            <div class="col-lg-7 col-12">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <tbody>
                    @foreach (DB::table('rooms')->where('year', $viewingYear)->get() as $room_type)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{ $room_type->photo }}" class="avatar avatar-sm me-2" alt="logo_jira">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $room_type->name }}</h6> 
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold d-lg-none"> 
                          
                          {{ DB::table('bed_spaces')->where('room_id', $room_type->id)->where('year', $viewingYear)->whereNotNull('user_id')->where('allocated', true)->get()->count() }} </span>
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4 ">
    <div class="col-sm-4 mb-4 mb-lg-0">
      <div class="card">
          <div class="card-body p-3 pb-0 pt-3">
              <div class="row">
                  <div class="col-8">
                      <div class="numbers">
                          <p class="text-sm mb-0 text-capitalize font-weight-bold mb-1">Bookings </p>
                          <div class="row mx-0">
                            <div class="col-6 ps-0">
                              <div class="d-flex">
                                <p class="text-xs opacity-5 mb-0 font-weight-bold">Pending</p>
                              </div>
                              <h6 class="font-weight-bolder">{{ DB::table('rents')->where('year', $viewingYear)->where('status', 'pending')->count() }} </h6>
                              
                            </div>
                            <div class="col-6 ps-0">
                              <div class="d-flex">
                                <p class="text-xs opacity-5 mb-0 font-weight-bold">Reject</p>
                              </div>
                              <h6 class="font-weight-bolder">{{ DB::table('rents')->where('year', $viewingYear)->where('status', '==', 'Reject')->count() }} </h6>
                              
                            </div>
                            
                          </div>
                      </div>
                  </div>
                  <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                          <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="col-sm-4 mb-4 mb-lg-0">
      <div class="card">
          <div class="card-body p-3 pb-0 pt-3">
              <div class="row">
                  <div class="col-8">
                      <div class="numbers">
                          <p class="text-sm mb-0 text-capitalize font-weight-bold mb-1">Upkeep Notifications  </p>
                          <div class="row mx-0">
                            <div class="col-4 ps-0">
                              <div class="d-flex">
                                <p class="text-xs opacity-5 mb-0 font-weight-bold">New</p>
                              </div>
                              <h6 class="font-weight-bolder"> {{ DB::table('complaints')->where('year', $viewingYear)->whereBetween('created_at', [\Carbon\Carbon::now()->subDays(7), \Carbon\Carbon::now()])->where('status', 'pending')->count() }}</h6>
                              
                            </div>
                            <div class="col-4 ps-0">
                              <div class="d-flex">
                                <p class="text-xs opacity-5 mb-0 font-weight-bold">Pending</p>
                              </div>
                              <h6 class="font-weight-bolder">{{ DB::table('complaints')->where('year', $viewingYear)->where('status', 'pending')->count() }} </h6>
                              
                            </div>
                            <div class="col-4 ps-0">
                              <div class="d-flex">
                                <p class="text-xs opacity-5 mb-0 font-weight-bold">Completed</p>
                              </div>
                              <h6 class="font-weight-bolder"> {{ DB::table('complaints')->where('year', $viewingYear)->where('status', 'completed')->count() }} </h6>
                              
                            </div>
                            
                          </div>
                      </div>
                  </div>
                  <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                          <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                  </div>
              </div>
          </div>  
      </div>
    </div>
    <div class="col-sm-4 mb-4 mb-lg-0">
      <div class="card">
          <div class="card-body p-3 pb-0 pt-3">
              <div class="row">
                  <div class="col-8">
                      <div class="numbers">
                          <p class="text-sm mb-0 text-capitalize font-weight-bold mb-1">Registration</p>
                          <div class="row mx-0">
                            <div class="col-4 ps-0">
                              <div class="d-flex">
                                <p class="text-xs opacity-5 mb-0 font-weight-bold">Payment </p>
                              </div>
                              @php
                              $count = 0;
                                foreach (DB::table('rents')->whereNotNull('payment_reference')->where('status', '!=', 'Approved')->where('year', $viewingYear)->get() as $rent_paid){
                                  $payment_status = DB::table('invoices')->where('application_no', $rent_paid->payment_reference)->value('payment_status');
                                  if($payment_status == 'paid'){
                                    $count++;
                                  }
                                }

                                $payment_done = $count;
                             
                              @endphp
                              
                              <h6 class="font-weight-bolder"> {{ $payment_done }}</h6>
                              
                            </div>
                            <div class="col-4 ps-0">
                              <div class="d-flex">
                                <p class="text-xs opacity-5 mb-0 font-weight-bold">Gurantor </p>
                              </div>
                              <h6 class="font-weight-bolder">{{ DB::table('rents')->whereNotNull('payment_reference')->whereNotNull('guarantor_letter_photo')->where('status', '!=', 'Approved')->where('year', $viewingYear)->count() }} </h6>
                              
                            </div>
                            <div class="col-4 ps-0">
                              <div class="d-flex">
                                <p class="text-xs opacity-5 mb-0 font-weight-bold">Others</p>
                              </div>
                              <h6 class="font-weight-bolder"> {{ DB::table('rents')->whereNotNull('payment_reference')->whereNotNull('guarantor_letter_photo')->whereNotNull('health_check_photo')->whereNotNull('attestation_letter_photo')->where('status', '!=', 'Approved')->where('year', $viewingYear)->count() }} </h6>
                              
                            </div>
                            
                          </div>
                      </div>
                  </div>
                  <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                          <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                  </div>
              </div>
          </div>  
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-4 col-sm-12">
      <div class="card">
        <div class="card-header p-3 pb-0">
          <h6 class="mb-0">Notifiactions</h6>
          @php
              $sn = 0;
          @endphp
          {{-- <p class="text-sm mb-0 text-capitalize font-weight-bold">Joined</p> --}}
        </div>
        <div class="card-body border-radius-lg p-3">
            @foreach (DB::table('notifications')->where('year', $viewingYear)->orderBy('id', 'DESC')->limit(3)->get()
            as $notification)
            @php
                $sn++;
            @endphp
          <div class="d-flex @if ($sn != 1) mt-4 @endif">
            <div>
              <div class="icon icon-shape bg-info-soft shadow text-center border-radius-md shadow-none">
                <i class="ni ni-bell-55 text-lg text-primary text-gradient opacity-10" aria-hidden="true"></i>
              </div>
            </div>
            <div class="ms-3">
              <div class="numbers">
                <h6 class="mb-1 text-dark text-sm">{{ $notification->title }} </h6>
                <span class="text-sm">{{ $notification->created_by }},
                    {{ $notification->message }}  </span> <br>
                    <small class="text-xxs">{{ \Carbon\Carbon::parse($notification->created_at)->format('j M h:i A') }}</small>
              </div>
            </div>
          </div>
          @endforeach
          <div class="text-center mt-1">
            <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto text-center" href="/notifications">View all notifications</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-sm-12  mt-lg-0 mt-4">
        <div class="row">
            <div class="col-sm-6 mt-md-0">
                <div class="row">
                  <div class="col-sm-6  mb-4 mb-lg-0">
                    <div class="card">
                      <div class="card-header mx-4 p-3 text-center">
                        <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                          <i class="fas fa-landmark opacity-10"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-3 text-center">
                        <h6 class="text-center mb-0"> {{ count(\App\Helpers\Rooms::allRooms()) }} Rooms</h6>
                        
                        <span class="text-dark text-xxs opacity-7">{{ count(\App\Helpers\Rooms::roomsAvalaible()) }} Available | {{ count(\App\Helpers\Rooms::roomsTaken()) }} Taken
                        </span>
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">@php
                            $sum = 0;
                        @endphp
                        @foreach (DB::table('rooms')->get() as $room_type)
                        @php
                        $sum += $room_type->price * DB::table('bed_spaces')->where('room_id', $room_type->id)->where('year', $viewingYear)->get()->count()
                        @endphp
                        @endforeach
                        ₦{{ number_format($sum) }}</h5>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6  mb-4 mb-lg-0">
                    <div class="card">
                      <div class="card-header mx-4 p-3 text-center">
                        <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                          <i class="fab fa-paypal opacity-10"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-3 text-center">
                        <h6 class="text-center mb-0">{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->count() }} Rents</h6>
                        <span class="text-xxs">Expired {{ count(\App\Helpers\Rooms::expired()) }} </span>
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0"> ₦{{ number_format(DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->sum('price')) }}</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 mt-lg-0">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body p-3 pb-0 pt-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Bed Spaces</p>
                                            <div class="row mx-0">
                                              <div class="col-4 ps-0">
                                                <div class="d-flex">
                                                  <p class="text-xs opacity-5 mb-0 font-weight-bold">Avalaible</p>
                                                </div>
                                                <h6 class="font-weight-bolder">{{DB::table('bed_spaces')->where('year', $viewingYear)->get()->count()}}</h6>
                                                
                                              </div>
                                              <div class="col-4 ps-0">
                                                <div class="d-flex">
                                                  <p class="text-xs opacity-5 mb-0 font-weight-bold">Taken</p>
                                                </div>
                                                <h6 class="font-weight-bolder">{{DB::table('bed_spaces')->whereNotNull('user_id')->where('allocated', true)->where('year', $viewingYear)->get()->count()}}</h6>
                                                
                                              </div>
                                              
                                              <div class="col-4 ps-0">
                                                <div class="d-flex">
                                                  <p class="text-xs opacity-5 mb-0 font-weight-bold">Empty</p>
                                                </div>
                                                <h6 class="font-weight-bolder">{{DB::table('bed_spaces')->whereNull('user_id')->where('allocated', false)->where('year', $viewingYear)->get()->count()}}</h6>
                                                
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <hr class="bg-primary">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-4">
                        <div class="card">
                            <div class="card-body p-3 pb-0 pt-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Rents expiring in </p>
                                            <h5 class="font-weight-bolder mb-0">
                                              <div class="row mx-0">
                                              <div class="col-4 ps-0">
                                                <div class="d-flex">
                                                  <p class="text-xs opacity-5 mb-0 font-weight-bold">65 days</p>
                                                </div>
                                                <h6 class="font-weight-bolder">{{ count(\App\Helpers\Rooms::expiredInDays(65)); }}</h6>
                                                
                                              </div>
                                              <div class="col-4 ps-0">
                                                <div class="d-flex">
                                                  <p class="text-xs opacity-5 mb-0 font-weight-bold">30 days</p>
                                                </div>
                                                <h6 class="font-weight-bolder">{{ count(\App\Helpers\Rooms::expiredInDays(30)); }}</h6>
                                                
                                              </div>
                                              
                                              <div class="col-4 ps-0">
                                                <div class="d-flex">
                                                  <p class="text-xs opacity-5 mb-0 font-weight-bold">7 days</p>
                                                </div>
                                                <h6 class="font-weight-bolder">{{ count(\App\Helpers\Rooms::expiredInDays(7)); }}</h6>
                                                
                                              </div>
                                            </div>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                            <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <hr class="bg-primary">
                            </div>
                        </div>
                    </div>
                </div>
              </div>          
       
            <div class="col-sm-12 mt-4 col-md-12">
                <div class="card overflow-lg-none">
                    <div class="card-header p-3 pb-0">
                        <h6 class="mb-0">Residents ({{ App\Models\BedSpace::whereNotNull('user_id')->where('year', $viewingYear)->count()}})</h6>
                        
                      </div>
                  <div class="card-body overflow-scroll  d-flex">
                    <div class="col-sm-3  col-md-2 text-center">
                        <a href="/residents" class="avatar avatar-lg border-1 rounded-circle bg-gradient-primary">
                          <i class="fas fa-eye " style="color: white"></i>
                        </a>
                        <p class="mb-0 text-sm" style="margin-top:6px;">View All</p>
                      </div>
                      @foreach (App\Models\BedSpace::whereNotNull('user_id')->where('year', $viewingYear)->get() as $resident)
                      <div class="col-sm-3  col-md-2 text-center">
                        <a href="/resident/{{ $resident->user->id }}" class="avatar avatar-lg rounded-circle border border-secondary">
                            <img alt="Image placeholder" class="p-1" src="{{ $resident->user->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}">
                          </a>
                          <p class="mb-0 text-sm">{{ $resident->user->first_name }}
                            {{ $resident->user->middle_name }}
                            {{ $resident->user->last_name }}</p>
                      </div>
                      @endforeach
                    
                   
                    
                  </div>
                </div>
              </div>
        </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-4">
      <div class="card widget-calendar">
        <!-- Card header -->
        <div class="card-header p-3 pb-0">
          <h6 class="mb-0">Recent Bookings</h6>
          
        </div>
        <!-- Card body -->
        <div class="card-body p-3">
            
            <ul class="list-group">
                @foreach (DB::table('rents')->where('year', $viewingYear)->orderBy('updated_at', 'desc')->limit(3)->get()
  as $booking)
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">
                        {{ DB::table('users')->where('id', $booking->user_id)->value('first_name') }}
                        {{ DB::table('users')->where('id', $booking->user_id)->value('middle_name') }}
                        {{ DB::table('users')->where('id', $booking->user_id)->value('last_name') }}
                    </h6>
                    <span class="mb-2 text-xs">Room Type: <span class="text-dark font-weight-bold ms-sm-2">{{ DB::table('rooms')->where('id', $booking->room_id)->value('name') }}</span></span>
                    <span class="mb-2 text-xs">Price: <span class="text-dark ms-sm-2 font-weight-bold">₦{{ number_format($booking->price) }}</span></span>
                    <span class="text-xs">Date Booked: <span class="text-dark ms-sm-2 font-weight-bold">{{ \Carbon\Carbon::parse($booking->updated_at)->format('j M h:i A') }}</span></span>
                  </div>
                  {{-- <div class="ms-auto text-end">
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                    <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div> --}}
                </li>
                @endforeach
              </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mt-lg-0 mt-4">
      <div class="card">
        <div class="card-header pb-0">
          <h6 class="mb-0">Complians & Tasks</h6>
        </div>
        <div class="card-body pt-0">
            <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                        <button
                            class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                class="fas fa-exclamation"></i></button>
                        <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Total Complians</h6>
                            <span class="text-xs">Count of complians submitted by users</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-dark text-sm font-weight-bold">
                        {{ DB::table('complaints')->where('year', $viewingYear)->count() }}
                    </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                        <button
                            class="btn btn-icon-only btn-rounded btn-outline-warning mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-up"></i></button>
                        <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Total Assigned</h6>
                            <span class="text-xs">Amount of Tasks Assigned</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-warning text-gradient text-sm font-weight-bold">
                        {{ DB::table('tasks')->where('year', $viewingYear)->count() }}
                    </div>
                </li>
            </ul>
            <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Status</h6>
            <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                        <button
                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-up"></i></button>
                        <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Tasks Completed</h6>
                            <span class="text-xs">Total Complians solved by admins</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                        {{ DB::table('tasks')->where('year', $viewingYear)->where('status', 'completed')->count() }}
                    </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                        <button
                            class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-up"></i></button>
                        <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Tasks Pending</h6>
                            <span class="text-xs">Total Complians not yet solved</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                        {{ DB::table('tasks')->where('year', $viewingYear)->where('status', '!=', 'completed')->count() }}
                    </div>
                </li>

            
          </ul>
        </div>
      </div>
      <div class="card mt-3">
        <div class="card-body border-radius-lg bg-gradient-dark p-3">
          {{-- <h6 class="mb-0 text-white">
            Questions about security?
          </h6> --}}
          <p class="text-sm mb-4" style="color: white">
            To see all complaintt click the button bellow
          </p>
          <a href="/complaints" class="btn bg-gradient-light mb-0"> Compiants</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mt-lg-0 mt-4">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6>Orders overview</h6>
          <small class="text-xxl opacity-7">{{DB::table('invoices')->whereBetween('updated_at', [\Carbon\Carbon::now()->startOfMonth(), \Carbon\Carbon::now()->endOfMonth()])->where('year', $viewingYear)->count()}} this month
        </small>
          <a class="text-sm text-primary font-weight-bold" href="/invoices"> SEE ALL</a>
          {{-- <p class="text-sm">
            <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
            <span class="font-weight-bold">24%</span> this month
          </p> --}}
        </div>
        <div class="card-body p-3">
          <div class="timeline timeline-one-side">
            @foreach (DB::table('invoices')->where('year', $viewingYear)->orderBy('created_at', 'desc')->limit(5)->get()
            as $invoice)
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            @if ($invoice->type == 'Registration Form')
                                            <i class="ni ni-cart text-info text-gradient"></i>
                                            @elseif ($invoice->type == 'Rent Booking')
                                            <i class="ni ni-credit-card text-warning text-gradient"></i>
                                            @else
                                            <i class="ni ni-key-25 text-primary text-gradient"></i>
                                            @endif
                                            
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">
                                                {{ $invoice->full_name }},
                                                applied for
                                                {{ $invoice->type }}
                                            </h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ \Carbon\Carbon::parse($invoice->updated_at)->format('j M h:i A') }}</p>
                                        </div>
                                    </div>
                                @endforeach
          
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-sm-7 mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Rents expiring in the next 3 Months</h6>

                    </div>

                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Users</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Room</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Moved in</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Due Date</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (DB::table('rents')->where('year', $viewingYear)->whereBetween('expiring_date', [\Carbon\Carbon::now(), \Carbon\Carbon::now()->addMonth(3)])->get() as $rent)
                                <tr>
                                    <td>
                                        <h6 class="text-xs font-weight-bold">
                                            {{ DB::table('users')->where('id', $rent->user_id)->value('first_name') }},
                                            {{ DB::table('users')->where('id', $rent->user_id)->value('middle_name') }},

                                            {{ DB::table('users')->where('id', $rent->user_id)->value('last_name') }},

                                        </h6>
                                    </td>
                                    <td>
                                        <h6 class="text-xs font-weight-bold">
                                            {{ DB::table('rooms')->where('id', $rent->room_id)->value('name') }}
                                        </h6>
                                    </td>
                                    <td>
                                        <h6 class="text-xs font-weight-bold">
                                            {{ \Carbon\Carbon::parse($rent->move_in)->format('j M h:i A') }}</h6>
                                    </td>
                                    <td class="text-sm">
                                        <span
                                            class="text-xs font-weight-bold">{{ \Carbon\Carbon::parse($rent->expiring_date)->format('j M h:i A') }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span
                                            class="text-xs font-weight-bold">{{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($rent->expiring_date)) }}
                                            day(s) left</span>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5 mt-lg-0 mt-4">
        <div class="card bg-transparent shadow-xl">
          <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('../../assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark"></span>
            <div class="card-body position-relative z-index-1 p-3"  style="color: white">
              <i class="fas fa-wifi  p-2"  style="color: white"></i> Business Details
              <h5 class=" mt-4 mb-5 pb-2"  style="color: white">{{ DB::table('settings')->value('business_name') }}</h5>
              <div class="d-flex">
                <div class="d-flex">
                  <div class="me-4">
                    <p class=" text-sm opacity-8 mb-0"  style="color: white">Bank Name</p>
                    <h6 class=" mb-0"  style="color: white">{{ DB::table('settings')->value('bank_name') }}</h6>
                  </div>
                  <div>
                    <p class=" text-sm opacity-8 mb-0"  style="color: white">Account No</p>
                    <h6 class=" mb-0"  style="color: white">{{ DB::table('settings')->value('bank_account') }}</h6>
                  </div>
                </div>
                <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                  <img class="w-60 mt-2" src="../../assets/img/logos/mastercard.png" alt="logo">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
  </div>
  
@endsection
@section('script')
<script src="../assets/js/plugins/chartjs.min.js"></script>
<script>
    
    const get_sum = function(array) {
        let sum = 0;
        array.forEach(element => {
            sum += Number(element);
        });
        return sum;
    }
    const percentage_growth = function(original, value) {
        let difference = original-value;
        percentageGrowth = difference/original*100;
        return percentageGrowth.toFixed();
    }

    const increased_percentage_growth = function(original, value) {
        let difference = value-original;
        percentageGrowth = difference/original*100;
       
        return percentageGrowth.toFixed(1);
    }

    const decreased_percentage_growth = function(original, value) {
        let difference = original-value;
        percentageGrowth = difference/original*100;
       
        return percentageGrowth.toFixed(1);
    }

    const getdate = new Date();
    const currentMonth = getdate.getMonth();
    const lastMonth = (currentMonth-1);

    var income_lables = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    
    var TotalIncomeJan = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '01')->where('year', $viewingYear)->sum('amount') }}";
    var TotalIncomeFeb = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '02')->where('year', $viewingYear)->sum('amount') }}";
    var TotalIncomeMar = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '03')->where('year', $viewingYear)->sum('amount') }}";
    var TotalIncomeApr = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '04')->where('year', $viewingYear)->sum('amount') }}";
    var TotalIncomeMay = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '05')->where('year', $viewingYear)->sum('amount') }}";
    var TotalIncomeJun = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '06')->where('year', $viewingYear)->sum('amount') }}";
    var TotalIncomeJul = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '07')->where('year', $viewingYear)->sum('amount') }}";
    var TotalIncomeAug = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '08')->where('year', $viewingYear)->sum('amount') }}";
    var TotalIncomeSep = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '09')->where('year', $viewingYear)->sum('amount') }}";
    var TotalIncomeOct = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '10')->where('year', $viewingYear)->sum('amount') }}";
    var TotalIncomeNov = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '11')->where('year', $viewingYear)->sum('amount') }}";
    var TotalIncomeDec = "{{ DB::table('invoices')->where('status', 'successful')->whereMonth('updated_at', '12')->where('year', $viewingYear)->sum('amount') }}";
    
    var RegFormIncomeJan = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '01')->where('year', $viewingYear)->sum('amount') }}";
    var RegFormIncomeFeb = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '02')->where('year', $viewingYear)->sum('amount') }}";
    var RegFormIncomeMar = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '03')->where('year', $viewingYear)->sum('amount') }}";
    var RegFormIncomeApr = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '04')->where('year', $viewingYear)->sum('amount') }}";
    var RegFormIncomeMay = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '05')->where('year', $viewingYear)->sum('amount') }}";
    var RegFormIncomeJun = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '06')->where('year', $viewingYear)->sum('amount') }}";
    var RegFormIncomeJul = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '07')->where('year', $viewingYear)->sum('amount') }}";
    var RegFormIncomeAug = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '08')->where('year', $viewingYear)->sum('amount') }}";
    var RegFormIncomeSep = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '09')->where('year', $viewingYear)->sum('amount') }}";
    var RegFormIncomeOct = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '10')->where('year', $viewingYear)->sum('amount') }}";
    var RegFormIncomeNov = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '11')->where('year', $viewingYear)->sum('amount') }}";
    var RegFormIncomeDec = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Registration Form')->whereMonth('updated_at', '12')->where('year', $viewingYear)->sum('amount') }}";
    

    var RentIncomeJan = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '01')->where('year', $viewingYear)->sum('amount') }}";
    var RentIncomeFeb = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '02')->where('year', $viewingYear)->sum('amount') }}";
    var RentIncomeMar = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '03')->where('year', $viewingYear)->sum('amount') }}";
    var RentIncomeApr = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '04')->where('year', $viewingYear)->sum('amount') }}";
    var RentIncomeMay = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '05')->where('year', $viewingYear)->sum('amount') }}";
    var RentIncomeJun = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '06')->where('year', $viewingYear)->sum('amount') }}";
    var RentIncomeJul = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '07')->where('year', $viewingYear)->sum('amount') }}";
    var RentIncomeAug = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '08')->where('year', $viewingYear)->sum('amount') }}";
    var RentIncomeSep = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '09')->where('year', $viewingYear)->sum('amount') }}";
    var RentIncomeOct = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '10')->where('year', $viewingYear)->sum('amount') }}";
    var RentIncomeNov = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '11')->where('year', $viewingYear)->sum('amount') }}";
    var RentIncomeDec = "{{ DB::table('invoices')->where('status', 'successful')->where('type', 'Rent Booking')->whereMonth('updated_at', '12')->where('year', $viewingYear)->sum('amount') }}";
    
    var OtherIncomeJan = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '01')->where('year', $viewingYear)->sum('amount') }}";
    var OtherIncomeFeb = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '02')->where('year', $viewingYear)->sum('amount') }}";
    var OtherIncomeMar = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '03')->where('year', $viewingYear)->sum('amount') }}";
    var OtherIncomeApr = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '04')->where('year', $viewingYear)->sum('amount') }}";
    var OtherIncomeMay = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '05')->where('year', $viewingYear)->sum('amount') }}";
    var OtherIncomeJun = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '06')->where('year', $viewingYear)->sum('amount') }}";
    var OtherIncomeJul = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '07')->where('year', $viewingYear)->sum('amount') }}";
    var OtherIncomeAug = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '08')->where('year', $viewingYear)->sum('amount') }}";
    var OtherIncomeSep = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '09')->where('year', $viewingYear)->sum('amount') }}";
    var OtherIncomeOct = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '10')->where('year', $viewingYear)->sum('amount') }}";
    var OtherIncomeNov = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '11')->where('year', $viewingYear)->sum('amount') }}";
    var OtherIncomeDec = "{{ DB::table('invoices')->where('status', 'successful')->where('type', '!=', 'Rent Booking')->where('type', '!=', 'Registration Form')->whereMonth('updated_at', '12')->where('year', $viewingYear)->sum('amount') }}";
    
    var income_data_total = [TotalIncomeJan, TotalIncomeFeb, TotalIncomeMar, TotalIncomeApr, TotalIncomeMay, TotalIncomeJun, TotalIncomeJul, TotalIncomeAug, TotalIncomeSep, TotalIncomeOct, TotalIncomeNov, TotalIncomeDec];
    var income_data_others = [OtherIncomeJan, OtherIncomeFeb, OtherIncomeMar, OtherIncomeApr, OtherIncomeMay, OtherIncomeJun, OtherIncomeJul, OtherIncomeAug, OtherIncomeSep, OtherIncomeOct, OtherIncomeNov, OtherIncomeDec];   
    var income_data_rent = [RentIncomeJan, RentIncomeFeb, RentIncomeMar, RentIncomeApr, RentIncomeMay, RentIncomeJun, RentIncomeJul, RentIncomeAug, RentIncomeSep, RentIncomeOct, RentIncomeNov, RentIncomeDec];
    var income_data_reg_form = [RegFormIncomeJan, RegFormIncomeFeb, RegFormIncomeMar, RegFormIncomeApr, RegFormIncomeMay, RegFormIncomeJun, RegFormIncomeJul, RegFormIncomeAug, RegFormIncomeSep, RegFormIncomeOct, RegFormIncomeNov, RegFormIncomeDec];
    
    // income_data_others[2] = 67888;
    // income_data_others[4] = 88766;
    // income_data_others[9] = 67888;
    // income_data_others[11] = 88766;

    // income_data_rent[1] = 91736;
    // income_data_rent[5] = 28475;
    // income_data_rent[6] = 10944;
    // income_data_rent[8] = 64484;


    // income_data_reg_form[7] = 10384;
    // income_data_reg_form[12] = 63338;
    // income_data_reg_form[1] = 22662;
    // income_data_reg_form[4] = 64484;

    var income_sum_total = get_sum(income_data_total);
    var income_sum_reg_form = get_sum(income_data_reg_form);
    var income_sum_rent = get_sum(income_data_rent);
    var income_sum_others = get_sum(income_data_others);
    // alert(income_data_total);
    // income_sum = get_sum(income_data_reg_form)+get_sum(income_data_rent)+get_sum(income_data_other);
   
    var sumRent = document.getElementById("sum_rent");
    var sumRegistration = document.getElementById("sum_registration");
    var sumOther = document.getElementById("sum_others");
    sumRent.innerHTML = 'Rent (₦'+income_sum_rent.toLocaleString('en-GB')+')';
    sumRegistration.innerHTML = 'Reg Form (₦'+income_sum_reg_form.toLocaleString('en-GB')+')';
    sumOther.innerHTML = 'Others (₦'+income_sum_others.toLocaleString('en-GB')+')';

    var income_status = document.getElementById("income");
    if(income_data_total[lastMonth] > income_data_total[currentMonth]){
        income_status.innerHTML = '₦'+income_sum_total.toLocaleString('en-GB')+'<span class="text-danger text-sm font-weight-bolder"><i class="ni ni-bold-down text-sm ms-1 mt-1"></i></span>';
    }else{
        income_status.innerHTML = '₦'+income_sum_total.toLocaleString('en-GB')+'<span class="text-success text-sm font-weight-bolder"><i class="ni ni-bold-up text-sm ms-1 mt-1"></i></span>';
    }

    var income = document.getElementById("chart-widgets-2").getContext("2d");

    var gradientStroke__INCOME_1 = income.createLinearGradient(0, 230, 0, 50);
    var gradientStroke__INCOME_2 = income.createLinearGradient(0, 230, 0, 50);
    var gradientStroke__INCOME_3 = income.createLinearGradient(0, 230, 0, 50);

    gradientStroke__INCOME_1.addColorStop(1, 'rgba(37,47,64,0.05)');
    gradientStroke__INCOME_1.addColorStop(0.2, 'rgba(37,47,64,0.0)');
    gradientStroke__INCOME_1.addColorStop(0, 'rgba(37,47,64,0)'); //purple colors

    var gradientStroke2 = income.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(37,47,64,0.05)');
    gradientStroke2.addColorStop(0.2, 'rgba(37,47,64,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(37,47,64,0)'); //purple colors

    
    new Chart(income, {
      type: "line",
      data: {
        labels: income_lables,
        datasets: [{
          label: "Income",
          tension: 0.5,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#252f40",
          borderWidth: 2,
          backgroundColor: gradientStroke2,
          data: income_data_total,
          maxBarThickness: 6,
          fill: true
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
        },
      },
    });
        

        var ctx1 = document.getElementById("chart-line").getContext("2d");
    var ctx2 = document.getElementById("chart-doughnut").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    // Line chart
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: income_lables,
        datasets: [{
            label: "Rent",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 2,
            pointBackgroundColor: "#cb0c9f",
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            data: income_data_rent,
            maxBarThickness: 6
          },
          {
            label: "Registration Form",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 2,
            pointBackgroundColor: "#3A416F",
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            data: income_data_reg_form,
            maxBarThickness: 6
          },
          {
            label: "Others",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 2,
            pointBackgroundColor: "#17c1e8",
            borderColor: "#17c1e8",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            data: income_data_others,
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#9ca2b7'
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: true,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#9ca2b7',
              padding: 10
            }
          },
        },
      },
    });


@php
  $room_count = [];
  $color = [];
  $names = [];
    $roomTypes = DB::table('rooms')->where('year', $viewingYear)->get();
  foreach($roomTypes as $type){

                    
    $room_count[] = DB::table('bed_spaces')->where('room_id', $type->id)->where('year', $viewingYear)->whereNotNull('user_id')->where('allocated', true)->get()->count();
    $color[] = '#'.substr(md5(rand()), 0, 6);
    $names[] = $type->name;
  }

  

@endphp




var roomTypesLables = '<?php echo json_encode($names) ?>';
var roomData = '<?php echo json_encode($room_count) ?>';
var roomTypesColors = '<?php echo json_encode($color) ?>';


// var roomTypes = '<?php echo json_encode($roomTypes) ?>';
roomTypesLables = eval(roomTypesLables);
roomTypeData = eval(roomData);
roomTypesColors = eval(roomTypesColors);

    // roomTypes = eval(roomTypes);
    // alert(JSON.stringify(roomTypesLables));

    // Doughnut chart
    new Chart(ctx2, {
      type: "doughnut",
      data: {
        labels: roomTypesLables,
        datasets: [{
          label: "Rooms",
          weight: 9,
          cutout: 60,
          tension: 0.9,
          pointRadius: 2,
          borderWidth: 2,
          // backgroundColor: ['#2152ff', '#3A416F', '#f53939', '#a8b8d8', '#cb0c9f'],
          backgroundColor: roomTypesColors,
          data: roomTypeData,
          fill: false
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false,
            }
          },
        },
      },
    });

  


    var totalRentJan = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '01')->where('year', $viewingYear)->count() }}";
    var totalRentFeb = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '02')->where('year', $viewingYear)->count() }}";
    var totalRentMar = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '03')->where('year', $viewingYear)->count() }}";
    var totalRentApr = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '04')->where('year', $viewingYear)->count() }}";
    var totalRentMay = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '05')->where('year', $viewingYear)->count() }}";
    var totalRentJun = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '06')->where('year', $viewingYear)->count() }}";
    var totalRentJul = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '07')->where('year', $viewingYear)->count() }}";
    var totalRentAug = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '08')->where('year', $viewingYear)->count() }}";
    var totalRentSep = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '09')->where('year', $viewingYear)->count() }}";
    var totalRentOct = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '10')->where('year', $viewingYear)->count() }}";
    var totalRentNov = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '11')->where('year', $viewingYear)->count() }}";
    var totalRentDec = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '12')->where('year', $viewingYear)->count() }}";
    var rent_lables = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var rent_data = [totalRentJan, totalRentFeb, totalRentMar, totalRentApr, totalRentMay, totalRentJun, totalRentJul, totalRentAug, totalRentSep, totalRentOct, totalRentNov, totalRentDec];
    
    rent_sum = get_sum(rent_data);
    var rent_total = document.getElementById("rent_total");
    rent_total.innerHTML = rent_sum;
   
    var rent = document.getElementById("chart-line-widgets").getContext("2d");
    var rentGradientStroke = ctx2.createLinearGradient(0, 230, 0, 50);

    rentGradientStroke.addColorStop(1, 'rgba(37,47,64,0.05)');
    rentGradientStroke.addColorStop(0.2, 'rgba(37,47,64,0.0)');
    rentGradientStroke.addColorStop(0, 'rgba(37,47,64,0)'); //purple colors

    new Chart(rent, {
      type: "line",
      data: {
        labels: rent_lables,
        datasets: [{
          label: "Tasks",
          tension: 0.3,
          pointRadius: 2,
          pointBackgroundColor: "#cb0c9f",
          borderColor: "#cb0c9f",
          borderWidth: 2,
          backgroundColor: rentGradientStroke,
          data: rent_data,
          maxBarThickness: 6,
          fill: true
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              color: '#252f40',
              padding: 10
            }
          },
        },
      },
    });
   
</script>


@endsection
