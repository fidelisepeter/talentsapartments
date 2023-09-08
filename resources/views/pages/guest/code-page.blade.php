@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('style')
@endsection
@section('page-title', 'Guest Code Page')
@section('content')

    <div class="container-fluid">
        {{-- <h2 class="text-center display-4">Search Guest</h2> --}}
        <div class="text-center">
            <img class="img-fluid" src="{{ asset('logo-transparent.png')}}" alt="" style="width:12.5rem">
        </div>
        <div class="row m-auto mt-5">
            <div class="col-md-8 offset-md-2">
               
                <form action="" method="GET">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text text-dark bg-transparent border-1 border-right-1 ">
                            <h6 class="font-weight-bolder mb-0">Search</h6>
                        </span>
                        <input type="text" name="_" style="border-radius: 0px !important;" class="px-3 form-control bg-transparent " placeholder="Type guest code here.." onfocus="focused(this)" onfocusout="defocused(this)">
                        
                            <button type="submit" class="btn bg-gradient-dark px-sm-3 px-lg-5 text-white border-1  btn-link text-dark" style="border: 1px !important; border-top-left-radius: 0px !important; border-bottom-left-radius: 0px !important;">
                                <i class="fa fa-search"></i>
                            </button>
                        
                    </div>
                  
                </form>
                <div class="text-center mt-3">
                    {{-- <div class="align-items-center">
                        <a href="/dashboard">
                            <span class="badge badge bg-gradient-dark"><i class="fa fa-home"></i> Home</span>
                        </a>

                        <a href="/guest">
                            <span class="badge badge bg-gradient-primary ms-2"><i class="fa fa-users"></i> Guests</span>
                        </a>

                        <a href="/guest/code-page">
                            <span class="badge badge bg-gradient-danger ms-2"><i class="fa fa-times"></i> Clear</span>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row m-auto mt-7">
        <div class="col-sm-10 m-auto">
            @if (isset($hasResult))


                <div class="card">
                    <div class="card-body">
                        @if (isset($matched))


                            <h5 class="mb-4">Matched
                                @if ($matched->status == 'closed')
                                    <span class="text-warning text-xxs">Closed </span>
                                @elseif ($matched->date && \Carbon\Carbon::parse($matched->date)->format('d-m-Y') == date('d-m-Y'))
                                    <span
                                        class="text-success text-xxs">{{ $matched->status == 'ongoing' ? 'Ongoing...' : 'Expecting' }}</span>
                                @else
                                    <span class="text-danger text-xxs">Not Expecting</span>
                                @endif
                            </h5>
                            <div class="row">
                                <div class="col-xl-5 col-lg-6">
                                    <div class="text-center">
                                        <h5>Guest Details</h5>
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                    class="text-dark">Full Name:</strong>
                                                <br>&nbsp;{{ $matched->first_name }} {{ $matched->last_name }}
                                            </li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Mobile:</strong><br> &nbsp;
                                                {{ $matched->phone_number }}</li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Email:</strong> <br>&nbsp; {{ $matched->email }}</li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Type:</strong><br> &nbsp; {{ $matched->type }}</li>

                                        </ul>
                                    </div>
                                    <div>
                                        <ul class="list-group">

                                            <li
                                                class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">

                                                <hr class="horizontal dark mt-3 mb-2">
                                                <div class="d-flex">
                                                    <div class="d-flex align-items-center">
                                                        <button
                                                            class="btn btn-icon-only btn-rounded @if ($matched->date && \Carbon\Carbon::parse($matched->date)->format('d-m-Y') == date('d-m-Y')) btn-outline-success
                                            @else
                                            btn-outline-danger @endif mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                                                            @if ($matched->status == 'closed')
                                                                <i class="fas fa-times"></i>
                                                            @elseif ($matched->date && \Carbon\Carbon::parse($matched->date)->format('d-m-Y') == date('d-m-Y'))
                                                                <i class="fas fa-check"></i>
                                                            @else
                                                                <i class="fas fa-times"></i>
                                                            @endif
                                                        </button>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-1 text-dark text-sm">Expected Date</h6>
                                                            <span
                                                                class="text-xs">{{ $matched->date ? Carbon\Carbon::parse($matched->date) : '' }}
                                                                @if ($matched->status == 'closed')
                                                                    [closed]
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">

                                                    </div>
                                                </div>
                                                <hr class="horizontal dark mt-3 mb-2">
                                            </li>

                                            {{-- <li class="list-group-item border-0 justify-content-between ps-0 mb-2 border-radius-lg">
                                      <div class="d-flex">
                                        <div class="d-flex align-items-center">
                                          <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times"></i></button>
                                          <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Services</h6>
                                            <span class="text-xs">07 June 2021, at 07:10 PM</span>
                                          </div>
                                        </div>
                                        <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                                        
                                        </div>
                                      </div>
                                    </li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-5 mx-auto">
                                    <h3 class="mt-lg-0 mt-4">{{ $matched->user->first_name }}
                                        {{ $matched->user->middle_name }} {{ $matched->user->last_name }}</h3>
                                    <p class="">
                                        {{ $matched->user->bedspace->room->name }},
                                        {{ $matched->user->bedspace->building_name }}

                                    </p>
                                    <br>
                                    <h6 class="mb-0">Room Number</h6>
                                    <h5 class="opacity-7">{{ $matched->user->bedspace->room_number }}</h5>

                                    <h6 class="mb-0">Mobile Number</h6>
                                    <h5 class="opacity-7">{{ $matched->user->phone_number }}</h5>

                                    <div class="row mt-4">
                                        @if ($matched->date && \Carbon\Carbon::parse($matched->date)->format('d-m-Y') == date('d-m-Y'))
                                            <div class="col-lg-5">
                                                <a class="btn bg-gradient-success mb-0 mt-lg-auto w-100"
                                                    href="tel:{{ $matched->user->phone_number }}" name="button">Call
                                                    Resident</a>

                                            </div>

                                            <div class="col-lg-5">
                                                <form action="/guest/{{ $matched->id }}/signing" method="POST">
                                                    @csrf

                                                    @if (empty($matched->visit_start))
                                                        <input type="hidden" name="type" value="sign-in">
                                                        <input type="hidden" name="id" value="{{ $matched->id }}">
                                                        <button class="btn bg-gradient-primary mb-0 mt-lg-auto w-100"
                                                            type="submit">Sign-In Guest</button>
                                                    @elseif (!empty($matched->visit_start) && empty($matched->visit_end))
                                                        <input type="hidden" name="type" value="sign-out">
                                                        <input type="hidden" name="id" value="{{ $matched->id }}">
                                                        <button class="btn btn-outline-primary mb-0 mt-lg-auto w-100"
                                                            type="submit">Sign
                                                            Guest Out</button>
                                                    @else
                                                        <button
                                                            class="btn bg-gradient-primary mb-0 mt-lg-auto w-100 opacity-2"
                                                            href="tel:{{ $matched->user->phone_number }}" name="button"
                                                            disabled>Sign-In Guest</button>
                                                    @endif


                                                </form>
                                            </div>
                                        @else
                                            <div class="col-lg-5">
                                                <button class="btn bg-gradient-primary mb-0 mt-lg-auto w-100 opacity-2"
                                                    href="tel:{{ $matched->user->phone_number }}" name="button"
                                                    disabled>Sign-In Guest</button>
                                            </div>
                                            <div class="col-lg-5">

                                                <button class="btn btn-outline-primary mb-0 mt-lg-auto w-100  opacity-2"
                                                    href="tel:{{ $matched->user->phone_number }}" name="button"
                                                    disabled>Sign Guest Out</button>

                                            </div>
                                        @endif


                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            @else
                <h5 class="mb-4">Not Found Match</h5>
            @endif
        </div>
        @endif
    </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {



        });
    </script>
@endsection
