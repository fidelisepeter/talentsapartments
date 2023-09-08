@extends('layouts.main')
@section('page-title', $user->first_name)
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="row">

                <div class="col-md-3">
                    <div class="card">

                        <div class="card-body ">
                            <div class="text-center">
                                <div class="" data-toggle="modal" data-target="#update-profile" data-trigger="hover"
                                    data-toggle="popover" title="Change" data-content="Click to change profile picture">
                                    <img src="{{ auth()->user()->photo ?? '../assets/img/no-image.png' }}" style="width: 100px;"
                                        alt="profile_image" class=" border-radius-lg shadow-sm">
                                </div>
                                <hr class="horizontal  dark">
                                @if (\App\Models\BedSpace::where('id', DB::table('rents')->where('id',  Auth::user()->current_rent)->value('bed_space'))->first() && DB::table('rents')->where('id',  Auth::user()->current_rent)->value('status') == 'Approved')
                                <button type="button" class="w-100 btn btn-primary" data-toggle="modal"
                                    data-target="#update-profile">Update Photo</button>
                                    @endif
                            </div>




                        </div>
                    </div>


                    <div class="card my-3">
                        <div class="card-body p-3">
                            <div class="row">


                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="mb-0 text-capitalize font-weight-bold">Rent Status</p>
                                        @if (!empty(
                                            DB::table('rents')->where('id', $user->current_rent)->value('expiring_date')
                                        ) &&
                                            DB::table('rents')->where('id', $user->current_rent)->value('expiring_date') < \Carbon\Carbon::now())
                                            <h5 class="text-danger  font-weight-bolder mb-0">
                                                Expired
                                                <span class="text-dark text-sm opacity-6">
                                                    {{\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse(DB::table('rents')->where('id',  $user->current_rent)->value('expiring_date')))}} day(s) Ago</span>
                                            </h5>
                                        @elseif (DB::table('rents')->where('id', $user->current_rent)->value('status') == 'Approved')
                                            <h5 class="text-success  font-weight-bolder mb-0">
                                                Active
                                                <span class="text-dark text-sm opacity-6">
                                                    {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse(DB::table('rents')->where('id', $user->current_rent)->value('expiring_date'))) }}
                                                    day(s) left</span>
                                            </h5>
                                        @else
                                            <h5 class="text-warning  font-weight-bolder mb-0">
                                                {{ DB::table('rents')->where('id', $user->current_rent)->value('status') }}

                                            </h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    @if (!empty(
                                        DB::table('rents')->where('id', $user->current_rent)->value('expiring_date')
                                    ) &&
                                        DB::table('rents')->where('id', $user->current_rent)->value('expiring_date') < \Carbon\Carbon::now())
                                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    @elseif (DB::table('rents')->where('id', $user->current_rent)->value('status') == 'Approved')
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    @else
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-7 mb-2">
                    <div class="card bg-transparent shadow-xl">
                        <div class="overflow-hidden position-relative border-radius-xl"
                            style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                            <span class="mask bg-gradient-dark"></span>
                            <div class="card-body position-relative z-index-1">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="{{ $qrcode }}" alt="profile_image"
                                            class="w-100 border-radius-lg shadow-sm">
                                    </div>
                                    <div class="col-4">

                                        <div class="mb-2">
                                            <span
                                                class="text-sm text-white opacity-8 font-weight-bold opacity-8 mb-0">Name:</span>
                                            <span class=" font-weight-bold text-sm text-white mb-0">
                                                {{ auth()->user()->first_name }}
                                                {{ auth()->user()->middle_name }}
                                                {{ auth()->user()->last_name }}
                                            </span>

                                        </div>
                                        <div class="mb-2">
                                            <span class="text-sm text-white opacity-8 font-weight-bold mb-0">Email:</span>
                                            <span
                                                class=" font-weight-bold text-sm text-white mb-0">{{ auth()->user()->email }}</span>

                                        </div>
                                        <div class="mb-2">
                                            <span class="text-sm text-white opacity-8 font-weight-bold mb-0">Type:</span>
                                            <span class=" font-weight-bold text-sm text-white mb-0">@if (DB::table('bed_spaces')->where('user_id', $user->id)->value('user_id') == $user->id) Resident @else User @endif</span>

                                        </div>
                                        <div class="mb-2">
                                            <span class="text-sm text-white opacity-8 font-weight-bold mb-0">Student
                                                ID:</span>
                                            <span
                                                class=" font-weight-bold text-sm text-white mb-0">{{ auth()->user()->ta_uid ?? auth()->user()->id }}</span>

                                        </div>


                                    </div>

                                </div>
                                <hr class="horizontal light">
                                <div class="d-flex">
                                    <div class="me-4">
                                        <p class="text-white text-sm opacity-8 mb-0">Matric</p>
                                        <h6 class="text-white mb-0">{{ $user->matric_number }}</h6>
                                    </div>
                                    <div class="me-4">
                                        <p class="text-white text-sm opacity-8 mb-0">Phone</p>
                                        <h6 class="text-white mb-0">{{ $user->phone_number }}</h6>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-2 mb-4">
                    <div class="card bg-gradient-primary h-100">
                        <div class="card-body text-center">
                            <div class="d-flex mb-4 text-white">
                               TALENTs
                               <br>
                               Appartment
                            </div>
                            <svg width="45px" viewBox="0 0 41 31" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>Status</title>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="wifi" transform="translate(3.000000, 3.000000)">
                                        <path
                                            d="M7.37102658,14.6156105 C12.9664408,9.02476091 22.0335592,9.02476091 27.6289734,14.6156105"
                                            stroke="#FFFFFF" stroke-width="5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <circle fill="#FFFFFF" cx="17.5039082" cy="22.7484921" r="4.9082855"></circle>
                                        <path
                                            d="M0,7.24718945 C9.66583791,-2.41572982 25.3341621,-2.41572982 35,7.24718945"
                                            stroke="#FFFFFF" stroke-width="5" opacity="0.398982558"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg>
                            <p class="font-weight-bold mt-4 mb-0 text-white">Status</p>
                            <span class="text-xs text-white">Online</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- <div class="col-md-3 mb-4">
            
        </div> --}}
        @if (\App\Models\BedSpace::where('id', DB::table('rents')->where('id',  Auth::user()->current_rent)->value('bed_space'))->first() && DB::table('rents')->where('id',  Auth::user()->current_rent)->value('status') == 'Approved')
        <div class="col-md-6 mb-4 ">

            <div class="card ">
                <div class="card-body pb-0 p-3">
                    <div class="row">
                        <h6 class="mb-0">Change Password</h6>
                        <div class="col-sm-12 text-end">
                            <form class="form-horizontal" method="POST"
                                action="{{ route('profile.updatePassword') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-3 my-1">
                                        <input id="currentPassword" type="password" class="form-control"
                                            name="currentPassword" placeholder="Current password" required>

                                        @if ($errors->has('currentPassword'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('currentPassword') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <input id="newPassword" type="password" class="form-control" name="newPassword"
                                            placeholder="New password" required>

                                        @if ($errors->has('newPassword'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('newPassword') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <input id="newPasswordConfirm" type="password" class="form-control"
                                            name="newPassword_confirmation" placeholder="Enter password" required>
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <input class="w-100 btn btn-primary btn-block" type="submit" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endif
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Message from Admin</h6>
                        </div>
                        <div class="col-6 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body p-3 pb-0">
                    <ul class="list-group">
                        @foreach (DB::table('messages')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->limit(5)->get()
        as $message)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">

                                    <span class="text-xs">date</span><span
                                        class="text-xs text-success">{{ $message->created_at }}</span>
                                    <span class="text-xs"></span><span class="text-xs">{{ $message->message }}</span>
                                </div>
                            </li>
                        @endforeach



                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Latest Rental Status</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        @foreach (DB::table('rooms')->where(
                'id',
                DB::table('rents')->where('user_id', $user->id)->value('room_id'),
            )->get()
        as $room)
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">

                                <div class="d-flex flex-column m-3"
                                    style="background-image: url('{{ asset('/photo/' . $room->photo) }}');">
                                    <img src="{{ asset($room->photo) }}" alt="" srcset="" height="100"
                                        width="200">
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm">{{ $room->name }}</h6>
                                    <span class="mb-2 text-xs">Detail: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $room->detail }}</span></span>
                                    <span class="mb-2 text-xs">Price: <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{ $room->price }}</span></span>
                                    {{-- <span class="text-xs">Rent: <span class="text-dark ms-sm-2 font-weight-bold">Yearly</span></span> --}}
                                </div>

                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-5 mt-4">
            <div class="card h-100 mb-4">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">Bookings History</h6>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <i class="far fa-calendar-alt me-2"></i>
                            {{-- <small>23 - 30 March 2020</small> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">all time</h6>
                    <ul class="list-group">

                        @foreach (DB::table('rents')->where('user_id', $user->id)->get()
        as $booking)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    @if ($booking->status != 'active')
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="fas fa-arrow-down"></i></button>
                                    @else
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="fas fa-arrow-up"></i></button>
                                    @endif

                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">{{ $booking->payment_reference }}</h6>
                                        <span class="text-xs">{{ $booking->status }}</span>
                                        <span class="text-xs">{{ $booking->created_at }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                    {{ $booking->price }}
                                </div>
                            </li>
                        @endforeach

                    </ul>

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
