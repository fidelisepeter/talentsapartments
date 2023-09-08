@extends('layouts.main')
{{-- @if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif --}}

@section('page-title', 'Guests')
@section('content')
<div class="row  " id="">
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
                        style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;"><i
                            class="fa fa-arrow-right"></i> Filter</button>
                </form>
            </div>

        </div>



    </div>
    <div class="col-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-lg-flex">
                <div>
                    <h5 class="mb-0">Guest</h5>
                    <p class="text-sm mb-0">
                        {{-- COunt: {{$guests->count()}} --}}
                    </p>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">
                        <div class="d-flex">
                            {{-- <div class="dropdown d-inline">
                              <a href="javascript:;" class="btn btn-outline-dark dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                                Filters
                              </a>
                              <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2" data-popper-placement="left-start">
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Ongoin</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Closed</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Awaiting</a></li>
                                <li>
                                  <hr class="horizontal dark my-2">
                                </li>
                                <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Remove Filter</a></li>
                              </ul>
                            </div> --}}
                            @if (Auth::user()->role == 'student')
                            <a class="btn bg-gradient-primary btn-sm export mb-0 mt-sm-0 mt-1" href="/guest/create">New Guest</a>
                     
                            @endif
                            @if ($guests->count() !== 0)
                            
                            <button class="btn btn-icon btn-outline-dark ms-2 export" data-type="csv" type="button">
                              <span class="btn-inner--icon"><i class="ni ni-archive-2"></i></span>
                              <span class="btn-inner--text">Export CSV</span>
                            </button>
                            
                        @endif
                          </div>
                          
                          
  
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive">
            <table id="guest-table"  class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Names</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Resident</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Visit Start</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Visit End</th>
              </thead>
              <tbody>
                  @foreach ($guests as $guest)
                  <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                         
                          
                          <div class="d-flex flex-column justify-content-center">
                            <a href="">
                            <h6 class="mb-0 text-sm">
                              {{ $guest->first_name ?? ''}}
                              {{ $guest->last_name ?? ''}}
                            </h6>
                          </a>
                          </div>
                        
                        </div>
                      </td>
                      <td>
                        <p class="text-sm text-secondary mb-0">{{ $guest->status }}</p>
                      </td>
                      <td>
                        <span class="badge badge-dot me-4">
                          <i class="bg-info"></i>
                          <span class="text-dark text-xs">{{ $guest->phone_number ?? ''}}</span>
                        </span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <div class="d-flex px-2 py-1">
                       
                            <div>
                              <img src="{{ $guest->user->photo ?? asset('assets/img/no-pics-placeholder.jpg')}}" class="avatar avatar-sm me-3" alt="avatar image">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <a href="/resident/{{ $guest->user->id ?? ''}}">
                              <h6 class="mb-0 text-sm">
                                {{ $guest->user->first_name ?? ''}}
                                {{ $guest->user->middle_name ?? ''}}
                                {{ $guest->user->last_name ?? ''}}
                              </h6>
                            </a>
                            </div>
                          
                          </div>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-sm">{{ $guest->visit_start ?? ''}}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-sm">{{ $guest->visit_end ?? ''}}</span>
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
@section('style')

    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/assets/css/daterangepicker.css') }}" />

@endsection

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
            // alert('kjhg')

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
        if (document.getElementById('guest-table')) {
            const dataTableSearch = new simpleDatatables.DataTable("#guest-table", {
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
                        filename: "guest-report" +
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
    
@endsection
