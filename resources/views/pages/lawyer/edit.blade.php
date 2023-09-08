@extends('layouts.main')
@if (Auth::user()->role == 'student')
<script>
    window.location.href = "{{ url('/profile') }}";
</script>
@endif
@section('page-title', 'Edit '.Auth::user()->first_name.' '.Auth::user()->last_name)
@section('content')
    
        <div class="row">

        </div>


    @endsection
