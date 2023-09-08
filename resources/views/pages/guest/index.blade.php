@php
function daysCount(DateTime $past_date){
    //set current date
    $now = new DateTime;
	//get differ between past date date and current date
    $diff = $now->diff($past_date);

    if ($past_date > $now) 
        return 'future';
        
    $total_days = $diff->days;
    $total_months = ($diff->y * 12) + $diff->m;
    $total_years = $diff->y;

    //setup of localization if you want to use another language, PHP will translate it
	setlocale(LC_ALL, 'en_EN');
	
    $count = ($d = $diff->d) ? ' and '. $d . ngettext(" day", " days", $d) : '';
    $count = ($m = $diff->m) ? ($count ? ', ' : ' and '). $m . ngettext(" month", " months", $m).$count : $count;
    $count = ($y = $diff->y) ? $y . ngettext(" year", " years", $y).$count  : $count;
            
    return $count;
}
@endphp
@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('style')
@endsection
@section('page-title', 'Guests')
@section('content')
<div class="row pb-5">
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
          <div class="card-body p-3">
              <div class="row">
                  <div class="col-8">
                      <div class="numbers">
                          <a href="/guest"><p class="text-sm mb-0 text-capitalize font-weight-bold">Total</p></a>
                          <h5 class="font-weight-bolder mb-0">
                              {{ count($guests); }}
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
                          <a href="/guest-awaiting"><p class="text-sm mb-0 text-capitalize font-weight-bold">Awaiting</p></a>
                          <h5 class="font-weight-bolder mb-0">
                          
                              {{ count($awaiting) }}
                              
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
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
          <div class="card-body p-3">
              <div class="row">
                  <div class="col-8">
                      <div class="numbers">
                          <a href="/guest-ongoing"><p class="text-sm mb-0 text-capitalize font-weight-bold">Ongoing</p></a>
                          <h5 class="font-weight-bolder mb-0">
                            {{ count($ongoing) }}
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
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
          <div class="card-body p-3">
              <div class="row">
                  <div class="col-8">
                      <div class="numbers">
                          <a href="/guest-closed"><p class="text-sm mb-0 text-capitalize font-weight-bold">Closed</p></a>
                          <h5 class="font-weight-bolder mb-0">
                            {{ count($closed) }}
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
<div class="row  mt-3" id="">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text btn bg-gradient-light" id="basic-addon1"
                    style="border-top-right-radius: 0px; border-bottom-right-radius: 0px;">Filter By Date &nbsp;<i
                        class="fa fa-search"></i> </span>
            </div>
            <input class="form-control px-3" type="text" name="filter_date_added"
                value=" {{ \Carbon\Carbon::parse($date['start'])->format('Y/m/d') }} - {{ \Carbon\Carbon::parse($date['end'])->format('Y/m/d') }}"
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
    <div class="col-12 mt-5">
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
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Time Spent</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Visit End</th>
              </thead>
              <tbody>
                  @foreach ($guests as $guest)
                  <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                         
                          
                          <div class="d-flex flex-column justify-content-center">
                            <a href="#">
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
                        <span class="text-secondary text-sm">
                            @if (!empty($guest->visit_start) && $guest->visit_start)

                            @if (\Carbon\Carbon::parse($guest->visit_start)->diff(\Carbon\Carbon::parse($guest->visit_end))->d == 0)
                                {{ \Carbon\Carbon::parse($guest->visit_start)->diff(\Carbon\Carbon::parse($guest->visit_end))->format('%h:%i') }}

                            @elseif (\Carbon\Carbon::parse($guest->visit_start)->diff(\Carbon\Carbon::parse($guest->visit_end))->m == 0)
                            {{ ($d = \Carbon\Carbon::parse($guest->visit_start)->diff(\Carbon\Carbon::parse($guest->visit_end))->format('%d')) ? $d . ngettext(" day", " days", $d) : '' }}
                            @else
                            {{ ($m = \Carbon\Carbon::parse($guest->visit_start)->diff(\Carbon\Carbon::parse($guest->visit_end))->format('%m')) ? $m . ngettext(" month", " months", $m) : '' }}
                            {{ ($d = \Carbon\Carbon::parse($guest->visit_start)->diff(\Carbon\Carbon::parse($guest->visit_end))->format('%d')) ? $d . ngettext(" day", " days", $d) : '' }}
                            
                            @endif
                           
                            @endif
                        </span>
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
                    "format": "YYYY/MM/DD",
                    "separator": "   -   ",
                    cancelLabel: 'Clear',
                    "customRangeLabel": "Custom",
                }
            });
            // $('input[name="filter_date_added"]').daterangepicker(options, function (start, end, label) { console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')'); }).click();;


            $('input[name="filter_date_added"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format(
                    'YYYY/MM/DD'));
                $('input[name="start"]').val(picker.startDate.format('YYYY-MM-DD'));
                $('input[name="end"]').val(picker.endDate.format('YYYY-MM-DD'));

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
