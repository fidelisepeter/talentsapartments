@extends('layouts.main')
@section('page-title', 'Promo')
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


        <div class="col-sm-8 mx-auto">
            <div class="card mb-4 blur shadow-blur">
                <div class="card-header pb-0">
                    <h6>Create Promo</h6>
                </div>
                <div class="card-body ">
                    <form class="form-horizontal" method="POST" action="/create-promo"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input id="" type="hidden" class="form-control" name="promo_type" value="regular"
                                required="">
                            <select id="" class="form-control" name="type" placeholder="Current password"
                                disabled>
                                <option>REGULAR PROMO</option>

                            </select>
                        </div>
                        <label class="form-label">Promo Code</label>
                        <div class="form-group">
                            <input id="promo_code" type="text" class="form-control" name="promo_code"
                                placeholder="E.g PROMO{{ date('Y') }}" required="">
                        </div>
                        <label class="form-label">Promo Thumbnail</label>
                        <div class="form-group">
                            <input type="file" class="form-control mb-3" name="thumbnail" id="thumbnail">
                        </div>

                        <label class="form-label">Products</label>
                        {{-- <div id="buildyourform" class="mb-3"></div>  --}}
                        <fieldset id="buildyourform">
                            <legend>Products</legend>
                        </fieldset>
                        <a class="text-sm text-primary " href="javascript:void(0);"  id="add-field">Add Room Type</a>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Start Date</label>
                                <div class="form-group">
                                    <input id="percentage_off" type="date" class="form-control" name="start_date"
                                        required="">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">End Date</label>
                                <div class="form-group">
                                    <input id="percentage_off" type="date" class="form-control" name="end_date"
                                        required="">

                                </div>
                            </div>
                        </div>
                        <label class="form-label">Description</label>
                        <div class="form-group">
                            <textarea id="description" class="form-control" name="description"></textarea>
                        </div>

                        <div class="d-flex mb-3">
                            <p class="mb-0 mx-2">Activate This Promo</p>
                            <div class="form-check form-switch ms-auto">
                                <input class="form-check-input" type="checkbox" name="active" checked >
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <p class="mb-0 mx-2">Show promo on site</p>
                            <div class="form-check form-switch ms-auto">
                                <input class="form-check-input" type="checkbox" name="show" checked>
                            </div>
                        </div>
                        
                        {{-- <div class="field_wrapper"> <div> <input type="text" name="field_name[]" value=""> <a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png"></a> </div> </div> --}}

                        <button class="btn bg-gradient-dark w-100 mb-0" type="submit">Create Promo Code</button>
                    </form>
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
        });
    </script>
@endsection
