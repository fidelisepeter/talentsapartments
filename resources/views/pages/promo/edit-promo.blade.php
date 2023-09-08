@extends('layouts.main')
@section('page-title', 'Edit Promo #'.$promo->promo_code)
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


        <div class="col-sm-5 mx-auto">
            <div class="card mb-4 blur shadow-blur">
                <div class="card-header pb-0">
                    <h6>Edit Promo</h6>
                </div>
                <div class="card-body ">
                    <form class="form-horizontal" method="POST" action="/update-promo" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input id="" type="hidden" class="form-control" name="promo_type" value="{{ $promo->promo_type }}"
                                required="">
                                <input id="" type="hidden" class="form-control" name="promo_id" value="{{ $promo->id }}"
                                required="">
                            <select id="" class="form-control" name="type" placeholder="Current password"
                                disabled>
                                <option>{{ strtoupper($promo->promo_type) }} PROMO</option>

                            </select>
                        </div>
                        <label class="form-label">Promo Code</label>
                        <div class="form-group">
                            <input id="promo_code" type="text" class="form-control" name="promo_code"
                                value="{{ $promo->promo_code }}" required="">
                        </div>

                        <label class="form-label">Promo Thumbnail</label>
                        <div class="form-group">
                            <input type="file" class="form-control mb-3" name="thumbnail" id="thumbnail">
                        </div>

                        @if ($promo->promo_type == 'regular')
                        {{-- @dd(json_decode($promo->promo_data)) --}}
                        <fieldset id="buildyourform" data-idx="{{ count(json_decode($promo->promo_data, true) ?? []) }}">
                            <legend>Products</legend>
                            @foreach (json_decode($promo->promo_data) ?? [] as $key => $value)
                            
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label">Room Type</label>
                                    <div class="form-group">
                                        <select id="room_id" class="form-control" name="room_data[{{ $key }}][room_id]" required="">
                                            @foreach (DB::table('rooms')->get() as $room_type) 
                                            <option data-price="{{ $room_type->price }}" value="{{ $room_type->id }}" {{ $value->room_id == $room_type->id ? 'selected' : '' }} >{{ $room_type->name }} - ₦{{ $room_type->price }} </option>
                                             @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="form-label">Percentage Off</label>
                                    <div class="form-group">
                                        <input id="" type="number" min="0" max="100" value="{{ $value->percentage_off }}" class="form-control" name="room_data[{{ $key }}][percentage_off]" required="">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label">Remove</label>
                                    <button class="btn btn-sm btn-link remove-field" type="button" >x</button>
                                </div>
                            </div>
                      
                           
    
                            @endforeach
                        </fieldset>
                            <a class="text-sm text-primary " href="javascript:void(0);"  id="add-field">Add Room Type</a>

                        @elseif ($promo->promo_type == 'special')
                        @php
                            $room_data = json_decode($promo->promo_data);
                        @endphp
                        

                        <label class="form-label">Product</label>
                        <div class="form-group">
                            <select id="room_id" class="form-control" name="room_id" required="">
                                @foreach (DB::table('rooms')->get() as $room_type)
                                    <option data-price="{{ $room_type->price }}" value="{{ $room_type->id }}" {{ $room_data->room_id == $room_type->id ? 'selected' : '' }} >
                                        {{ $room_type->name }} - ₦{{ $room_type->price }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <label class="form-label">Percentage off (%) </label>
                        <div class="form-group">
                            <input id="percentage_off" type="number" max="100" min="0" class="form-control"
                                name="percentage_off" value="{{ $room_data->percentage_off }}" required="">
                            <span class="text-xs" id="show_percentage_off"></span>
                        </div>
                        @endif
                        
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Start Date</label>
                                <div class="form-group">
                                    <input id="percentage_off" type="date" class="form-control" name="start_date" value="{{ Carbon\Carbon::parse($promo->start_date)->format('Y-m-d') }}"
                                        required="">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">End Date</label>
                                <div class="form-group">
                                    <input id="percentage_off" type="date" class="form-control" name="end_date"
                                        required="" value="{{ Carbon\Carbon::parse($promo->end_date)->format('Y-m-d') }}">

                                </div>
                            </div>
                        </div>
                        <label class="form-label">Description</label>
                        <div class="form-group">
                            <textarea id="description" class="form-control" name="description">{{ $promo->description }}</textarea>
                        </div>

                        {{-- <div class="d-flex mb-3"> --}}
                            <div class="d-flex mb-3">
                                <p class="mb-0 mx-2">Activate This Promo</p>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input" type="checkbox" name="active" {{ $promo->active ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <p class="mb-0 mx-2">Show promo on site</p>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input" type="checkbox" name="show" {{ $promo->show ? 'checked' : '' }}>
                                </div>
                            </div>
                        {{-- </div> --}}
                        
                        {{-- <div class="field_wrapper"> <div> <input type="text" name="field_name[]" value=""> <a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png"></a> </div> </div> --}}

                        <button class="btn bg-gradient-dark w-100 mb-0" type="submit">Update Promo</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-7 mx-auto">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6>Rent</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="rent-table" class="table align-items-center mb-0">
                            <thead>
                              <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Room type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                                {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th> --}}
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Booked</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach (DB::table('rents')->where('promo_code', $promo->promo_code)->get() as $rent)
                              <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            {{-- <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"> --}}
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">
                                                {{ DB::table('users')->where('id', $rent->user_id)->value('last_name') }}
                                                {{ DB::table('users')->where('id', $rent->user_id)->value('first_name') }}
                                                {{ DB::table('users')->where('id', $rent->user_id)->value('middle_name') }}
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                {{ DB::table('users')->where('id', $rent->user_id)->value('email') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold"> {{ DB::table('rooms')->where('id', $rent->room_id)->value('name') }} </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-xs font-weight-bold"> ₦{{ $rent->price }} </span>
                                </td>
                                
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($rent->updated_at)->format('j M, Y') }}</span>
                                  </td>
                                <td class="align-middle">
                                    <a href="/booking_view/{{ $rent->id }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                      View Details
                                    </a>
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

            const get_percentage_off = (amount, percentage) => {
                var cal_percentage_off = (amount / 100) * percentage;
                var percentage_off = (amount - cal_percentage_off)
                return percentage_off;
            }

            const percentage_off = () => {

                var promo_code = $("#promo_code").val();
                var percentage_off = $("#percentage_off").val();
                var room_id = $("select[name='room_id']").val();
                var room_price = $("#room_id option[value=" + room_id + "]").data('price');
                var room_name = $("#room_id option[value=" + room_id + "]").data('name');
                var message = 'User will pay ₦' + get_percentage_off(room_price, percentage_off) + ' on ' +
                    percentage_off + '% off product price ' + room_price + ' when they use promo code ' +
                    promo_code;
                $("#show_percentage_off").text(message);
            }

            $("#percentage_off").on('change', function() {
                percentage_off();
            });

            $("#promo_code").on('change', function() {
                percentage_off();
            });
            $("#room_id").on('change', function() {
                percentage_off();
            });


            $('.remove-field').click(function(){
                $(this).parent().parent().remove();
                return false;
            });

            $("#add-field").click(function() {
                var lastField = $("#buildyourform");
                var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 0;
                lastField.data("idx", intId);
                var fieldWrapper = $('<div class="row" >');
              
                var roomType = '<select id="room_id" class="form-control" name="room_data[' + intId + '][room_id]" required="">@foreach (DB::table('rooms')->get() as $room_type) <option data-price="{{ $room_type->price }}" value="{{ $room_type->id }}">{{ $room_type->name }} - ₦{{ $room_type->price }} </option> @endforeach </select>';
                var perOff = '<input id="" type="number"  min="0" max="100" class="form-control" name="room_data[' + intId + '][percentage_off]"  required="">';
                var removeButton = $('<div class="col-sm-2"><label class="form-label">Remove</label><button class="btn btn-sm btn-link" type="submit">x</button></div>');
                removeButton.click(function() {
                    $(this).parent().remove();
                });
                fieldWrapper.append('<div class="col-sm-6"><label class="form-label">Room Type</label><div class="form-group">' + roomType + '</div></div>');
                fieldWrapper.append('<div class="col-sm-4"><label class="form-label">Percentage Off</label><div class="form-group">' + perOff + '</div></div>');
                fieldWrapper.append(removeButton);
                $("#buildyourform").append(fieldWrapper);
            });
       
    
                if (document.getElementById('rent-table')) {
                    const dataTableSearch = new simpleDatatables.DataTable("#rent-table", {
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
