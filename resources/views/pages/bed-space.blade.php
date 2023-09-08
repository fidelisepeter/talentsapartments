@extends('layouts.main')
@section('page-title', 'Bed Spaces')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
    {{-- Stay --}}
@else
    {{ Session::flash('error', 'You are not permited to view that page') }}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@section('content')

    <div class="row mt-3">
        <div class="col-xl-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">

                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Grand Total</p>
                                <h5 class="font-weight-bolder text-xs mb-0">
                                    {{ count(\App\Helpers\Rooms::allRooms()) }}
                                    Rooms
                                    <span class="text-xl font-weight-bolder">/</span>

                                    <span
                                        class="text-danger text-xs font-weight-bolder">{{ DB::table('bed_spaces')->where('year', $viewingYear)->get()->count() }}
                                        Bed Space</span>
                                        <span class="text-xl font-weight-bolder">/</span>
                                            <span
                                            class="text-dark text-xs font-weight-bolder">
                                            {{ DB::table('bed_spaces')->whereNull('user_id')->where('allocated', false)->get()->count() }} Available</span>
                                        
                                </h5>

                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            {{-- <img alt="Image" src="{{ $room_type->photo ?? asset('assets/img/no-image.png') }}"
                                class="avatar"> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($room_types as $room_type)
            <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">

                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ $room_type->name }}</p>
                                    <h5 class="font-weight-bolder text-xs mb-0">
                                        {{ DB::table('bed_spaces')->where('room_id', $room_type->id)->where('year', $viewingYear)->get()->unique('room_number')->count() }}
                                        Rooms
                                        <span class="text-xl font-weight-bolder">/</span>

                                        <span
                                            class="text-danger text-xs font-weight-bolder">
                                            {{ DB::table('rents')->where('room_id', $room_type->id)->where('status', 'Approved')->where('year', $viewingYear)->get()->count() }}
                                            Bed Space</span>
                                            <span class="text-xl font-weight-bolder">/</span>
                                            <span
                                            class="text-dark text-xs font-weight-bolder">
                                            {{ $room_type->available }} Available</span>
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


    <div class="card card-body blur shadow-blur overflow-hidden mt-3">
        <div class="row gx-4">
            <div class="row">
                <div class="col-lg-6 col-7">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <span class="d-sm-inline d-none text-body font-weight-bold px-3">Select Room to view </span>

                        <form action="/bedspaces" method="post">
                            @csrf
                            <select class="form-control" name="sortbyRoom" onchange="this.form.submit()">
                                <option>--select--</option>
                                @foreach (\App\Models\BedSpace::orderBy('room_number', 'asc')->where('year', $viewingYear)->get()->unique('room_number') as $view)
                                    @php
                                        $display_name = $current->display_name ?? isset($alt_view->display_name);
                                        $viewName = $view->room_number . ' - ' . $view->room->name;
                                    @endphp
            
            

            
                                    <option value="{{ $view }}" @if (isset($display_name) && $viewName == $display_name) selected @endif>
                                        {{ $viewName }}</option>
                                @endforeach

                            </select>


                        </form>
                        {{-- {{$viewName}}
                        {{$display_name}} --}}

                    </div>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                    <button href="" type="button" class="btn btn-primary mb-0" data-toggle="modal"
                        data-target="#newBedspace">New Bed Space</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        {{-- <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count($bedspaces) }}
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
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Allocated</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $allocated }}
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
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Free Bed</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $freespace }}
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
        </div> --}}
        {{-- <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Rooms</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::allRooms()) }}
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
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Bedspace</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ DB::table('bed_spaces')->get()->count() }}
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
        </div> --}}
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row m-3">
                    <div class="col-12 ">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <span
                                class="d-sm-inline d-none text-body text-sm font-weight-bold px-3">{{ $current->display_name ?? isset($alt_view->display_name) }}
                                bedspace list</span>
        
        
        
                        </div>
                    </div>
        
                </div>
              <div class="table-responsive">
                <table class="table table-flush" >
                  <thead class="thead-light">
                    <tr>
                      <th class="text-sm">Bed Number/Name</th>
                      <th class="text-sm">Room</th>
                      <th class="text-sm">Resident</th>
                      <th class="text-sm"></th>
        
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($bedspaces as $bedspace)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
        
                          <p class="text-xs font-weight-bold ms-2 mb-0">{{ $bedspace->name }}</p>
                          {{-- <img src="{{ $bedspace->room->photo ?? asset('assets/img/no-image.PNG') }}" class="avatar avatar-xs me-2" alt="user image"> --}}
                          
                        </div>
                      </td>
                      <td class="text-xs font-weight-bold">
                        <div class="d-flex align-items-center">
                          <img src="{{ $bedspace->room->photo ?? asset('assets/img/no-image.PNG') }}" class="avatar avatar-xs me-2" alt="user image">
                          {{-- <span>
                            {{ $bedspace->room_number ?? '' }} - {{ $bedspace->room->name ?? '' }} ({{ $bedspace->building_name ?? '' }})
                          </span> --}}
                            <p class="text-xs font-weight-bold mb-0">{{ $bedspace->building_name }}, {{ $bedspace->room_label }}</p>
                            <p class="text-xs text-secondary mb-0">{{ $bedspace->room_number }}, {{ $bedspace->room->name }}, {{ $bedspace->name }}</p>
                            </div>
                      </td>
                      <td class="text-xs font-weight-bold">
                        <div class="d-flex align-items-center">
                          @if ($bedspace->user != null)
                          <a href="/resident/{{ $bedspace->user->id ?? '' }}"
                            class="avatar avatar-xs rounded-circle text-dark" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="" data-bs-original-title="">
                            <img src="{{ $bedspace->user->photo ?? '' }}" alt=" ">
                            <span>
                              {{ $bedspace->user->first_name ?? '' }}
                              {{ $bedspace->user->middle_name ?? '' }}
                              {{ $bedspace->user->last_name ?? '' }}
                            </span>
                          </a>
                          @else
                          <span>Not Yet Allocated</span>
                          @endif
        
                        </div>
                      </td>
        
                      <td class="text-xs font-weight-bold">
                        <span class="my-2 text-xs">
                          @if ($bedspace->user == null)
                          <a href="/delete_bed_space/{{ $bedspace->id }}" class="text-danger font-weight-bold text-xs"
                            data-toggle="tooltip" data-original-title="Edit user">
                            Delete
                          </a>
                          <a href="/bedspace/{{ $bedspace->id }}" class="text-primary font-weight-bold text-xs"
                            data-toggle="tooltip" data-original-title="Edit user">
                            Update
                          </a>
                          @else
                          <a href="/bedspace/{{ $bedspace->id }}/remove-resident" class="text-primary font-weight-bold text-xs"
                            data-toggle="tooltip" data-original-title="Removr resident from the bedspace. please note that resident will not be allocated to any other bed space which means you have to go to resident booking details and re-assign a bed to the resident again">
                            Remove Resident
                          </a>
                          @endif
                        </span>
                      </td>
        
                    </tr>
                    @endforeach
        
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <div class="modal fade" id="newBedspace" tabindex="-1" role="dialog" aria-labelledby="newBedspace"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card shadow ">
                            <div class="card-header  p-3">
                                <h6 class="mb-0">Create Bed Space</h6>
                            </div>
                            <div class="card-body p-3 pt-0">
                                <form method="POST" action="create_bedspace" enctype="multipart/form-data">@csrf

                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                        Room Number</h6>
                                    <div class="border-0 px-0 text-sm mb-3 mt-3">
                                        <select class="form-control" name="room_number" id="room_number">
                                            <option disabled selected>--Select Room Number--
                                            </option>
                                            @for ($room_number = 001; $room_number <= 200; $room_number++)
                                                @php
                                                    $check = App\Models\BedSpace::where('room_number', 'Room ' . str_pad($room_number, 3, '0', STR_PAD_LEFT))->where('year', $viewingYear)->first();
                                                    
                                                @endphp
                                                <option value="Room {{ str_pad($room_number, 3, '0', STR_PAD_LEFT) }}">
                                                    Room {{ str_pad($room_number, 3, '0', STR_PAD_LEFT) }} @if ($check)
                                                        | {{ $check->room->name }} |
                                                        {{ App\Models\BedSpace::where('room_number', 'Room ' . str_pad($room_number, 3, '0', STR_PAD_LEFT))->get()->count() }}
                                                    @endif
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                        Room Type</h6>
                                    <div class="border-0 px-0 text-sm mb-3 mt-3">


                                        <select class="form-control" name="type" id="type">
                                            <option disabled selected>--Select Room Type--
                                            </option>
                                            @foreach (DB::table('rooms')->where('year', $viewingYear)->get() as $room_type)
                                                <option value="{{ $room_type->id }}">
                                                    {{ $room_type->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                        Building Name</h6>
                                    <div class="border-0 px-0 text-sm mb-3 mt-3">
                                        <select class="form-control" name="building_name">
                                            <option disabled selected>--Select --
                                            </option>
                                            @foreach (DB::table('buildings')->get() as $building)
                                                <option value="{{ $building->name }}">
                                                    {{ $building->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                        Room Label</h6>
                                    <div class="border-0 px-0 text-sm mb-3 mt-3">
                                        <input class="form-control" type="text" name="room_label"
                                            placeholder="Anything..." />
                                    </div>

                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                        Bed </h6>
                                    <div class="border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                            {{-- <input required placeholder="eg Deluxe"
                                                    class="form-input ms-auto form-control" type="text" name="name"
                                                    id=""> --}}

                                            <select class="form-control" name="name">
                                                <option disabled selected>--Select Bed--
                                                </option>
                                                <option value="Single">Single</option>
                                                <option value="Right">Right</option>
                                                <option value="Left">Left</option>
                                                <option value="Right  Top">Right Top</option>
                                                <option value="Right Lower">Right Lower</option>
                                                <option value="Left Top">Left Top</option>
                                                <option value="Left Lower">Left Lower</option>
                                                <option value="Middle">Middle</option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="border-0 px-0 text-sm mb-3 ">
                                        <input class="btn btn-primary mt-3" type="submit" value="+ Create a new room" />
                                    </div>



                                </form>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            // Limit user from selecting more than one amenities
            $(document).ready(function() {
                $("input[name='amenities[]']").change(function() {
                    var maxAllowed = 10;
                    var cnt = $("input[name='amenities[]']:checked").length;
                    if (cnt > maxAllowed) {
                        $(this).prop("checked", "");

                        $('#amenities-error').attr({
                            "class": "text-danger",
                            "role": "alert"
                        });
                    }
                });

                $('#bed-space').DataTable({
                    "paging": true,
                    "pagingType": "full_numbers",
                    "language": {
                        "paginate": {
                            "previous": "‹",
                            "first": "«",
                            "next": "›",
                            "last": "»",
                        }
                    },
                    "retrieve": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": true,
                    "autoWidth": true,
                    "responsive": false,
                    "buttons": {
                        "buttons": ["csv", "excel", "pdf", "print"],
                        "dom": {
                            "container": {
                                "tag": "div",
                                "className": "text-end align-items-right"
                            },
                            "collection": {
                                "tag": "div",
                                "className": ""
                            },
                            "button": {
                                "tag": "button",
                                "className": "btn btn-sm bg-gradient-primary",
                                "active": "active",
                                "disabled": "disabled"
                            },

                        }
                    },
                    "info": false,


                }).buttons().container().appendTo('#bed-space-data');

            });
        </script>
    @endsection
