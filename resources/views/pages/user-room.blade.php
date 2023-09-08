@extends('layouts.main')
@section('page-title', 'Rent Details')
@section('content')

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header d-flex pb-0 p-3">
                    <h6 class="my-auto">{{ $room->name ?? '' }}</h6>
                    <div class="nav-wrapper position-relative ms-auto w-50">
                        
                    </div>
                    <div class="dropdown pt-2">
                        <a href="javascript:;" class="text-secondary ps-4" id="dropdownCam" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        
                    </div>
                </div>
                <div class="card-body p-3 mt-2">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade position-relative height-400 border-radius-lg active show" id="cam1"
                            role="tabpanel" aria-labelledby="cam1"
                            style="background-image: url('{{ $room->photo ?? '' }}'); background-size:cover;">
                            <div class="position-absolute d-flex top-0 w-100">
                                <p class="text-white p-3 mb-0">{{ \Carbon\Carbon::now()->format('j M, Y h:m:sa')}}</p>
                                <div class="ms-auto p-3">
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-dot-circle text-danger"></i>
                                        {{ $current_rent->status ?? '' }}
                                        </span>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>

            
        </div>
        <div class="col-xl-6 ms-auto mt-xl-0 mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-gradient-primary">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8 my-auto">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold opacity-7" style="color: white;">
                                            Room Details</p>
                                        <h5 class="font-weight-bolder mb-0" style="color: white;">
                                          {{ $bed_space->building_name }}, {{ $bed_space->room_label }}
                                        </h5>
                                        <p style="color: white;">
                                          {{ $bed_space->room_number }}, {{ $bed_space->room->name }}, {{ $bed_space->name }}
                                        </p>
                                       
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    {{-- <img class="w-50" src="../../assets/img/small-logos/icon-sun-cloud.png"
                                        alt="image sun"> --}}
                                    {{-- <h5 class="mb-0 text-white text-end me-1">Cloudy</h5> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="text-gradient text-danger"><span id="status1" countto="">{{ \Carbon\Carbon::parse($current_rent->move_in)->format('j')}}</span> <span
                                        class="text-lg ms-n2">{{ \Carbon\Carbon::parse($current_rent->move_in)->format('M')}}</span></h1>
                                <h6 class="mb-0 font-weight-bolder">{{ \Carbon\Carbon::parse($current_rent->move_in)->format('Y')}}</h6>
                                <p class="opacity-8 mb-0 text-sm">Move in date</p>
                                  
                                </h5>
                                
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            @if (!empty(DB::table('rents')->where('id',  $user->current_rent)->value('expiring_date')) && DB::table('rents')->where('id',  $user->current_rent)->value('expiring_date') < \Carbon\Carbon::now())
                                <h3 class="text-gradient text-danger p-2">Expired</h3>
                                <h6 class="mb-0 font-weight-bolder">{{\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse(DB::table('rents')->where('id',  $user->current_rent)->value('expiring_date')))}} day(s) Ago</h6>
                                <p class="opacity-8 mb-0 text-sm">Rent has expired </p>
                                  
                                </h5>
                                @elseif (!empty(DB::table('rents')->where('id',  $user->current_rent)->value('expiring_date')) && DB::table('rents')->where('id',  $user->current_rent)->value('status') == 'Approved'  && DB::table('rents')->where('id',  $user->current_rent)->value('expiring_date') > \Carbon\Carbon::now())
                                <h1 class="text-gradient text-primary"><span id="status1" countto="{{\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse(DB::table('rents')->where('id',  $user->current_rent)->value('expiring_date')))}}">{{\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse(DB::table('rents')->where('id',  $user->current_rent)->value('expiring_date')))}}</span> <span
                                    class="text-lg ms-n2">Day(s)</span></h1>
                            <h6 class="mb-0 font-weight-bolder">Remaining</h6>
                            <p class="opacity-8 mb-0 text-sm">to expiration date</p>
                                @else
                                <h3 class="text-gradient text-info p-2"> {{ DB::table('rents')->where('id',  $user->current_rent)->value('status') }}</h3>
                            
                                @endif
                            
                        </div>
                    </div>
                </div>                
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="text-gradient text-primary"><span id="status3" countto="87">{{ $current_rent->price ? number_format($current_rent->price) : '' }}</span> <span
                                    class="text-lg ms-n2">N</span></h1>
                            <h6 class="mb-0 font-weight-bolder">Price</h6>
                            <p class="opacity-8 mb-0 text-sm">Annually</p>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>

    <div class="row mt-4">
<div class="col-sm-4">
  
    <div class="card blur shadow-blur">
        <div class="card-header pb-0 p-3">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Amenities</h6>
            <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom">
              <i class="fas fa-info"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row">
            
            <div class="col-12">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <tbody>
                      @php
                          $room = DB::table('rooms')->where('id', $bed_space->room_id)->first();
                      @endphp
                      
                      
                        @if (!empty($room->amenity1))
                        <tr>
                        <td>
                          <div class="d-flex px-2 py-0">
                            <span class="badge bg-gradient-primary me-3"> </span>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ DB::table('amenities')->where('id', $room->amenity1)->value('name') }}</h6>
                            </div>
                          </div>
                        </td>
                      </tr>
                        @endif
                        
                      
                     
                      
                        @if (!empty($room->amenity2))
                        <tr>
                        <td>
                            <div class="d-flex px-2 py-0">
                              <span class="badge bg-gradient-secondary me-3"> </span>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ DB::table('amenities')->where('id', $room->amenity2)->value('name') }}</h6>
                              </div>
                            </div>
                          </td>
                        </tr>
                          @endif
                     
                      
                     
                      
                        @if (!empty($room->amenity3))
                        <tr>
                        <td>
                          <div class="d-flex px-2 py-0">
                            <span class="badge bg-gradient-danger me-3"> </span>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ DB::table('amenities')->where('id', $room->amenity3)->value('name') }}</h6>
                            </div>
                          </div>
                        </td>
                      </tr>
                        @endif
                        @if (!empty($room->amenity4))
                        <tr>
                        <td>
                            <div class="d-flex px-2 py-0">
                              <span class="badge bg-gradient-warning me-3"> </span>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ DB::table('amenities')->where('id', $room->amenity4)->value('name') }}</h6>
                              </div>
                            </div>
                          </td>
                        </tr>
                          @endif
                     
                        @if (!empty($room->amenity5))
                        <tr>
                        <td>
                          <div class="d-flex px-2 py-0">
                            <span class="badge bg-gradient-primary me-3"> </span>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ DB::table('amenities')->where('id', $room->amenity5)->value('name') }}</h6>
                            </div>
                          </div>
                        </td>
                        </tr>
                        @endif
                        @if (!empty($room->amenity6))
                        <tr>
                        <td>
                            <div class="d-flex px-2 py-0">
                              <span class="badge bg-gradient-secondary me-3"> </span>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ DB::table('amenities')->where('id', $room->amenity6)->value('name') }}</h6>
                              </div>
                            </div>
                          </td>
                        </tr>
                          @endif
                      
                     
                        @if (!empty($room->amenity7))
                        <tr>
                        <td>
                          <div class="d-flex px-2 py-0">
                            <span class="badge bg-gradient-primary me-3"> </span>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ DB::table('amenities')->where('id', $room->amenity7)->value('name') }}</h6>
                            </div>
                          </div>
                        </td>
                        </tr>
                        @endif
                        @if (!empty($room->amenity8))
                        <tr>
                        <td>
                            <div class="d-flex px-2 py-0">
                              <span class="badge bg-gradient-secondary me-3"> </span>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ DB::table('amenities')->where('id', $room->amenity8)->value('name') }}</h6>
                              </div>
                            </div>
                          </td>
                        </tr>
                          @endif
                      
                     
                        @if (!empty($room->amenity9))
                        <tr>
                        <td>
                          <div class="d-flex px-2 py-0">
                            <span class="badge bg-gradient-warning me-3"> </span>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ DB::table('amenities')->where('id', $room->amenity9)->value('name') }}</h6>
                            </div>
                          </div>
                        </td>
                        </tr>
                        @endif
                        @if (!empty($room->amenity10))
                        <tr>
                        <td>
                            <div class="d-flex px-2 py-0">
                              <span class="badge bg-gradient-secondary me-3"> </span>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ DB::table('amenities')->where('id', $room->amenity10)->value('name') }}</h6>
                              </div>
                            </div>
                          </td>
                        </tr>
                          @endif
                      
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card blur shadow-blur mt-4">
        
        <div class="card-body p-3">
          <ul class="list-group">
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
              <div class="d-flex align-items-center">
                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                  <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="mt-1">
                    <title>spaceship</title>
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                        <g transform="translate(1716.000000, 291.000000)">
                          <g transform="translate(4.000000, 301.000000)">
                            <path d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"></path>
                            <path d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"></path>
                            <path d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z" opacity="0.598539807"></path>
                            <path d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z" opacity="0.598539807"></path>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">Agreement</h6>
                  {{-- <span class="text-xs">250 in stock, <span class="font-weight-bold">346+ sold</span></span> --}}
                </div>
              </div>
              <div class="d-flex">
                <a class="btn btn-link btn-rounded btn-sm text-dark  my-auto" href="/agreement.pdf">view <i class="ni ni-bold-right" aria-hidden="true"></i></a>
              </div>
            </li>
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
              <div class="d-flex align-items-center">
                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                  <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="mt-1">
                    <title>box-3d-50</title>
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                        <g transform="translate(1716.000000, 291.000000)">
                          <g transform="translate(603.000000, 0.000000)">
                            <path d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z"></path>
                            <path d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
                            <path d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">Code of Conduct</h6>
                  {{-- <span class="text-xs">123 closed, <span class="font-weight-bold">15 open</span></span> --}}
                </div>
              </div>
              <div class="d-flex">
                <a class="btn btn-link btn-rounded btn-sm text-dark  my-auto" href="/code_of_conduct.pdf">view <i class="ni ni-bold-right" aria-hidden="true"></i></a>
              </div>
            </li>
           
          </ul>
        </div>
      </div>
</div>
<div class="col-sm-5">
    <div class="row">
        <div class="col-md-8 me-auto text-left">
          <h5>Room Mates</h5>
          <p>Here are list of your room mates.</p>
        </div>
      </div>
    @if (DB::table('bed_spaces')->where('room_number', $bed_space->room_number)->where('room_id', $bed_space->room_id)->whereNotNull('user_id')->where('allocated', true)->where('user_id', '!=', Auth::id())->first())
        
    
   
    <div class="row mt-1">
        @foreach (DB::table('bed_spaces')->where('room_number', $bed_space->room_number)->where('room_id', $bed_space->room_id)->whereNotNull('user_id')->where('allocated', true)->where('user_id', '!=', Auth::id())->get() as $room_mate_bed )
        <div class="col-md-12 col-lg-6">
            <div class="card">
                
                <div class="card-body p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                      <div class="avatar me-3">
                        <img src="{{ DB::table('users')->where('id', $room_mate_bed->user_id)->value('photo')  ?? '../assets/img/no-image.png' }}" alt="kal" class="border-radius-lg shadow">
                      </div>
                      <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ DB::table('users')->where('id', $room_mate_bed->user_id)->value('first_name') }}
                            {{ DB::table('users')->where('id', $room_mate_bed->user_id)->value('middle_name') }}
                            {{ DB::table('users')->where('id', $room_mate_bed->user_id)->value('last_name') }}.</h6>
                        <p class="mb-0 text-xs">Email: {{ DB::table('users')->where('id', $room_mate_bed->user_id)->value('email') }}.</p>
                        <p class="mb-0 text-xs">phone: {{ DB::table('users')->where('id', $room_mate_bed->user_id)->value('phone_number') }}.</p>
                      </div>
                      {{-- <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a> --}}
                    </li>
                    
                  </ul>
                </div>
              </div>
        </div>
        @endforeach
        
        
    </div>
    @else
    <p>No room mate yet.</p>
    @endif

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
    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();
        });
    </script>
@endsection
