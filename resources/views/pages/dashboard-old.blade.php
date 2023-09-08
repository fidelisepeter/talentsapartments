@extends('layouts.main')
@section('page-title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-6 col-xl-3 col-lg-3 col-md-4 col-sm-4 my-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Users</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ DB::table('users')->where('role', 'student')->count() }}
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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rooms</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::allRooms()) }}
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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Bookings</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ DB::table('rents')->where('year', $viewingYear)->where('status', '!=', 'Approved')->count() }}
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
        <div class="col-6 col-xl-3 col-lg-3 col-md-4 col-sm-4 my-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">New Bookings</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ DB::table('rents')->where('year', $viewingYear)->where('status', '!=', 'Approved')->whereNull('school_check_status')->whereBetween('updated_at', [\Carbon\Carbon::now()->subDays(7), \Carbon\Carbon::now()])->count() }}
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

        <div class="col-6 col-xl-3 col-lg-3 col-md-4 col-sm-4 my-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rooms Available</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::roomsAvalaible()) }}
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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rooms Taken</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::roomsTaken()) }}
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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Empty Rooms</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::roomsEmpty()) }}
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

        <div class="col-6 col-xl-3 col-lg-3 col-md-4 col-sm-4 my-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Expired Rents</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::expired()) }}
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
    <div class="row mt-4">


        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">
                                <p class="mb-1 pt-2 text-bold"></p>
                                <h5 class="font-weight-bolder">Talents Apartment</h5>
                                <p class="mb-2">Business Name: {{ DB::table('settings')->value('business_name') }}
                                </p>
                                <p class="mb-2">Bank Name: {{ DB::table('settings')->value('bank_name') }}</p>
                                <p class="mb-2">Bank Account: {{ DB::table('settings')->value('bank_account') }}
                                </p>
                                <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                    href="javascript:;">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                            <div class="bg-gradient-primary border-radius-lg h-100">
                                <img src="../assets/img/shapes/waves-white.svg"
                                    class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                                <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                    <img class="w-100 position-relative z-index-2 pt-4"
                                        src="../assets/img/illustrations/rocket-white.png" alt="rocket">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Latest Notifications</h6>

                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        @foreach (DB::table('notifications')->where('year', $viewingYear)->orderBy('id', 'DESC')->limit(5)->get()
        as $notification)
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="ni ni-key-25 text-primary text-gradient"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">
                                        {{ $notification->created_by }},
                                        {{ $notification->message }}
                                    </h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                        {{ \Carbon\Carbon::parse($notification->created_at)->format('j M h:i A') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach





                    </div>

                    <a class="text-primary mx-2" href="/notifications">view all notifications</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card z-index-2">

                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">Complians & Tasks</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body pt-4 p-3">
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
                                {{ DB::table('complains')->where('year', $viewingYear)->count() }}
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
        </div>
        <div class="col-lg-7">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Sales overview</h6>
                    <p class="text-sm">
                      <i class="fa fa-arrow-up text-success"></i>
                      <span class="font-weight-bold">Sales for </span> {{ DB::table('settings')->value('viewing_year') }} in NGN
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class=" d-none bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                        <div class="chart">
                            <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
      <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
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
                              @foreach (DB::table('rents')->where('year', $viewingYear)->whereBetween('expiring_date', [\Carbon\Carbon::now(), \Carbon\Carbon::now()->addMonth(3)])->get()
  as $rent)
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
      <div class="col-lg-4 col-md-6">
          <div class="card h-100">
              <div class="card-header pb-0">
                  <h6>Recents Bookings</h6>

              </div>
              <div class="card-body p-3">
                  <div class="timeline timeline-one-side">
                      @foreach (DB::table('rents')->where('year', $viewingYear)->get()
  as $booking)
                          <div class="timeline-block mb-3">
                              <span class="timeline-step">
                                  <i class="ni ni-key-25 text-primary text-gradient"></i>
                              </span>
                              <div class="timeline-content">
                                  <h6 class="text-dark text-sm font-weight-bold mb-0">
                                      {{ DB::table('users')->where('id', $booking->user_id)->value('first_name') }},
                                      booked
                                      {{ DB::table('rooms')->where('id', $booking->room_id)->value('name') }}
                                  </h6>
                                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                      {{ \Carbon\Carbon::parse($booking->updated_at)->format('j M h:i A') }}</p>
                              </div>
                          </div>
                      @endforeach





                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('script')
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
        // var ctx = document.getElementById("chart-bars").getContext("2d");

        // new Chart(ctx, {
        //     type: "bar",
        //     data: {
        //         labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        //         datasets: [{
        //             label: "Sales",
        //             tension: 0.4,
        //             borderWidth: 0,
        //             borderRadius: 4,
        //             borderSkipped: false,
        //             backgroundColor: "#fff",
        //             data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
        //             maxBarThickness: 6
        //         }, ],
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         plugins: {
        //             legend: {
        //                 display: false,
        //             }
        //         },
        //         interaction: {
        //             intersect: false,
        //             mode: 'index',
        //         },
        //         scales: {
        //             y: {
        //                 grid: {
        //                     drawBorder: false,
        //                     display: false,
        //                     drawOnChartArea: false,
        //                     drawTicks: false,
        //                 },
        //                 ticks: {
        //                     suggestedMin: 0,
        //                     suggestedMax: 500,
        //                     beginAtZero: true,
        //                     padding: 15,
        //                     font: {
        //                         size: 14,
        //                         family: "Open Sans",
        //                         style: 'normal',
        //                         lineHeight: 2
        //                     },
        //                     color: "#fff"
        //                 },
        //             },
        //             x: {
        //                 grid: {
        //                     drawBorder: false,
        //                     display: false,
        //                     drawOnChartArea: false,
        //                     drawTicks: false
        //                 },
        //                 ticks: {
        //                     display: false
        //                 },
        //             },
        //         },
        //     },
        // });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

        var totalJan = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '01')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        var totalFeb = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '02')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        var totalMar = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '03')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        var totalApr = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '04')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        var totalMay = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '05')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        var totalJun = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '06')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        var totalJul = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '07')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        var totalAug = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '08')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        var totalSep = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '09')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        var totalOct = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '10')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        var totalNov = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '11')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        var totalDec = "{{ DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->whereMonth('updated_at', '12')->whereYear('updated_at', $viewingYear)->sum('price') }}";
        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                        label: "Bookings",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: [totalJan, totalFeb, totalMar, totalApr, totalMay, totalJun, totalJul, totalAug, totalSep, totalOct, totalNov, totalDec],
                        maxBarThickness: 6

                    },
                    // {
                    //     label: "Websites",
                    //     tension: 0.4,
                    //     borderWidth: 0,
                    //     pointRadius: 0,
                    //     borderColor: "#3A416F",
                    //     borderWidth: 3,
                    //     backgroundColor: gradientStroke2,
                    //     fill: true,
                    //     data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    //     maxBarThickness: 6
                    // },
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
                            color: '#b2b9bf',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endsection
