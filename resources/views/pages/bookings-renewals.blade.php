@extends('layouts.main')
@section('page-title', 'Bookings Renewal')
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
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Bookings Renewal</h6>
                        </div>
                        <div class="col-auto d-flex align-items-right">
                            {{-- <span class="mb-0">View By</span> --}}
                        </div>
                        <div class="col-auto d-flex align-items-right">
                            <div class="input-group">
                                <form action="" method="get">




                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Requested Room</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Current Room</th>

                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Amount</th> --}}

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date Booked</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rents as $rent)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    {{-- <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"> --}}
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ DB::table('users')->where('id', $rent->user_id)->value('last_name') }}
                                                        {{ DB::table('users')->where('id', $rent->user_id)->value('first_name') }}
                                                        {{ DB::table('users')->where('id', $rent->user_id)->value('middle_name') }}
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ DB::table('users')->where('id', $rent->user_id)->value('email') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="/booking_view/{{ $rent->id }}" class="font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="View Booking Details">
                                                <span class="text-xs font-weight-bold">
                                                    {{ DB::table('rooms')->where('id', $rent->requested_room)->value('name') }}
                                                    (₦{{ DB::table('rooms')->where('id', $rent->requested_room)->value('price') }})
                                                </span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/booking_view/{{ $rent->previous_rent }}"
                                                class="font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="View Previous Booking Details">
                                                <span class="text-xs font-weight-bold">
                                                    {{ DB::table('rooms')->where('id',DB::table('rents')->where('id', $rent->previous_rent)->value('room_id'))->value('name') }}
                                                    (
                                                    ₦{{ DB::table('rooms')->where('id',DB::table('rents')->where('id', $rent->previous_rent)->value('room_id'))->value('price') }})
                                                </span>
                                            </a>

                                        </td>

                                        {{-- <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold"> ₦{{ $rent->price }} </span>
                                        </td> --}}

                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($rent->updated_at)->format('j M, Y') }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/booking_view/{{ $rent->previous_rent }}/renewal"
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Edit user">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
            <div class="align-items-center" style="float:right;align-items: center !important;">
                {{-- {!! $rents->links() !!} --}}
            </div>
        </div>
    </div>





@endsection
