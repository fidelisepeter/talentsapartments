@extends('layouts.main')
@section('page-title', 'Rooms')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
{{-- Stay --}}
@else
{{ Session::flash('error','You are not permited to view that page') }}
<script>
  window.location.href = "{{ url('/dashboard') }}";
</script>
@endif
@section('content')
    <div class="card card-body blur shadow-blur overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">

            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Talents Room List

                    </h5>

                </div>
            </div>

        </div>
    </div>
    <div class="row mt-3">
        <div class="col-6 col-xl-3 col-lg-3 col-md-4 col-sm-4 my-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rooms/Bedspaces</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::allRooms()) }} / {{ DB::table('bed_spaces')->get()->count() }}
                                </h5>

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
        <div class="col-6 col-xl-3 col-lg-3 col-md-4 col-sm-4 my-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rooms/Bedspaces Available</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::roomsAvalaible()) }} / {{ DB::table('bed_spaces')->whereNull('user_id')->where('allocated', false)->get()->count() }}
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
        <div class="col-6 col-xl-3 col-lg-3 col-md-4 col-sm-4 my-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rooms/Bedspaces Taken</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::roomsTaken()) }} / {{ DB::table('bed_spaces')->whereNotNull('user_id')->where('allocated', true)->get()->count() }}
                                </h5>
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
        <div class="col-6 col-xl-3 col-lg-3 col-md-4 col-sm-4 my-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Empty Rooms/Bedspaces</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::roomsEmpty()) }} /00
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-12 mb-md-0 mb-4 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <span class="d-sm-inline d-none text-body font-weight-bold px-3">Search By Room Number
                                </span>

                                <form action="/rooms" method="get">

                                    <select class="form-control" name="search" onchange="this.form.submit()">
                                        <option value="all" @if (request('search') == 'all') selected @endif>All Rooms </option>
                                        @foreach (\App\Models\BedSpace::where('year', DB::table('settings')->value('viewing_year'))->get()->unique('room_number') as $roomList)
                                            <option value="{{ $roomList->room_number }}" @if (request('search') == $roomList->room_number) selected @endif>
                                                {{ $roomList->room_number }}</option>
                                        @endforeach

                                    </select>
                                </form>

                            </div>
                        </div>
                        <div class="col-sm-6" id="rooms-data">
                        </div>
                        
                    </div>
                </div>
                <div class="card-body px-3 pb-2">
                    <div class="table-responsive">
                        <table id="rooms" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Room</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Location</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Bed
                                        Capacity</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Price</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Residents</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Free</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $room->room->photo ?? asset('assets/img/no-image.PNG') }}"
                                                        class="avatar avatar-sm me-3" alt="invision">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    {{-- <span class="text-xs font-weight-bold">{{ $room->room_number ?? '' }} -
                                                        {{ $room->room->name ?? '' }} ({{ $room->building_name ?? '' }})</span> --}}
                                                        <p class="text-xs font-weight-bold mb-0">{{ $room->building_name }}, {{ $room->room_label }}</p>
                        <p class="text-xs text-secondary mb-0">{{ $room->room_number }}, {{ $room->room->name }}, {{ $room->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <span class="text-xs font-weight-bold">
                                                        {{ DB::table('locations')->where('id', $room->room->location)->value('name') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <span class="text-xs font-weight-bold">
                                                        {{ $room->bedspace_count }}
                                                        </span>
                                                    {{-- <h6 class="mb-0 text-sm">{{ $room->bedspace_count }}</h6> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <span class="text-xs font-weight-bold">
                                                        {{ \App\Helper\Helper::currency($room->room->price) }}
                                                        </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">



                                            <span class="text-xs font-weight-bold">
                                                @if ($room->with_resident->count() > 0)
                                                    <div class="avatar-group mt-2">
                                                        @foreach ($room->with_resident as $resident)
                                                            <a href="/resident/{{ $resident->user->id ?? '' }}"
                                                                class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title=""
                                                                data-bs-original-title="
                                                                    {{ $resident->user->first_name ?? '' }}
                                                                    {{ $resident->user->middle_name ?? '' }}
                                                                    {{ $resident->user->last_name ?? '' }}
                                                                    ">
                                                                <img src="{{ $resident->user->photo ?? asset('assets/img/no-image.PNG') }}"
                                                                    alt="
                                                                    {{ $resident->user->first_name ?? '' }}
                                                                    {{ $resident->user->middle_name ?? '' }}
                                                                    {{ $resident->user->last_name ?? '' }}
                                                                    ">
                                                            </a>


                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    Not Yet Allocated
                                                @endif
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-xs font-weight-bold">
                                            {{ $room->bedspace_count - $room->with_resident->count() }} bed space
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>



        </div>

        <div class="col-md-12 mb-md-0 mb-4 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <span class="d-sm-inline d-none text-body font-weight-bold px-3">Free Rooms
                                </span>

                                <p class="text-sm mb-0">
                                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                                    <span class="font-weight-bold ms-1">{{ count(\App\Helpers\Rooms::roomsAvalaible()) }}
                                        Room(s)
                                        are still Available</span>
                                </p>

                            </div>
                        </div>
                        <div class="col-sm-6" id="free-rooms-data">
                        </div>
                        
                    </div>
                    
                </div>
                <div class="card-body px-3 pb-2">
                    <div class="table-responsive">
                        <table id="free-rooms" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Room</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Location</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Bed
                                        Capacity</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Price</th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Residents</th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Free</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($availableRooms as $room)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $room->room->photo ?? asset('assets/img/no-image.PNG') }}"
                                                        class="avatar avatar-sm me-3" alt="invision">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    {{-- <span class="text-xs font-weight-bold">{{ $room->room->name ?? '' }} -
                                                        {{ $room->room_number ?? '' }}</span> --}}

                                                        <p class="text-xs font-weight-bold mb-0">{{ $room->building_name }}, {{ $room->room_label }}</p>
                        <p class="text-xs text-secondary mb-0">{{ $room->room_number }}, {{ $room->room->name }}, {{ $room->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <span class="text-xs font-weight-bold">
                                                        {{ DB::table('locations')->where('id', $room->room->location)->value('name') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <span class="text-xs font-weight-bold">{{ $room->bedspace_count }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <span class="text-xs font-weight-bold">
                                                        {{ \App\Helper\Helper::currency($room->room->price) }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">



                                            <span class="text-xs font-weight-bold">
                                                @if ($room->with_resident->count() > 0)
                                                    <div class="avatar-group mt-2">
                                                        @foreach ($room->with_resident as $resident)
                                                            <a href="/resident/{{ $resident->user->id ?? '' }}"
                                                                class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title=""
                                                                data-bs-original-title="
                                                                {{ $resident->user->first_name ?? '' }}
                                                                {{ $resident->user->middle_name ?? '' }}
                                                                {{ $resident->user->last_name ?? '' }}
                                                                ">
                                                                <img src="{{ $resident->user->photo ?? asset('assets/img/no-image.PNG') }}"
                                                                    alt="
                                                                {{ $resident->user->first_name ?? '' }}
                                                                {{ $resident->user->middle_name ?? '' }}
                                                                {{ $resident->user->last_name ?? '' }}
                                                                ">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    Not Yet Allocated
                                                @endif
                                            </span>
                                        </td>

                                        <td class="align-middle">
                                            <span class="text-xs font-weight-bold">
                                                {{ $room->bedspace_count - $room->with_resident->count() }} bed space
                                            </span>
                                           
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
@endsection
@section('script')
    <script>
        // Limit user from selecting more than one amenities
        $(document).ready(function() {
            $("input[name='amenities[]']").change(function() {
                var maxAllowed = 10;
                var cnt = $("input[name='amenities[]']:checked").length;
                if (cnt > maxAllowed) {
                    $(this).prop("checked", "");

                    $('#amenities-error').attr({
                        "class": "text-danger",
                        "role": "alert"
                    });
                }
            });
            // Select all elements with data-toggle="popover" in the document
            // $('[data-toggle="popover"]').popover();

        });
    </script>
    <script>
        $(function() {
            $('#rooms').DataTable({
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
                // "lengthMenu": [[2, 25, 50, -1], [2, 25, 50, "All"]],
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                "responsive": false,
                // "buttons": ["csv", "excel", "pdf", "print"]
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
                    // "buttonLiner": {
                    //     "tag": "span",
                    //     "className": ""
                    // }
                }
                },
                // "columnDefs": [{
                //     "targets": -1,
                //     "className": 'dt-body-right'
                // }],
                // "select": true,
                "info": false,
                // "infoCallback": function(settings, start, end, max, total, pre) {
                //     var api = this.api();
                //     var pageInfo = api.page.info();

                //     return 'Page ' + (pageInfo.page + 1) + ' of ' + pageInfo.pages;
                // },
                // "dom": 'rt<"bottom-right"p><"clear">',
                // "dom": {
                //     // "container": {
                //     //     "tag": "div",
                //     //     "className": "dt-buttons"
                //     // },
                //     // "collection": {
                //     //     "tag": "div",
                //     //     "className": ""
                //     // },
                //     // "button": {
                //     //     "tag": "button",
                //     //     "className": "dt-button",
                //     //     "active": "active",
                //     //     "disabled": "disabled"
                //     // },
                //     // "buttonLiner": {
                //     //     "tag": "span",
                //     //     "className": ""
                //     // }
                // }
            }).buttons().container().appendTo('#rooms-data');

            $('#free-rooms').DataTable({
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
               
                
            }).buttons().container().appendTo('#free-rooms-data');


            
        });
    </script>
@endsection
