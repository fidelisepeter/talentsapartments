@extends('layouts.main')
@section('page-title', 'Financials')

@section('content')
<div class="row mt-4">
    <div class="col-lg-5 col-12">
      <div class="card card-background card-background-mask-info h-100 tilt" data-tilt="" style="will-change: transform; transform: perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1);">
        <div class="full-background" style="background-image: url('../../../assets/img/curved-images/white-curved.jpeg')"></div>
        <div class="card-body pt-4 text-center">
          <h2 class="mb-0 mt-2 up"  style="color:white">Potentail Earnings</h2>
          <h1 class="mb-0 up" style="color:white">
            @php
                $sum = 0;
            @endphp
            @foreach (DB::table('rooms')->where('year', $viewingYear)->get() as $room_type)
            @php
            $sum += $room_type->price * DB::table('bed_spaces')->where('room_id', $room_type->id)->where('year', $viewingYear)->get()->count()
            @endphp
            @endforeach
            ₦{{ number_format($sum) }}
        </h1>
          <span class="badge badge-lg d-block bg-gradient-dark mb-2 p-3 text-lg up">{{ DB::table('bed_spaces')->where('year', $viewingYear)->get()->count() }} BED SPACES</span>
          <h5 class="font-weight-bolder mb-3">
            Occupied 
            <span class="font-weight-bolder">:</span>

            <span
                class="text-sm font-weight-bolder" style="color:white">
                @php
                $sum = 0;
            @endphp
            @foreach (DB::table('rooms')->get() as $room_type)
            @php
            $sum += $room_type->price * DB::table('bed_spaces')->where('room_id', $room_type->id)->whereNotNull('user_id')->where('allocated', true)->where('year', $viewingYear)->get()->count()
            @endphp
            @endforeach
            ₦{{ number_format($sum) }}
            </span>
        </h5>
          <a href="/bedspaces" class="btn btn-outline-white mb-2 px-5 up">View Bed Space</a>
        </div>
      </div>
    </div>
    <div class="col-lg-7 col-md-6 col-12 mt-4 mt-lg-0">
        <div class="row">

        
        @foreach (DB::table('rooms')->where('year', $viewingYear)->get() as $room_type)
        <div class="col-sm-6 mb-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">

                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ $room_type->name }}</p>
                                <h5 class="font-weight-bolder text-sm mb-0">
                                    {{ DB::table('bed_spaces')->where('room_id', $room_type->id)->where('year', $viewingYear)->get()->count() }}
                                    Bed 
                                    <span class="text-xl font-weight-bolder">/</span>

                                    ₦<span
                                        class="text-danger text-sm font-weight-bolder">
                                        {{ number_format(($room_type->price * DB::table('bed_spaces')->where('room_id', $room_type->id)->where('year', $viewingYear)->get()->count())) }}
                                    </span>
                                </h5>

                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <img alt="Image" src="{{ $room_type->photo ?? asset('assets/img/no-image.png') }}"
                                class="avatar">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
        </div>
    </div>
    
  </div>
    <div class="row my-4">
        <div class="col-sm-4">
            <div class="row">

                <div class="col-12 mt-3">
                    <div class="card card-background card-background-mask-primary move-on-hover align-items-start">
                        <div class="cursor-pointer">
                            <div class="full-background"
                                style="background-image: url('../assets/img/curved-images/curved1.jpg')"></div>
                            <div class="card-body">
                                <h5 class="mb-0" style="color:white">Total Revenue</h5>
                                <p class="text-sm"  style="color:white">Tenantapartment </p>
                                <h3 class="mb-0"  style="color:white">
                                    {{ App\Helper\Helper::currency(DB::table('invoices')->where('year', $viewingYear)->where('status', 'successful')->sum('amount')) }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="card move-on-hover">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total This Week</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ App\Helper\Helper::currency(
                                                DB::table('invoices')->where('year', $viewingYear)->where('status', 'successful')->select('*')->whereBetween('updated_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->sum('amount'),
                                            ) }}
                                            <span
                                                class="text-success text-sm font-weight-bolder">{{ App\Helper\Helper::percentage(
                                                    DB::table('invoices')->where('year', $viewingYear)->where('status', 'successful')->sum('amount'),
                                                    DB::table('invoices')->where('year', $viewingYear)->where('status', 'successful')->select('*')->whereBetween('updated_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->sum('amount'),
                                                ) }}</span>
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
                <div class="col-12 mt-3">
                    <div class="card move-on-hover">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total {{{ date('F') }}}</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ App\Helper\Helper::currency(DB::table('invoices')->where('year', $viewingYear)->where('status', 'successful')->whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y'))->sum('amount')) }}
                                            <span
                                                class="text-success text-sm font-weight-bolder">{{ App\Helper\Helper::percentage(
                                                    DB::table('invoices')->where('year', $viewingYear)->where('status', 'successful')->sum('amount'),
                                                    DB::table('invoices')->where('year', $viewingYear)->where('status', 'successful')->whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y'))->sum('amount'),
                                                ) }}</span>
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
                <div class="col-12 mt-3">
                    <div class="card move-on-hover">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Last Month ({{\Carbon\Carbon::now()->subMonth()->format('F')}})</p>
                                        <h5 class="font-weight-bolder mb-0">

                                            {{ App\Helper\Helper::currency(DB::table('invoices')->where('year', $viewingYear)->where('status', 'successful')->whereMonth('updated_at', '=', \Carbon\Carbon::now()->subMonth()->month)->sum('amount')) }}
                                            <span
                                                class="text-success text-sm font-weight-bolder">{{ App\Helper\Helper::percentage(
                                                    DB::table('invoices')->where('year', $viewingYear)->where('status', 'successful')->sum('amount'),
                                                    DB::table('invoices')->where('year', $viewingYear)->where('status', 'successful')->whereMonth('updated_at', '=', \Carbon\Carbon::now()->subMonth()->month)->sum('amount'),
                                                ) }}</span>
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
        </div>
        <div class="col-sm-8">
            <div class="card h-100 mb-4">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">Site Transaction's</h6>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <i class="far fa-calendar-alt me-2"></i>
                            <small></small>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">From Newest</h6>
                    <ul class="list-group">
                        @foreach (DB::table('rents')->where('year', $viewingYear)->where('proof_status', 'Approved')->orderBy('updated_at', 'DESC')->get()
        as $finance)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">

                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="fas fa-arrow-down"></i></button>
                                            <a href="/financial/{{$finance->id}}">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">
                                            {{ DB::table('users')->where('id', $finance->user_id)->value('first_name') }}
                                            {{ DB::table('users')->where('id', $finance->user_id)->value('middle_name') }}
                                            {{ DB::table('users')->where('id', $finance->user_id)->value('last_name') }}
                                            ({{ DB::table('rooms')->where('id', $finance->room_id)->value('name') }})</h6>
                                        <span
                                            class="text-xs">{{ \Carbon\Carbon::parse($finance->updated_at)->format('j M h:i A') }}</span>
                                    </div>
                                    </a>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{ App\Helper\Helper::currency($finance->price) }}
                                </div>
                            </li>
                        @endforeach


                </div>
            </div>
        </div>

    </div>

@endsection
