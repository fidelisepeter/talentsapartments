@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('page-title', $lawyer->first_name . ' ' . $lawyer->last_name . ' - Login Reports')
@section('content')

    <div class="row pb-5">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text btn bg-gradient-light" id="basic-addon1"
                        style="border-top-right-radius: 0px; border-bottom-right-radius: 0px;">Filter By Date &nbsp;<i
                            class="fa fa-search"></i> </span>
                </div>
                <input class="form-control px-3" type="text" name="filter_date_added"
                    value=" {{ \Carbon\Carbon::parse($date['start'])->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($date['end'])->format('d/m/Y') }}"
                    placeholder="" style="border-radius: 0px !important;">
                <div class="input-group-append">
                    <form action="" method="get">
                        <input class="form-control" type="hidden" name="start" value="" placeholder="">
                        <input class="form-control" type="hidden" name="end" value="" placeholder="">

                        <button class="btn bg-gradient-primary" type="submit"
                            style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;
"><i
                                class="fa fa-arrow-right"></i> Filter</button>
                    </form>
                </div>

            </div>



        </div>
        <div class="col-12">
            <div class="card mb-4">
                {{-- <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Login Report</h6>
                        </div>
                        <div class="col-sm-6" id="loginuser-data"></div>
                    </div>
                </div> --}}
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Login Report</h5>
                            <p class="text-sm mb-0">
                                @if ($date['start'] == $date['end'])
                                    For {{ \Carbon\Carbon::parse($date['start'])->format('D j M, Y') }}
                                @else
                                    For {{ \Carbon\Carbon::parse($date['start'])->format('D j M, Y') }} To
                                    {{ \Carbon\Carbon::parse($date['end'])->format('D j M, Y') }}
                                @endif
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                @if ($logins->count() !== 0)
                                    <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                                        type="button" name="button">Export</button>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="lawyer-logins" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lawyer
                                        Location
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Browser</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ip Address</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Login Date</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Login Time</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logins as $user)
                                    @php
                                        $details = json_decode($user->details);
                                        // $location = $details->location;
                                        if ($details->location) {
                                            $location = $details->location;
                                        } else {
                                            $location = [];
                                            // $location = \Stevebauman\Location\Facades\Location::get($user->ip_address) !== false ? Location::get($user->ip_address) : [];
                                        }
                                        
                                    @endphp
                                    @if (DB::table('users')->where('id', $lawyer->id)->value('role') != 'student')
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <span class="text-secondary text-sm font-weight-bold">
                                                            {{ $location ? $location->cityName . ' - ' . $location->regionName . ', ' . $location->countryName : 'No details' ?? 'No Deatils' }}

                                                        </span>

                                                        <p class="text-xxs text-secondary mb-0">
                                                            {{ $location ? ' (latitude: ' . $location->latitude . ', longitude: ' . $location->longitude . ') ' : '' }}
                                                        </p>
                                                    </div>
                                                </a>

                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->browser }}</p>

                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $user->ip_address }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($user->login_date)->format('j M, Y') }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($user->login_date)->format('H:i:s') }}</span>
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
@section('style')
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/assets/css/daterangepicker.css') }}" />

@endsection
@section('script')
    <!-- date-range-picker -->
@section('script')
    <!-- date-range-picker -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('/assets/js/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Select2 -->
    {{-- <script src="../../plugins/select2/js/select2.full.min.js"></script> --}}
    <script type="text/javascript">
        $(function() {

            var ranges = {};

            ranges['Today'] = [moment(), moment()];
            ranges['Yesterday'] = [moment().subtract(1, 'days'), moment().subtract(1, 'days')];
            ranges[moment().subtract(2, 'days').format('dddd')] = [moment().subtract(2, 'days'), moment().subtract(
                2, 'days')];
            ranges[moment().subtract(3, 'days').format('dddd')] = [moment().subtract(3, 'days'), moment().subtract(
                3, 'days')];
            ranges[moment().subtract(4, 'days').format('dddd')] = [moment().subtract(4, 'days'), moment().subtract(
                4, 'days')];
            ranges[moment().subtract(5, 'days').format('dddd')] = [moment().subtract(5, 'days'), moment().subtract(
                5, 'days')];
            ranges['Last 7 Days'] = [moment().subtract(6, 'days'), moment()];
            ranges['Last 30 Days'] = [moment().subtract(29, 'days'), moment()];
            ranges['Last Month'] = [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                'month').endOf('month')];
            ranges['This Week'] = [moment().startOf('week'), moment().endOf('week')];
            ranges['This Month'] = [moment().startOf('month'), moment().endOf('month')];

            $('input[name="filter_date_added"]').daterangepicker({

                autoUpdateInput: false,

                // "opens": "right",
                "buttonClasses": "btn",
                "applyClass": "bg-gradient-primary",
                "cancelClass": "bg-gradient-light",

                "alwaysShowCalendars": true,

                "parentEl": "card",
                "startDate": "{{ \Carbon\Carbon::parse($date['start'])->format('d/m/Y') }}",
                "endDate": "{{ \Carbon\Carbon::parse($date['end'])->format('d/m/Y') }}",
                "opens": "left",
                "singleDatePicker": false,
                "showDropdowns": true,
                "showWeekNumbers": true,
                "showISOWeekNumbers": true,
                // "timePicker": true,
                // "timePicker24Hour": true,
                // "timePickerSeconds": true,
                "autoApply": false,
                // "dateLimit": {
                //     "days": 7
                // },

                ranges: ranges,

                locale: {
                    "format": "DD/MM/YYYY",
                    "separator": "   -   ",
                    cancelLabel: 'Clear',
                    "customRangeLabel": "Custom",
                }
            });
            // $('input[name="filter_date_added"]').daterangepicker(options, function (start, end, label) { console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')'); }).click();;


            $('input[name="filter_date_added"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                    'DD/MM/YYYY'));
                $('input[name="start"]').val(picker.startDate.format('DD-MM-YYYY'));
                $('input[name="end"]').val(picker.endDate.format('DD-MM-YYYY'));

            });


            $('input[name="filter_date_added"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });
    </script>
    <script>
        if (document.getElementById('lawyer-logins')) {
            const dataTableSearch = new simpleDatatables.DataTable("#lawyer-logins", {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                paging: true,
                ordering: false,
                info: false,
                lengthChange: true,
                perPageSelect: [1, 5, 10, 15, 20, 25],
                labels: {
                    placeholder: "Search...",
                    perPage: "{select} entries per page",
                    noRows: "No entries found",
                    info: "Showing {start} to {end} of {rows} entries"
                },
                layout: {
                    top: "{select}{search}",
                    bottom: "{info}{pager}"
                },
                // "autoWidth": false,
                "responsive": true,
            });

            document.querySelectorAll(".export").forEach(function(el) {
                el.addEventListener("click", function(e) {
                    var type = el.dataset.type;

                    var data = {
                        type: type,
                        filename: "{{ $lawyer->first_name . '-' . $lawyer->last_name }}-login-report" +
                            type,
                    };

                    if (type === "csv") {
                        data.columnDelimiter = "|";
                    }

                    dataTableSearch.export(data);
                });
            });
        };
    </script>
    {{-- <script>
        $(function() {


            $('#lawyer-logins').DataTable({
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
                "searching": true,
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


            });
            // .buttons().container().appendTo('#loginuser-data');

            let tableId = $('#lawyer-logins'),
                searchInput = table
                .parents('.dataTables_wrapper')
                .find('input[type=search]'),
                ourInput = $(document.createElement('input'))
                .attr({
                    type: 'search',
                    'class': 'form-control form-control-sm',
                    'aria-controls': tableId,
                });
        });
    </script> --}}
@endsection
