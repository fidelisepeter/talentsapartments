@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('style')
@endsection
@section('page-title', 'Guest Settings')
@section('content')
<div class="row mt-3 " id="f-row">
    <div class="col-sm-8 m-auto col-md-8 col-xl-8">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Update Global Guest Settings</h6>
            </div>
            <div class="card-body p-3">
                <form action="/guest/settings/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label>Max Guest Per Day</label>
                            <input class="multisteps-form__input form-control" type="number"
                                name="global_max_guest_per_day" placeholder="" value="{{ DB::table('settings')->value('global_max_guest_per_day') }}"/>
                        </div>

                        <div class="col-12">
                            <label>Email Template</label>
                            <p class="text-sm">
                                Input custom template to that will be sent to guest email <br>
                                use <code>[guest_name]</code>, <code>[resident_name]</code>, <code>[date]</code>, 
                                <code>[room_number]</code>, <code>[building_name]</code>, <code>[room_name]</code>, , <code>[code]</code>.
                                
                            </p>
                            <textarea name="guest_message_template" id="guest_message_template" class="form-control" rows="7">{{ DB::table('settings')->value('guest_message_template') }}</textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm mb-0 mt-3">Update</button>
                        </div>
                        
                </form>

            </div>
        </div>
    
    </div>
</div>
    

@endsection
<script src="{{ asset('assets/js/plugins/ckeditor/ckeditor.js') }}"></script>

@section('script')
    <script>
        $(document).ready(function() {

            CKEDITOR.replace( 'guest_message_template' );

        });
    </script>
@endsection
