@extends('layouts.main')
@section('page-title', 'Referral Program')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
    {{-- Stay --}}
@else
    {{ Session::flash('error', 'You are not permited to view that page') }}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@section('content')
    <div class="card mt-3">
        <div class="card-body p-3 position-relative">
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
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <h5>Payments</h5>
                    <p class="text-sm">Here you can Here you can pay resident their referral balance.</p>
                    @if (DB::table('settings')->value('referral_payable_amount') >
                        DB::table('referrals_earnings')->where('referrer', $user->id)->sum('amount') -
                            DB::table('referrals_payments')->where('referrer_id', $user->id)->sum('amount'))
                        <p class="text-sm text-danger">
                            Resident balance has not reach the payable amount
                        </p>
                    @endif

                </div>
                <div class="card-body pt-0">
                    <form action="/promo/make-referral-payment" method="POST">
                        @csrf
                        <input type="hidden" name="resident_id" value="{{ $user->id }}">
                        <label class="form-label">Amount (₦)</label>
                        <div class="form-group">
                            <input id="percentage_off" type="number" class="form-control" name="payment_amount"
                                required=""
                                value="{{ DB::table('referrals_earnings')->where('referrer', $user->id)->sum('amount') -DB::table('referrals_payments')->where('referrer_id', $user->id)->sum('amount') }}"
                                max="{{ DB::table('referrals_earnings')->where('referrer', $user->id)->sum('amount') -DB::table('referrals_payments')->where('referrer_id', $user->id)->sum('amount') }}"
                                min="{{ DB::table('settings')->value('referral_payable_amount') }}">
                        </div>
                        <hr class="horizontal dark">
                        {{-- <label class="form-label">Payable Amount (₦)</label>
                        <div class="form-group">
                            <input id="percentage_off" type="number" class="form-control" name="referral_payable_amount"
                                required="" value="{{ DB::table('settings')->value('referral_payable_amount') }}">
                        </div> --}}
                        <button class="btn bg-gradient-dark w-100 mb-0" type="submit">Pay Resident</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6>Transactions</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="referral-table" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Transaction type
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
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
                                                    <a href="/resident/{{ $transaction->referent ?? '' }}">{{ DB::table('users')->where('id', $transaction->referent)->value('first_name') ?? '' }}
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {

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
