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
                <div class="col-lg-4 col-6 text-center">
                    <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                        <h6 class="text-primary text-gradient mb-0">Total Residents</h6>
                        <h4 class="font-weight-bolder"><span class="small">
                                {{ App\Models\BedSpace::whereNotNull('user_id')->where('year', $viewingYear)->count() }}
                            </span></h4>
                    </div>
                </div>
                <div class="col-lg-4 col-6 text-center">
                    <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                        <h6 class="text-primary text-gradient mb-0">Total Referrant</h6>
                        <h4 class="font-weight-bolder"><span class="small"> {{ DB::table('referrals_earnings')->count() }}
                            </span></h4>
                    </div>
                </div>
                <div class="col-lg-4 col-6 text-center mt-4 mt-lg-0">
                    <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                        <h6 class="text-primary text-gradient mb-0">Spent</h6>
                        <h4 class="font-weight-bolder"><span
                                class="small">₦{{ DB::table('referrals_payments')->sum('amount') }} </span></h4>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <h5>Settings</h5>
                    <p class="text-sm">Here you can setup and manage Referral Program.</p>
                </div>
                <div class="card-body pt-0">
                    <form action="/promo/update-referral" method="POST">
                        @csrf
                        <div class="d-flex mb-3">
                            <p class="mb-0" style="">Active</p>
                            <div class="form-check form-switch ms-auto">
                                <input class="form-check-input" name="referral_status" type="checkbox" id="referral_status"
                                    {{ DB::table('settings')->value('referral') ? 'checked' : '' }}>
                            </div>
                        </div>
                        {{-- <p class="mb-0 text-sm">You.</p> --}}

                        <hr class="horizontal dark">
                        <label class="form-label">Amount (₦)</label>
                        <div class="form-group">
                            <input id="" type="number" class="form-control" name="referral_amount"
                                required="" value="{{ DB::table('settings')->value('referral_amount') }}">
                        </div>
                        <hr class="horizontal dark">
                        <label class="form-label">Payable Amount (₦)</label>
                        <div class="form-group">
                            <input id="" type="number" class="form-control" name="referral_payable_amount"
                                required="" value="{{ DB::table('settings')->value('referral_payable_amount') }}">
                        </div>

                        <label class="form-label">Expiring Date</label>
                        <div class="form-group">
                            <input id="" type="date" class="form-control" name="referral_expiring_date"
                                value="{{ DB::table('settings')->value('referral_expiring_date') ? Carbon\Carbon::parse(DB::table('settings')->value('referral_expiring_date'))->format('Y-m-d') : '' }}">
                        </div>
                        <button class="btn bg-gradient-dark w-100 mb-0" type="submit">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6>Top Referred Users</h6>
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
                                        Total Earn</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Paid</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (DB::table('referrals_earnings')->get()->unique('referrer') as $get_user)
                                    @php
                                        $user = DB::table('users')
                                            ->where('id', $get_user->referrer)
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
                                                        <p class="text-sm font-weight-bold text-secondary mb-0"><span
                                                                class="text-success">{{ DB::table('referrals_earnings')->where('referrer', $get_user->referrer)->count() }}</span>
                                                            Referral </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                ₦{{ DB::table('referrals_earnings')->where('referrer', $get_user->referrer)->sum('amount') }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">
                                                ₦{{ DB::table('referrals_payments')->where('referrer_id', $get_user->referrer)->sum('amount') }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">
                                                ₦{{ DB::table('referrals_earnings')->where('referrer', $get_user->referrer)->sum('amount') -DB::table('referrals_payments')->where('referrer_id', $get_user->referrer)->sum('amount') }}
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
