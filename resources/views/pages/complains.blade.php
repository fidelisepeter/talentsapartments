@extends('layouts.main')
@section('page-title', 'Complians')

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-header p-3 pb-0">
                    <h6 class="mb-0">Message A Student</h6><br>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="message" enctype="multipart/form-data">@csrf
                        <ul class="list-group">
                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <select name="user_id" id="GetIt" class="form-control">
                                        <option value="all">ALL (
                                            {{ DB::table('users')->where('role', 'student')->get()->count() }})</option>
                                        @foreach (DB::table('users')->where('role', 'student')->get() as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }}
                                                {{ $user->middle_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li id="startTyping" class="list-group-item border-0 px-0">
                                <input type="hidden" name="status" value="quick_message">
                                <div class="form-check form-switch ps-0">
                                    <textarea class="form-control" placeholder="Start typing" name="message" id="" cols="30" rows="5"></textarea>
                                </div>
                            </li>


                            <input class="btn btn-info" type="submit" value=" submit a complaint" />

                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-8 mb-3">
            <div class="d-sm-flex justify-content-between mb-2">
                <div>
                    <h6 class="mb-0">All complaints </h6>

                </div>
                <div class="d-flex">
                    <div class="input-group me-3">
                        <span class="input-group-text text-body"><i class="fas fa-calendar-alt"
                                aria-hidden="true"></i></span>
                        <input type="text" class="form-control" data-complain-table-filter="date-picker"
                            placeholder="Type here...">
                    </div>
                    <div class="input-group me-3">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" data-complain-table-filter="search"
                            placeholder="Type here...">
                    </div>
                    <div class="dropdown d-inline me-2">
                        <a href="javascript:;" class="btn bg-gradient-primary dropdown-toggle" data-toggle="dropdown"
                            id="navbarDropdownMenuLink2">
                            Filters
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="navbarDropdownMenuLink2"
                            data-popper-placement="left-start">
                            <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                    data-complaint-status="new">Status: New</a></li>
                            <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                    data-complaint-status="pending">Status: pending</a></li>
                            <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                    data-complaint-status="ongoing">Status: ongoing</a></li>
                            <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                    data-complaint-status="completed">Status: Completed</a></li>
                            <li>
                                <hr class="horizontal dark my-2">
                            </li>
                            <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Remove Filter</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="card h-100">

                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table-flush table" id="datatable-search">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Residents</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (Auth::user()->hasRole(DB::table('settings')->value('complaints_management_role') ?? '-') ||
                                        Auth::user()->can('view-task'))
                                    {{-- @if (Auth::user()->can('view-task')) --}}
                                    @foreach (DB::table('complaints')->where('year', $viewingYear)->orderBy('id', 'DESC')->get() as $complaint)
                                        @php
                                            if (
                                                DB::table('tasks')
                                                    ->where('task_of', $complaint->id)
                                                    ->value('status') == 'completed' &&
                                                $complaint->status == 'completed'
                                            ) {
                                                $compliantStatus = 'completed';
                                            } else {
                                                $daysDiff = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($complaint->created_at));
                                                if ($daysDiff < 2) {
                                                    $compliantStatus = 'new';
                                                } elseif ($daysDiff < 4) {
                                                    $compliantStatus = 'pending';
                                                } else {
                                                    $compliantStatus = 'ongoing';
                                                }
                                            }
                                            
                                        @endphp
                                        <tr>
                                            <td class="font-weight-bold text-xs">
                                                <div class="d-flex align-items-center">

                                                    <p class="font-weight-bold mb-0 ms-2 text-lg">
                                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('id') }}
                                                    </p>


                                                </div>
                                            </td>
                                            <td class="font-weight-bold text-xs">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('first_name') }}
                                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('middle_name') }}
                                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('last_name') }}
                                                        <a href="/resident/"><i class="fa fa-pencil"></i></a>
                                                    </h6>
                                                    <p class="text-secondary mb-0 text-xs">
                                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('email') }}
                                                        -
                                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('phone_number') }}
                                                    </p>
                                                </div>
                    </div>
                    </td>
                    <td class="font-weight-bold text-xs" data-status="{{ $compliantStatus }}"
                        data-order="{{ \Carbon\Carbon::parse($complaint->created_at)->format('Y-m-d') }}">

                        <div class="d-flex align-items-center">
                            @if (DB::table('tasks')->where('task_of', $complaint->id)->value('status') == 'completed' && $complaint->status == 'completed')
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success btn-sm d-flex align-items-center justify-content-center mb-0 me-3"><i
                                        class="fas fa-check"></i></button>
                                <span class="text-success">Completed</span>
                            @else
                                @php
                                    $daysDiff = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($complaint->created_at));
                                @endphp
                                @if ($daysDiff < 2)
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-warning btn-sm d-flex align-items-center justify-content-center mb-0 me-3"><i
                                            class="far fa-newspaper"></i></button>
                                    <span class="text-warning">New</span>
                                @elseif ($daysDiff < 4)
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-warning btn-sm d-flex align-items-center justify-content-center mb-0 me-3"><i
                                            class="far fa-newspaper"></i></button>
                                    <span class="text-warinig">Pending</span>
                                @else
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-primary btn-sm d-flex align-items-center justify-content-center mb-0 me-3"><i
                                            class="fas fa-spinner"></i></button>
                                    <span class="text-primary">Ongoing</span>
                                @endif
                            @endif

                        </div>
                    </td>
                    <td class="">
                        <div class="d-flex align-items-center float-right ms-auto text-end" style="float: right;">
                            <a class="btn btn-sm btn-rounded btn-outline-primary btn-sm d-flex align-items-center justify-content-center mb-0 me-2"
                                data-id="{{ $complaint->user_id }}"
                                data-email="{{ DB::table('users')->where('id', $complaint->user_id)->value('email') }}"
                                id="replyUser"><span>Quick Reply</span></a>
                            <a href="/complaint/{{ $complaint->id }}"
                                class="btn btn-sm btn-rounded btn-primary btn-sm d-flex align-items-center justify-content-center mb-0 me-2"><span>View
                                    Details</span></a>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    {{-- End Super Admin --}}
                @else
                    {{-- Assigned Admin --}}
                    @foreach (DB::table('tasks')->where('year', $viewingYear)->where('attendant', Auth::id())->orderBy('id', 'DESC')->get() as $complaint)
                        <tr>
                            <td class="font-weight-bold text-xs">
                                <div class="d-flex align-items-center">
                                    @if ($complaint->status == 'completed')
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-success btn-sm d-flex align-items-center justify-content-center mb-0 me-3"><i
                                                class="fas fa-check"></i></button>
                                    @else
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-danger btn-sm d-flex align-items-center justify-content-center mb-0 me-3"><i
                                                class="fas fa-arrow-down"></i></button>
                                    @endif
                                    {{-- <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button> --}}
                                    <p class="font-weight-bold mb-0 ms-2 text-xs">
                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('id') }}</p>


                                </div>
                            </td>
                            <td class="font-weight-bold text-xs">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">
                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('first_name') }}
                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('middle_name') }}
                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('last_name') }} <a
                                            href="/resident/"><i class="fa fa-pencil"></i></a></h6>
                                    <p class="text-secondary mb-0 text-xs">
                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('email') }} -
                                        {{ DB::table('users')->where('id', $complaint->user_id)->value('phone_number') }}
                                    </p>
                                </div>
                </div>
                </td>

                <td class="">
                    <div class="d-flex align-items-center float-right ms-auto text-end" style="float: right;">
                        <a class="btn btn-sm btn-rounded btn-outline-primary btn-sm d-flex align-items-center justify-content-center mb-0 me-2"
                            data-id="{{ $complaint->user_id }}"
                            data-email="{{ DB::table('users')->where('id', $complaint->user_id)->value('email') }}"
                            id="replyUser"><span>Quick Reply</span></a>
                        <a href="/complaint/{{ DB::table('complaints')->where('id', $complaint->task_of)->value('id') }}"
                            class="btn btn-sm btn-rounded btn-primary btn-sm d-flex align-items-center justify-content-center mb-0 me-2"><span>View
                                Details</span></a>
                    </div>
                </td>
                </tr>
                @endforeach
                {{-- End Assigned Admin --}}
                @endif


                </tbody>
                </table>
            </div>

        </div>
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
                "pageLength": 5,
                "retrieve": true,
                "lengthChange": false,
                // "searching": false,
                "ordering": false,
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
                    var rowStatus = t.cell(dataIndex, 2).nodes().to$().data('status');
                    return status === rowStatus;
                });
                t.draw();
                $.fn.dataTable.ext.search.pop()
            };

            document.querySelectorAll('[data-complaint-status]').forEach((e => {
                e.addEventListener("click", (a => {
                    const targetStatus = a.target.getAttribute('data-complaint-status');
                    filterByStatus(targetStatus);

                }))
            }));

        });
    </script>
@endsection
