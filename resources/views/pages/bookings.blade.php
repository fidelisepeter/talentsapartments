@extends('layouts.main')
@section('page-title', 'Bookings')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
    {{-- Stay --}}
@else
    {{ Session::flash('error', 'You are not permited to view that page') }}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@section('content')
    <div class="row pb-5">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(DB::table('rents')->where('status', '!=', 'Approved')->where('year', $viewingYear)->where('status', '!=', 'Archived')->get()) }}
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

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">New</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(DB::table('rents')->where('year', $viewingYear)->where('status', '!=', 'Archived')->where('status', '!=', 'Approved')->whereNull('school_check_status')->whereBetween('updated_at', [\Carbon\Carbon::now()->subWeek(), \Carbon\Carbon::now()])->latest('id')->get()) }}
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
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Approved</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(DB::table('rents')->where('year', $viewingYear)->where('status', '!=', 'Archived')->where('status', 'Approved')->get()) }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rejected</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(DB::table('rents')->where('year', $viewingYear)->where('status', '!=', 'Archived')->where('status', 'Declined')->get()) }}
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
    </div>



    <!-- here -->








    <!-- here -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    {{-- <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Bookings</h6>
                        </div>
                        <div class="col-auto d-flex align-items-right">
                            <span class="mb-0">View By</span>
                        </div>
                        <div class="col-auto d-flex align-items-right">
                            <div class="input-group">
                                <form action="" method="get">
                                   

                                    <div class="input-group">

                                        <select class="form-control" name="sort" onchange="this.form.submit()">
                                            <option value="all">-- Sort By -- </option>
                                            <option value="new" @if (request('sort') == 'new') selected @endif> New
                                            </option>
                                           
                                            <option value="declined" @if (request('sort') == 'declined') selected @endif>
                                                Declined </option>
                                            <option value="pending" @if (request('sort') == 'pending') selected @endif>
                                                Pending </option>


                                        </select>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div> --}}
                    <div class="d-sm-flex justify-content-between mb-2">
                        <div>
                            <h6 class="mb-0">Bookings </h6>
        
                        </div>
                        <div class="d-flex">
                           
                            <div class="input-group me-3">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" data-complain-table-filter="search"
                                    placeholder="Type here...">
                            </div>
                            <div class="input-group me-3">
                                <form action="" method="get">
                                    <select class="form-control" name="sort" onchange="this.form.submit()">
                                        <option value="all">-- Sort By -- </option>
                                        <option value="new" @if (request('sort') == 'new') selected @endif> New
                                        </option>
                                       
                                        <option value="declined" @if (request('sort') == 'declined') selected @endif>
                                            Declined </option>
                                        <option value="pending" @if (request('sort') == 'pending') selected @endif>
                                            Pending </option>


                                    </select>
                                </form>
                            </div>
                            <div class="dropdown d-inline me-2">
                                <a href="javascript:;" class="btn bg-gradient-primary dropdown-toggle" data-toggle="dropdown"
                                    id="navbarDropdownMenuLink2">
                                    Filters
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="navbarDropdownMenuLink2"
                                    data-popper-placement="left-start">
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                            data-booking-status="100">Status: 100%</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                            data-booking-status="85">Status: 85%</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                            data-booking-status="70">Status: 70%</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                            data-booking-status="35">Status: 35%</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                            data-booking-status="20">Status: 20%</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                        data-booking-status="10">Status: 10%</a></li>
                                    <li>
                                        <hr class="horizontal dark my-2">
                                    </li>
                                    <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Remove Filter</a>
                                    </li>
                                </ul>
                            </div>
        
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="datatable-search">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Room type</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Amount</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
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
                                                    <a href="/booking_view/{{ $rent->id }}" class="mb-0 text-sm h6">
                                                        {{ DB::table('users')->where('id', $rent->user_id)->value('last_name') }}
                                                        {{ DB::table('users')->where('id', $rent->user_id)->value('first_name') }}
                                                        {{ DB::table('users')->where('id', $rent->user_id)->value('middle_name') }}
                                                    </a>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ DB::table('users')->where('id', $rent->user_id)->value('email') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">
                                                {{ DB::table('rooms')->where('id', $rent->room_id)->value('name') }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold"> ₦{{ $rent->price }} </span>
                                        </td>
                                        <td class="align-middle" data-status="{{ $rent->status_percentage }}">
                                            {{-- Approved --}}
                                            @if ($rent->status_percentage <= 10)
                                                <div class="progress-wrapper w-75 mx-auto">
                                                    <div class="progress-info">
                                                        <div class="progress-percentage">
                                                            <span class="text-xs font-weight-bold">{{ $rent->status_percentage }}%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-danger w-{{ $rent->status_percentage }}" role="progressbar"
                                                            aria-valuenow="{{ $rent->status_percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            @elseif ($rent->status_percentage > 10 && $rent->status_percentage <= 20)
                                                <div class="progress-wrapper w-75 mx-auto">
                                                    <div class="progress-warning">
                                                        <div class="progress-percentage">
                                                            <span class="text-xs font-weight-bold">{{ $rent->status_percentage }}%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-warning w-{{ $rent->status_percentage }}" role="progressbar"
                                                            aria-valuenow="{{ $rent->status_percentage }}" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif ($rent->status_percentage > 20 && $rent->status_percentage <= 85)
                                                <div class="progress-wrapper w-75 mx-auto">
                                                    <div class="progress-info">
                                                        <div class="progress-percentage">
                                                            <span class="text-xs font-weight-bold">{{ $rent->status_percentage }}%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info w-{{ $rent->status_percentage }}" role="progressbar"
                                                            aria-valuenow="{{ $rent->status_percentage }}" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            {{-- @elseif ($rent->status_percentage == 35)
                                                <div class="progress-wrapper w-75 mx-auto">
                                                    <div class="progress-info">
                                                        <div class="progress-percentage">
                                                            <span class="text-xs font-weight-bold">35%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info w-35" role="progressbar"
                                                            aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif ($rent->status_percentage == 70)
                                                <div class="progress-wrapper w-75 mx-auto">
                                                    <div class="progress-info">
                                                        <div class="progress-percentage">
                                                            <span class="text-xs font-weight-bold">70%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info w-70" role="progressbar"
                                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif ($rent->status_percentage == 85)
                                                <div class="progress-wrapper w-75 mx-auto">
                                                    <div class="progress-info">
                                                        <div class="progress-percentage">
                                                            <span class="text-xs font-weight-bold">85%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info w-85" role="progressbar"
                                                            aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            @elseif ($rent->status_percentage == 100)
                                                <div class="progress-wrapper w-75 mx-auto">
                                                    <div class="progress-info">
                                                        <div class="progress-percentage">
                                                            <span class="text-xs font-weight-bold">100%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success w-100"
                                                            role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($rent->updated_at)->format('j M, Y') }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="booking_view/{{ $rent->id }}"
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
@section('script')
    <script src="{{ asset('assets/js/plugins/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            document.querySelectorAll('#replyUser').forEach((e => {
                e.addEventListener("click", (a => {
                    console.log(e);
                    console.log(a);
                    id = $(e).data('id');
                    email = $(e).data('email');
                    $("#GetIt option").attr('selected', false);
                    $("#GetIt option[value=" + id + "]").attr('selected', true);
                    $("#startTyping textarea").focus();
                    $("#startTyping textarea").attr('placeholder', 'Start a message to ' +
                        email);
                }))
            }));


            const t = $('#datatable-search').DataTable({
                'dom': 'lrtip',
                "paging": true,
                // "pagingType": "full_numbers",
                "language": {
                    "paginate": {
                        "previous": "‹",
                        "first": "«",
                        "next": "›",
                        "last": "»",
                    }
                },
                "pageLength": 15,
                "retrieve": true,
                "lengthChange": false,
                // "searching": false,
                "order": [[3, "desc"]],
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
                "info": false,
            })
            // Function to filter table based on date range
            var filterByDateRange = (e, n, a) => {
                r = e[0] ? new Date(e[0]) : null;
                o = e[1] ? new Date(e[1]) : null;
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    var rowStatus = new Date(moment(t.cell(dataIndex, 2).nodes().to$().data('order'),
                        "YYYY-MM-DD")); // Use the data-order attribute
                    return (r === null || rowStatus >= r) && (o === null || rowStatus <= o);
                });
                t.draw();
                $.fn.dataTable.ext.search.pop()
            };

            const e = document.querySelector('[data-complain-table-filter="date-picker"]');
            n = $(e).flatpickr({
                altInput: !0,
                altFormat: "d/m/Y",
                dateFormat: "Y-m-d",
                mode: "range",
                onChange: function(e, t, n) {
                    filterByDateRange(e, t, n);
                }
            });
            document.querySelector('[data-complain-table-filter="search"]')
                .addEventListener("keyup", (function(a) {
                    t.search(a.target.value).draw()
                }))
            // Function to filter table based on status
            var filterByStatus = (status) => {
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    var rowStatus = t.cell(dataIndex, 3).nodes().to$().data('status');
                    // var check = (rowStatus <= status);
                    // if(status == 100){
                    //     var check = (rowStatus == status);
                    // }else(status = 50){
                    //     var check = (rowStatus == status);
                    // }
                    return rowStatus == status;
                });
                t.draw();
                $.fn.dataTable.ext.search.pop()
            };

            document.querySelectorAll('[data-booking-status]').forEach((e => {
                e.addEventListener("click", (a => {
                    const targetStatus = a.target.getAttribute('data-booking-status');
                    // alert(targetStatus)
                    filterByStatus(targetStatus);

                }))
            }));

        });
    </script>
@endsection
