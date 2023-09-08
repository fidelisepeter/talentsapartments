@extends('layouts.main')
@section('page-title', 'Rentals')
@section('content')
<div class="row">
    <div class="col-12">
        @if (!empty(DB::table('rents')->where('id', auth()->user()->current_rent)->value('expiring_date')) && DB::table('rents')->where('id', auth()->user()->current_rent)->value('expiring_date') < \Carbon\Carbon::now())
        <div class="text-center text-danger h2">
            Your Room Rent Has Expired
        </div>
        <div class="text-center">
           Book again to keep enjoying a comfortable living
        </div>
        <div class="text-center text-danger">
            If you don't book now someone else might take your place <br>

            <a class="btn mt-3 btn-danger btn-lg" href="/book"
                class="text-white font-weight-bold text-xs" data-toggle="tooltip"
                data-original-title="Edit user" disabled>
                Book A New Room
            </a>

         </div>


<style>

</style>
        @endif

    </div>
</div>
<div class="row">
    <div class="col-12 " disabled >
        <div class="card mb-4 ">
            <div class="card-header pb-0">
                <h6>My Rentals</h6>
            </div>
            <div class="overlay card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Session</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Room</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Amount</th>

                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Payment</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Guarantor</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Health</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Attestation</th>
                                {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Booked</th> --}}
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Date Approved</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    view</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach (DB::table('rents')->where('user_id',Auth::user()->id)->get() as $rent)

                            <tr>
                                
                                <td class="text-center text-sm">
                                    <span class="text-secondary text-xs font-weight-bold">
                                        {{$rent->year}}
                                    </span>
                                </td>
                                <td class="text-center text-sm">
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">
                                                {{DB::table('rooms')->where('id',$rent->room_id)->value('name')}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">N {{$rent->price}}</p>
                                </td>
                                <td class="text-center text-sm">
                                    <span
                                    class="badge badge-sm @if ($rent->proof_status == 'Pending') bg-gradient-primary @elseif ($rent->proof_status == 'Approved') bg-gradient-success @elseif ($rent->proof_status == 'Rejected') bg-gradient-danger @else bg-gradient-secondary @endif">{{$rent->proof_status ?? "processing"}}</span>
                                    
                                </td>
                                <td class="text-center text-sm">
                                    <span
                                        class="badge badge-sm @if ($rent->guarantor_letter_status == 'Pending') bg-gradient-primary @elseif ($rent->guarantor_letter_status == 'Approved') bg-gradient-success @elseif ($rent->guarantor_letter_status == 'Rejected') bg-gradient-danger @else bg-gradient-secondary @endif">{{$rent->guarantor_letter_status ?? "processing"}}</span>
                                        
                                    
                                </td>
                                <td class="text-center text-sm">
                                    <span
                                        class="badge badge-sm @if ($rent->health_check_status == 'Pending') bg-gradient-primary @elseif ($rent->health_check_status == 'Approved') bg-gradient-success @elseif ($rent->health_check_status == 'Rejected') bg-gradient-danger @else bg-gradient-secondary @endif">{{$rent->health_check_status ?? "processing"}}</span>
                                        
                                  
                                </td>
                                <td class="text-center text-sm">
                                    <span
                                        class="badge badge-sm @if ($rent->attestation_letter_status == 'Pending') bg-gradient-primary @elseif ($rent->attestation_letter_status == 'Approved') bg-gradient-success @elseif ($rent->attestation_letter_status == 'Rejected') bg-gradient-danger @else bg-gradient-secondary @endif">{{$rent->attestation_letter_status ?? "processing"}}</span>
                                        
                                    
                                    </td>
                                {{-- <td class="text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{$rent->created_at ?? '-'}}</span>
                                </td> --}}
                                <td class="text-center">
                                    <span class="text-secondary text-xs font-weight-bold">
                                        {{ $rent->updated_at ? \Carbon\Carbon::parse($rent->updated_at) : '-'}}
                                    </span>
                                </td>

                                <td class="text-center text-sm">
                                    @if (!empty($rent->expiring_date) && $rent->expiring_date < \Carbon\Carbon::now())
                                <a class="btn btn-danger btn-sm" href="booking/{{$rent->id}}/renew"
                                    class="text-white font-weight-bold text-xs" data-toggle="tooltip"
                                    data-original-title="Renew Rent">
                                    Expired
                                </a>
                               
                                @else
                                <a class="btn text-sm btn-info btn-sm" href="booking/{{$rent->id}}"
                                    class="text-primary font-weight-bold text-xs btn-sm" data-toggle="tooltip"
                                    data-original-title="View Rent Details">
                                    view
                                </a>
                                @endif
                                </td>

                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <!-- here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
