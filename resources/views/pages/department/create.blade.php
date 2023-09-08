@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('style')
@endsection
@section('page-title', 'Create Department')
@section('content')


    @php
        if ($errors) {
            $outPut = '<ul class="list-group" style="justify-content: center; padding: 1em 1.6em 0.3em; text-align: left !important;">';
            foreach ($errors->all() as $error) {
                $outPut .= '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><span class="text-danger">*</span> ' . $error . '</li>';
            }
            $outPut .= '<ul>';
        }
        
    @endphp
    {{-- @dd($errors->all()) --}}
    @if ($errors->all())
        <script>
            const requiredButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-gradient-success',
                    cancelButton: 'btn bg-gradient-danger'
                },
                buttonsStyling: false
            })
            requiredButtons.fire({
                title: 'Error',
                html: '{!! html_entity_decode($outPut) !!}',
                showCloseButton: true,
            })
        </script>
    @endif
    <div class="row">
        <div class="col-12">

        </div>
    </div>
    <div class="row mt-3 " id="f-row">
        <div class="col-sm-6 m-auto col-md-6 col-xl-6">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Department</h6>
                </div>
                <div class="card-body p-3">
                    <form action="/department/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label>Name</label>
                                <input class="multisteps-form__input form-control" type="txet"
                                    name="name" placeholder="" />
                            </div>
                            <div class="col-12 mt-3">
                                <label>Description</label>
                                <textarea class="multisteps-form__textarea form-control" rows="5" name="description"
                                    placeholder=""></textarea>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <a href="/department" class="btn btn-light m-0">Cancel</a>
                                <button type="submit" name="button" class="btn bg-gradient-primary m-0 ms-2">Create Department</button>
                              </div>
                    </form>

                </div>
            </div>
        
        </div>
    </div>
@endsection

@section('script')
    <script src="jquery.min.js"></script>

    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pdf.js') }}"></script>

    
    <script src="{{ asset('/assets/js/plugins/multistep-form.js') }}"></script>
    <!-- Toastr -->
    {{-- <script src="{{ asset('/assets/js/plugins/jquery/jquery-3.3.1.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('/assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/toastr/toastr.min.js') }}"></script> --}}
@endsection
