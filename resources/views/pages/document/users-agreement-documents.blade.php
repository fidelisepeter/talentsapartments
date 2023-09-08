@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@php
$page_title = $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . ' Agreement Form';

$count_of_documents = $user->consent_document->count();
$count_of_completed_signed_documents = count($user->signed_documents()->where('lawyer_id', Auth::id())->where('signatures_status', 'completed')->where('stamps_status', 'completed')->where('names_status', 'completed')->get());
$count_of_incompleted_signed_documents = count($user->signed_documents()->where('lawyer_id', Auth::id())->where([
                        ['signatures_status', 'pending'],
                        [function ($query) {
                            $query->orWhere('stamps_status', 'pending')->get();
                            $query->orWhere('stamps_status', 'pending')->get();
                        }]
                    ])->get());
$count_of_pending_documents = $count_of_documents - ($count_of_completed_signed_documents+$count_of_incompleted_signed_documents);

@endphp
@section('page-title', $page_title)
@section('content')

    <div class="row">

        <div class="col-12 col-lg-4">
            <div class="card card-background card-background-mask-dark align-items-start">
                <div class="full-background cursor-pointer"
                    style="background-image: url('{{ $user->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}')"></div>
                <div class="card-body">
                    <h5 class="mb-0" style="color: white">
                        {{ $user->first_name ?? '' }}
                        {{ $user->middle_name ?? '' }}
                        {{ $user->last_name ?? '' }}
                    </h5>
                    <p class="text-sm">Resident</p>
                    <div class="d-flex mt-4 pt-2" style="color: white">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ $user->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                        <div class="h-100 ">
                            <h6 class="mb-1  mx-3" style="color: white">
                                {{ $user->phone_number ?? '' }}
                            </h6>
                            <p class="mb-0 mx-3 font-weight-bold text-sm" style="color: white">
                                {{ $user->email ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header pb-0">
                    <h6>Documents overview</h6>

                </div>
                <div class="card-body p-3">

                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                    <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        class="mt-1">
                                        <title>customer-support</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(1.000000, 0.000000)">
                                                        <path class="color-background"
                                                            d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"
                                                            opacity="0.59858631"></path>
                                                        <path class="color-foreground"
                                                            d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                                        </path>
                                                        <path class="color-foreground"
                                                            d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Total Documents</h6>
                                    <span class="text-xs font-weight-bold"> {{ $count_of_documents }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-warning shadow text-center">
                                    <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        class="mt-1">
                                        <title>customer-support</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(1.000000, 0.000000)">
                                                        <path class="color-background"
                                                            d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"
                                                            opacity="0.59858631"></path>
                                                        <path class="color-foreground"
                                                            d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                                        </path>
                                                        <path class="color-foreground"
                                                            d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Pending</h6>
                                    <span class="text-xs font-weight-bold">{{ $count_of_pending_documents }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-primary shadow text-center">
                                    <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        class="mt-1">
                                        <title>customer-support</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(1.000000, 0.000000)">
                                                        <path class="color-background"
                                                            d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"
                                                            opacity="0.59858631"></path>
                                                        <path class="color-foreground"
                                                            d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                                        </path>
                                                        <path class="color-foreground"
                                                            d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Incompleted</h6>
                                    <span class="text-xs font-weight-bold"> {{ $count_of_incompleted_signed_documents }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                                    <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        class="mt-1">
                                        <title>customer-support</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(1.000000, 0.000000)">
                                                        <path class="color-background"
                                                            d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"
                                                            opacity="0.59858631"></path>
                                                        <path class="color-foreground"
                                                            d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                                        </path>
                                                        <path class="color-foreground"
                                                            d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Completed</h6>
                                    <span class="text-xs font-weight-bold"> {{ $count_of_completed_signed_documents }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-8">

            <div class="card ">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h6 class="mb-0">Incompleted Signing and signatures</h6>
                            <p class="text-sm mb-0">
                                {{-- COunt: {{$users->count()}} --}}
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0">
                            <div class="ms-auto my-auto">
            
                                {{-- <a class="btn bg-gradient-primary btn-sm export mb-0 mt-sm-0 mt-1" href="/document/create">Create New User</a>
                      @if ($users->count() !== 0)
                          <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                              type="button" name="button">Export</button>
                      @endif --}}
            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table id="incompleted-table" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Document
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Signature Required</th>
            
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Stamp
                                        required</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Required Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        View</th>
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date uploaded</th> --}}
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th> --}}
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
            
                                @foreach ($documents as $document)
                    @php
                    
                        $signatures_count = $document->signature_config ? count(json_decode($document->signature_config) ?? []) : 0;
                        $stamp_count = $document->stamp_config ? count(json_decode($document->stamp_config) ?? []) : 0;
                        $name_count = $document->lawyer_name_config ? count(json_decode($document->lawyer_name_config) ?? []) : 0;
            
                    //     $count_of_incompleted_signed_documents = count($user->signed_documents()->where([
                    //     ['signatures_status', 'pending'],
                    //     [function ($query) {
                    //         $query->orWhere('stamps_status', 'pending')->get();
                    //         $query->orWhere('stamps_status', 'pending')->get();
                    //     }]
                    // ])->get());
                        

                        
                    @endphp
                    @if ($document->signed()->where([
                        ['user_id', $user->id],
                        [function ($query) {
                            $query->orWhere('signatures_status', 'pending')->get();
                            $query->orWhere('stamps_status', 'pending')->get();
                            $query->orWhere('names_status', 'pending')->get();
                        }]
                    ])->first() && $document->consent()->where('user_id', $user->id)->first())

                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
            
            
                                

                                @if (Auth::user()->hasRole('Lawyer'))
                                <a href="/resident/{{ $user->id }}/view/{{ $document->id }}">
                                    <h6 class="mb-0 text-sm">
                                        {{ $document->title?? '' }}
                
                                    </h6>
                                    </a>
                                    @else
                                    <h6 class="mb-0 text-sm">
                                            {{ $document->title?? '' }}
                    
                                        </h6>
                                @endif
            
                            </div>
                          </td>
                          <td>
                            <p class="text-sm text-secondary mb-0">{{ $signatures_count }}</p>
                          </td>
                        <td>
                          <p class="text-sm text-secondary mb-0">{{ $stamp_count }}</p>
                        </td>
                        <td>
                            <p class="text-sm text-secondary mb-0">{{ $name_count }}</p>
                          </td>
                          <td class="align-middle text-center">
                            <div class="d-flex align-items-center">
                              
                              <a class="text-dark text-sm mx-3" href="/document/print/{{ $document->id }}/user/{{ $user->id }}"> View Document</a>
                               
                            
                               
                            </div>
                        </td>
                      
                      </tr>
                    @endif
            
                    @endforeach
                  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            

            <div class="card mt-4">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h6 class="mb-0">Pending Documents</h6>
                            <p class="text-sm mb-0">
                                {{-- COunt: {{$users->count()}} --}}
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0">
                            <div class="ms-auto my-auto">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table id="pending-table" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Document
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Signature Required</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Stamp
                                        required</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Required Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status</th>
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date uploaded</th> --}}
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th> --}}
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th> --}}
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($documents as $document)
                    @php
                        $signatures_count = $document->signature_config ? count(json_decode($document->signature_config) ?? []) : 0;
                        $stamp_count = $document->stamp_config ? count(json_decode($document->stamp_config) ?? []) : 0;
                        $name_count = $document->lawyer_name_config ? count(json_decode($document->lawyer_name_config) ?? []) : 0;
                    @endphp
                    
                    @if ($document->signed()->where('user_id', $user->id)->first() == null  && $document->consent()->where('user_id', $user->id)->first()) 
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">


                                <a href="/resident/{{ $user->id }}/view/{{ $document->id }}">
                                <h6 class="mb-0 text-sm">
                                    {{ $document->title?? '' }}

                                </h6>
                                </a>

                            </div>
                          </td>
                          <td>
                            <p class="text-sm text-secondary mb-0">{{ $signatures_count }}</p>
                          </td>
                        <td>
                          <p class="text-sm text-secondary mb-0">{{ $stamp_count }}</p>
                        </td>
                        <td>
                            <p class="text-sm text-secondary mb-0">{{ $name_count }}</p>
                          </td>
                       
                          
                      </tr>
                    @endif
  
                    @endforeach
                  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h6 class="mb-0">Completed Documents</h6>
                            <p class="text-sm mb-0">
                                {{-- COunt: {{$users->count()}} --}}
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table id="completed-table" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Document
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Signature Required</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Stamp
                                        required</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Required Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        View</th>
                                    </tr>
                            </thead>
                            <tbody>

                                @foreach ($documents as $document)
                    @php
                    
                        // $signatures_count = count(json_decode($document->signature_config));
                        // $stamp_count = count(json_decode($document->stamp_config));;
                        // $name_count = count(json_decode($document->lawyer_name_config));;
                        
                        $signatures_count = $document->signature_config ? count(json_decode($document->signature_config) ?? []) : 0;
                        $stamp_count = $document->stamp_config ? count(json_decode($document->stamp_config) ?? []) : 0;
                        $name_count = $document->lawyer_name_config ? count(json_decode($document->lawyer_name_config) ?? []) : 0;
                        // $count_of_user_documents = $resident->user->consent_document->count();
                        
                    @endphp
                    @if ($document->signed()->where('user_id', $user->id)->where('signatures_status', 'completed')->where('stamps_status', 'completed')->where('names_status', 'completed')->first() && $document->consent()->where('user_id', $user->id)->first())
                 
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">


                                <a href="/resident/{{ $user->id }}/view/{{ $document->id }}">
                                <h6 class="mb-0 text-sm">
                                    {{ $document->title?? '' }}

                                </h6>
                                </a>

                            </div>
                          </td>
                          <td>
                            <p class="text-sm text-secondary mb-0">{{ $signatures_count }}</p>
                          </td>
                        <td>
                          <p class="text-sm text-secondary mb-0">{{ $stamp_count }}</p>
                        </td>
                        <td>
                            <p class="text-sm text-secondary mb-0">{{ $name_count }}</p>
                          </td>
                       
                          <td class="align-middle text-center">
                            <div class="d-flex align-items-center">
                              
                              <a class="text-dark text-sm mx-3" href="/document/print/{{ $document->id }}/user/{{ $user->id }}"> View Document</a>
                               
                            
                               
                            </div>
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
@section('script')
<script>
    // Limit user from selecting more than one user
    $(document).ready(function() {

        if (document.getElementById('pending-table')) {
        const pendingTableSearch = new simpleDatatables.DataTable("#pending-table", {
            searchable: true,
            fixedHeight: false,
            perPage: 2,
            paging: true,
            ordering: false,
            info: false,
            lengthChange: true,
            perPageSelect: [3, 5, 10, 15, 20, 25],
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
       
    }

        if (document.getElementById('completed-table')) {
        const completedTableSearch = new simpleDatatables.DataTable("#completed-table", {
            searchable: true,
            fixedHeight: false,
            perPage: 3,
            paging: true,
            ordering: false,
            info: false,
            lengthChange: true,
            perPageSelect: [3, 5, 10, 15, 20, 25],
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
    }
        if (document.getElementById('incompleted-table')) {
        const incompletedTableSearch = new simpleDatatables.DataTable("#incompleted-table", {
            searchable: true,
            fixedHeight: false,
            perPage: 3,
            paging: true,
            ordering: false,
            info: false,
            lengthChange: true,
            perPageSelect: [3, 5, 10, 15, 20, 25],
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
    
    };
    });
</script>
@endsection
