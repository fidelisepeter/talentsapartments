@extends('layouts.main')
@section('page-title', 'Referral Program')
@if (\App\Models\BedSpace::where(
    'id',
    DB::table('rents')->where('id', Auth::user()->current_rent)->value('bed_space'))->first() &&
    DB::table('rents')->where('id', Auth::user()->current_rent)->value('status') == 'Approved')
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
            <div class="card">
                <div class="card-header p-3">
                    <h5 class="mb-2">Referral Program</h5>
                    <p class="mb-0">Track and find all the details about our referral program, your stats and revenues.</p>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-3 col-6 text-center">
                            <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                <h6 class="text-primary text-gradient mb-0">TOTAL REFERRANT</h6>
                                <h4 class="font-weight-bolder"><span class="small">
                                        {{ DB::table('referrals_earnings')->where('referrer', $user->id)->count() }}
                                    </span></h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 text-center">
                            <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                <h6 class="text-primary text-gradient mb-0">TOTAL EARN</h6>
                                <h4 class="font-weight-bolder"><span class="small">
                                        ₦{{ DB::table('referrals_earnings')->where('referrer', $user->id)->sum('amount') }}
                                    </span></h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 text-center">
                            <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                <h6 class="text-primary text-gradient mb-0">Total PAID</h6>
                                <h4 class="font-weight-bolder"><span class="small">
                                        ₦{{ DB::table('referrals_payments')->where('referrer_id', $user->id)->sum('amount') }}
                                    </span></h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 text-center mt-4 mt-lg-0">
                            <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                <h6 class="text-primary text-gradient mb-0">BALANCE</h6>
                                <h4 class="font-weight-bolder"><span class="small">
                                        ₦{{ DB::table('referrals_earnings')->where('referrer', $user->id)->sum('amount') -DB::table('referrals_payments')->where('referrer_id', $user->id)->sum('amount') }}
                                    </span></h4>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-5 col-12">
                            <h6 class="mb-0">Referral Code</h6>
                            <p class="text-sm">Copy the code/link bellow to who you want to refer to us.</p>
                            <div class="p-3">
                                {{-- <p class="text-xs mb-2">Generated 23 days ago by <span class="font-weight-bolder">softuidash23</span></p> --}}
                                @if (!empty($user->referral_code))
                                    <span class="font-weight-bolder">Code</span>
                                    <div class="d-flex align-items-center">
                                        <div class="form-group w-70">
                                            <div class="input-group bg-gray-200">
                                                <input class="form-control form-control-sm"
                                                    value="{{ $user->referral_code }}" type="text" readonly=""
                                                    id="ref-code">
                                                <span class="input-group-text bg-transparent" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Copy referal link/url to who you want to refer"><i
                                                        class="ni ni-key-25"></i></span>
                                            </div>
                                        </div>
                                        <a href="javascript:;" id="copy-code"
                                            class="btn btn-sm btn-outline-secondary ms-2 px-3">Copy</a>
                                    </div>

                                    <span class="font-weight-bolder mt-2">Url</span>
                                    <div class="d-flex align-items-center">
                                        <div class="form-group w-70">
                                            <div class="input-group bg-gray-200">
                                                <input class="form-control form-control-sm"
                                                    value="{{ url('register/') }}?ref={{ $user->referral_code }}" type="text"
                                                    readonly="" id="ref-url">
                                                <span class="input-group-text bg-transparent" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Copy referal link/url to who you want to refer"><i
                                                        class="ni ni-key-25"></i></span>
                                            </div>
                                        </div>
                                        <a href="javascript:;" id="copy-url"
                                            class="btn btn-sm btn-outline-secondary ms-2 px-3">Copy</a>
                                    </div>
                                    <p class="text-xs mb-1">You cannot generate codes again.</p>
                                @else
                                    <div class="text-center">
                                        <p class="text-xs mb-1">You have not generated any code yet, click the button to
                                            generate a referral code.</p>
                                        <a href="/generate-referral-code"
                                            class="btn btn-sm btn-outline-secondary mt-2 ms-2 px-3">Generate Referral
                                            Code</a>

                                    </div>
                                @endif
                                {{-- <p class="text-xs mb-0"><a href="javascript:;">Contact us</a> to generate more referrals link.</p> --}}
                            </div>
                        </div>
                        <div class="col-lg-7 col-12 mt-4 mt-lg-0">
                            <div class="card border-dashed border-1 border-secondary mb-4">
                                <div class="card-header pb-0 p-3">
                                    <h6>Transactions</h6>
                                </div>
                                <div class="card-body px-0 pt-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table id="transaction-table" class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Transaction type
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Amount</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Transaction Date</th>
                                                    {{-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            </th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transactions as $transaction)
                                                    @php
                                                        if (isset($transaction->referrer)) {
                                                            $user_id = $transaction->referrer;
                                                        } elseif (isset($transaction->referrer_id)) {
                                                            $user_id = $transaction->referrer_id;
                                                        }
                                                        $user = DB::table('users')
                                                            ->where('id', $user_id)
                                                            ->first();
                                                    @endphp
                                                    <tr>
                                                        {{-- <td>
                                                <a href="/promo/referrer/{{ $user->id ?? '' }}">
                                                    <div class="d-flex px-3 py-1">
    
                                                        <div>
                                                            <img src="{{ $user->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                                                                class="avatar me-3" alt="avatar image">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $user->first_name ?? '' }}
                                                                {{ $user->middle_name ?? '' }}
                                                                {{ $user->last_name ?? '' }}
                                                            </h6>
                                                            <p class="text-sm font-weight-bold text-secondary mb-0"><span
                                                                    class="text-success">{{ DB::table('referrals_earnings')->where('referrer', $get_user->referrer)->count() }}</span>
                                                                Referral </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td> --}}
                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0">

                                                                @if (isset($transaction->paid_at) && isset($transaction->referrer_id))
                                                                    Payment
                                                                @else
                                                                    Referral Earning -
                                                                    @if (App\Models\BedSpace::where('user_id', $transaction->referent)->count() > 0)
                                                                        <a
                                                                            href="/resident/{{ $transaction->referent ?? '' }}">{{ DB::table('users')->where('id', $transaction->referent)->value('first_name') ?? '' }}
                                                                            {{ DB::table('users')->where('id', $transaction->referent)->value('middle_name') ?? '' }}
                                                                            {{ DB::table('users')->where('id', $transaction->referent)->value('last_name') ?? '' }}
                                                                        </a>
                                                                    @else
                                                                        {{ DB::table('users')->where('id', $transaction->referent)->value('first_name') ?? '' }}
                                                                        {{ DB::table('users')->where('id', $transaction->referent)->value('middle_name') ?? '' }}
                                                                        {{ DB::table('users')->where('id', $transaction->referent)->value('last_name') ?? '' }}
                                                                    @endif
                                                                @endif
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <p class="text-sm font-weight-bold mb-0">
                                                                ₦{{ $transaction->amount }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <p class="text-sm font-weight-bold mb-0">
                                                                @if (isset($transaction->paid_at) && isset($transaction->referrer_id))
                                                                    {{ Carbon\Carbon::parse($transaction->paid_at)->format('d/m/Y') }}
                                                                @else
                                                                    {{ Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y') }}
                                                                @endif
                                                                {{-- ₦{{ DB::table('referrals_earnings')->where('referrer', $get_user->referrer)->sum('amount') -DB::table('referrals_payments')->where('referrer_id', $get_user->referrer)->sum('amount') }} --}}
                                                            </p>
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
                    <hr class="horizontal dark">
                    <div class="row mt-4">
                        <h6 class="mb-2">Other promo</h6>
                        @foreach (App\Models\Promo::where('show', true)->where('active', true)->get() as $promo)
                            @php
                                $room_data = json_decode($promo->promo_data, true);
                                if ($promo->promo_type == 'special') {
                                    $image = DB::table('rooms')
                                        ->where('id', $room_data['room_id'])
                                        ->value('photo');
                                }
                                
                                $image = $image ?? '';
                            @endphp
                            {{-- @dd(DB::table('rooms')->where('id', $room_data['room_id'])->value('photo')) --}}
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card bg-gradient-primary text-center">
                                    <div class="overflow-hidden position-relative border-radius-lg bg-cover p-3"
                                        style="background-image: url('{{ $image }}')">
                                        <span class="mask bg-gradient-dark opacity-6"></span>
                                        <div class="card-body position-relative z-index-1 d-flex flex-column mt-5">
                                            <p class="font-weight-bolder" style="color: white;">{{ $promo->description }}.
                                            </p>
                                            <span class="mt-4" style="color: white;">Use Promo Code</span>
                                            <h4 class="font-weight-bold mb-0 icon-move-right " style="color: white;"
                                                href="javascript:;">
                                                #{{ $promo->promo_code }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                                $image = '';
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6>Referred Users</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="referral-table" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Residents
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Active on</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Earning</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (DB::table('referrals_earnings')->where('referrer', $user->id)->get() as $get_user)
                                    @php
                                        $user = DB::table('users')
                                            ->where('id', $get_user->referent)
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="/promo/referrer/{{ $user->id ?? '' }}">
                                                <div class="d-flex px-3 py-1">

                                                    <div>
                                                        <img src="{{ $user->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                                                            class="avatar me-3" alt="avatar image">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $user->first_name ?? '' }}
                                                            {{ $user->middle_name ?? '' }}
                                                            {{ $user->last_name ?? '' }}
                                                        </h6>
                                                        <p class="text-sm font-weight-bold text-secondary mb-0">
                                                            Joined
                                                            {{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ Carbon\Carbon::parse($get_user->created_at)->format('d/m/Y') }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">
                                                ₦{{ $get_user->amount }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">
                                                Active
                                            </p>
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
        $(document).ready(function() {

            function copyToClipboard(text) {
                // alert("Copied the text: " + text);
                // Get the text field
                // var copyText = document.getElementById(id);

                // // Select the text field
                // copyText.select();
                // copyText.setSelectionRange(0, 99999); // For mobile devices

                // Copy the text inside the text field
                navigator.clipboard.writeText(text);

                // Alert the copied text
                alert("Copied the text: " + text);
            }

            // $("#promo_code").on('change', function() {
            //     percentage_off();
            // });

            $("#copy-code").on('click', function() {
                let copyTextarea = document.querySelector('#ref-code');
                copyTextarea.focus();
                copyTextarea.select();
                // Copy the text inside the text field
                navigator.clipboard.writeText(copyTextarea.value);
                try {
                    let successful = document.execCommand('copy');
                    let msg = successful ? 'successful' : 'unsuccessful';
                    alert('Copy text command was ' + msg);
                } catch (err) {
                    alert('Unable to copy');
                }
                // copyToClipboard('{{ $user->referral_code }}');
            })
            $("#copy-url").on('click', function() {
                let copyTextarea = document.querySelector('#ref-url');
                copyTextarea.focus();
                copyTextarea.select();
                navigator.clipboard.writeText(copyTextarea.value);
                try {
                    let successful = document.execCommand('copy');
                    let msg = successful ? 'successful' : 'unsuccessful';
                    alert('Copy text command was ' + msg);
                } catch (err) {
                    alert('Unable to copy');
                }
                // copyToClipboard('{{ $user->referral_code }}');
            })


            if (document.getElementById('transaction-table')) {
                const dataTableSearch = new simpleDatatables.DataTable("#transaction-table", {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 3,
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
                            filename: "referrals-talentapartment-" +
                                type,
                        };

                        if (type === "csv") {
                            data.columnDelimiter = "|";
                        }

                        dataTableSearch.export(data);
                    });
                });
            };

            if (document.getElementById('referral-table')) {
                const dataTableSearch = new simpleDatatables.DataTable("#referral-table", {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 3,
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
                            filename: "referrals-talentapartment-" +
                                type,
                        };

                        if (type === "csv") {
                            data.columnDelimiter = "|";
                        }

                        dataTableSearch.export(data);
                    });
                });
            };

        });
    </script>
@endsection
