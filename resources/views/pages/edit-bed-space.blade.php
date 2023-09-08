@extends('layouts.main')
@section('page-title', 'Bed Space')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
    {{-- Stay --}}
@else
    {{ Session::flash('error', 'You are not permited to view that page') }}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@section('content')

    <div class="row">
        <div class="col-12 col-sm-8 m-auto mt-4">
            <div class="card shadow ">
                <div class="card-header  p-3">
                    <h6 class="mb-0">Create Bed Space</h6>
                </div>
                <div class="card-body p-3 pt-0">
                    <form method="POST" action="/bedspace/{{ $bedspace->id }}/update" enctype="multipart/form-data">@csrf

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
                                    <option 
                                    @if ($bedspace->room_number == "Room ".str_pad($room_number, 3, '0', STR_PAD_LEFT))
                                        selected
                                    @endif
                                    value="Room {{ str_pad($room_number, 3, '0', STR_PAD_LEFT) }}">
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
                                    <option 
                                    @if ($bedspace->room_id == $room_type->id)
                                    selected
                                @endif
                                    value="{{ $room_type->id }}">
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
                                    <option 
                                    @if ($bedspace->building_name == $building->name)
                                    selected
                                @endif
                                    value="{{ $building->name }}">
                                        {{ $building->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                            Room Label</h6>
                        <div class="border-0 px-0 text-sm mb-3 mt-3">
                            <input class="form-control" type="text" name="room_label"
                                value="{{ $bedspace->room_label ?? '' }}" />
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
                                    <option  @if ($bedspace->name == 'Single') selected @endif value="Single">Single</option>
                                    <option @if ($bedspace->name == 'Right') selected @endif value="Right">Right</option>
                                    <option @if ($bedspace->name == 'Left') selected @endif value="Left">Left</option>
                                    <option @if ($bedspace->name == 'Right  Top') selected @endif value="Right  Top">Right Top</option>
                                    <option @if ($bedspace->name == 'Right Lower') selected @endif value="Right Lower">Right Lower</option>
                                    <option @if ($bedspace->name == 'Left Top') selected @endif value="Left Top">Left Top</option>
                                    <option @if ($bedspace->name == 'Left Lower') selected @endif value="Left Lower">Left Lower</option>
                                    <option @if ($bedspace->name == 'Middle') selected @endif value="Middle">Middle</option>

                                </select>
                            </div>
                        </div>


                        <div class="border-0 px-0 text-sm mb-3 ">
                            <input class="btn btn-primary mt-3" type="submit" value="Update Bedspace" />
                        </div>



                    </form>
                    </ul>
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
            // Select all elements with data-toggle="popover" in the document
            // $('[data-toggle="popover"]').popover();

        });
    </script>
@endsection
