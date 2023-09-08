@php
function daysCount(DateTime $past_date){
    //set current date
    $now = new DateTime;
	//get differ between past date date and current date
    $diff = $now->diff($past_date);

    if ($past_date > $now) 
        return 'future';
        
    $total_days = $diff->days;
    $total_months = ($diff->y * 12) + $diff->m;
    $total_years = $diff->y;

    //setup of localization if you want to use another language, PHP will translate it
	setlocale(LC_ALL, 'en_EN');
	
    $count = ($d = $diff->d) ? ' and '. $d . ngettext(" day", " days", $d) : '';
    $count = ($m = $diff->m) ? ($count ? ', ' : ' and '). $m . ngettext(" month", " months", $m).$count : $count;
    $count = ($y = $diff->y) ? $y . ngettext(" year", " years", $y).$count  : $count;
            
    return $count;
}
@endphp

@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('page-title', $staff->first_name . ' ' . $staff->last_name)
@section('content')

    <div class="row mt-4">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center border-bottom py-3">
                    <div class="d-flex align-items-center">
                        <a href="javascript:;">
                            <img src="{{ $staff->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}" class="avatar"
                                alt="profile-image">
                        </a>
                        <div class="mx-3">
                            <a href="/staff/{{ $staff->id }}/edit" class="text-dark text-s h5">{{ $staff->first_name }}
                                {{ $staff->last_name }} <small class="d-block text-muted text-xs"> Last login
                                    {{ \Carbon\Carbon::parse($last_login)->format('d/m/Y - h:i a') }}

                                </small>
                            </a>

                            <a href="/staff/{{ $staff->id }}/login-reports" class="text-primary text-sm m-0 p-0">
                                Login Report
                            </a>
                        </div>
                    </div>
                    <div class="d-flex text-end ms-auto">
                        @if ($staff->phone_number)
                            <a href="tel:{{ $staff->phone_number }}" class="btn btn-sm bg-gradient-primary mb-0">
                                <i class="fas fa-phone pe-2"></i> Call
                            </a>
                        @endif

                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0"><strong class="text-dark">Full Name:</strong> &nbsp;
                            {{ $staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</li>
                        <li class="list-group-item border-0 ps-0 pt-0">
                            <hr class="ps-0 pt-0 m-0 horizontal dark">
                        </li>
                        <li class="list-group-item border-0 ps-0"><strong class="text-dark">Mobile:</strong> &nbsp;
                            {{ $staff->phone_number }}</li>
                        <li class="list-group-item border-0 ps-0 pt-0">
                            <hr class="ps-0 pt-0 m-0 horizontal dark">
                        </li>
                        <li class="list-group-item border-0 ps-0"><strong class="text-dark">Email:</strong> &nbsp;
                            {{ $staff->email }}</li>
                        <li class="list-group-item border-0 ps-0 pt-0">
                            <hr class="ps-0 pt-0 m-0 horizontal dark">
                        </li>
                        <li class="list-group-item border-0 ps-0"><strong class="text-dark">Location:</strong> &nbsp;
                            {{ $staff->street }}, {{ $staff->city }}, {{ $staff->state }}</li>
                        <li class="list-group-item border-0 ps-0"><strong class="text-dark">Count of Days:</strong> &nbsp;
                            @if (daysCount(\Carbon\Carbon::parse($staff->staff->start_date)) == 'future')
                               Start on {{ \Carbon\Carbon::parse($staff->staff->start_date) }}
                            @else
                               {{ daysCount(\Carbon\Carbon::parse($staff->staff->start_date)) }}
                            @endif
                            {{-- {{ daysCount(new DateTime('1998-09-28')) }} --}}
                        </li>

                    </ul>

                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row align-items-center mb-3">
                                <div class="col-9">
                                    <h5 class="mb-1">
                                        <a href="javascript:;">Supervisor</a>
                                    </h5>
                                </div>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                    <div class="avatar me-3">
                                        <img src="{{ $staff->staff->supervisor->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                                            alt="kal" class="border-radius-lg shadow">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">
                                            {{ $staff->staff->supervisor->first_name ?? '' }}
                                            {{ $staff->staff->supervisor->middle_name ?? '' }}
                                            {{ $staff->staff->supervisor->last_name ?? '' }}
                                        </h6>
                                        <p class="mb-0 text-xs">
                                            @if ($staff->staff->supervisor->roles->count() != 0)
                                                {{ $staff->staff->supervisor->roles->first()->name ?? '' }}
                                            @else
                                                No role
                                            @endif
                                        </p>
                                    </div>
                                    @if ($staff->staff->supervisor->staff)
                                        <a class="btn btn-link text-dark pe-3 ps-0 mb-0 ms-auto"
                                            href="/staff/{{ $staff->staff->supervisor->id ?? '' }}">View</a>
                                    @endif
                                </li>

                            </ul>
                            <div class="card">
                                <div class="card-body border-radius-lg bg-gradient-dark p-3">
                                    <h6 class="mb-0 text-whit" style="color:white;">
                                        Change Supervisor?
                                    </h6>
                                    <p class="text-whit text-sm mb-4" style="color:white;">
                                        click on the box and select from list
                                    </p>
                                    <form action="/staff/{{ $staff->id }}/supervisor/update" method="POST">
                                        @csrf

                                        <select class="multisteps-form__select form-control" name="supervisor"
                                            onchange="this.form.submit()">
                                            <option value="" disabled>-select-</option>
                                            @foreach (App\Models\User::where('role', '!=', 'student')->where('id', '!=', $staff->id)->get() as $supervisor)
                                                <option value="{{ $supervisor->id }}"
                                                    @if ($supervisor->id == $staff->staff->supervisor->id) selected @endif>
                                                    {{ $supervisor->first_name }}
                                                    {{ $supervisor->middle_name }}
                                                    {{ $supervisor->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mt-4 mt-sm-0">
                    <div class="card h-100">

                        <div class="card-body">
                            <div class="row align-items-center mb-3">
                                <div class="col-9">
                                    <h5 class="mb-1">
                                        <a href="javascript:;">Settings</a>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">

                                <form action="/staff/{{ $staff->id }}/update" method="POST">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Position</label>
                                        <div class="input-group">
                                            <input id="position" name="position" class="form-control" type="text"
                                                value="{{ $staff->staff->position ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Salary</label>
                                        <div class="input-group">
                                            <input id="salary" name="salary" class="form-control" type="text"
                                                value="{{ $staff->staff->salary ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">

                                        <button class="btn btn-sm bg-gradient-dark mb-0" type="submit">
                                            Update
                                        </button>

                                        <button class="btn btn-sm bg-gradient-danger mb-0" type="button"
                                            id="delete-staff-button">
                                            Delete Staff
                                        </button>
                                    </div>
                                </form>

                                <form action="/staff/{{ $staff->id }}" method="POST" id="delete-staff">
                                    @method('Delete')
                                    @csrf




                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card mb-3 mt-lg-0 mt-4">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="avatar avatar-lg">
                            <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            {{-- <img alt="Image placeholder" src="../../../assets/img/small-logos/logo-slack.svg"> --}}
                        </div>
                        <div class="ms-2 my-auto">
                            <h6 class="mb-0">{{ $staff->roles()->first()->name }}</h6>
                            <p class="text-xs mb-0">{{ $staff->roles()->first()->permissions->count() }} permission</p>
                        </div>
                    </div>
                    <p class="mt-3">
                        This user has been assigned the role of
                        <strong>{{ $staff->roles()->first()->name }}</strong>
                        {{-- {{$user_roles_permissions}} --}}
                        with {{ count($staff->permissions) }} extra permisions
                    </p>
                    <hr class="horizontal dark">
                    @can('edit-permission-for-staff')
                    <div class="text-center">
                        <a href="/staff/{{ $staff->id ?? '' }}/permissions" class="btn btn-sm bg-gradient-dark mb-0">
                            Update Permission
                        </a>

                    </div>
                    @endcan
                </div>
            </div>
            <div class="card mt-4">

                <div class="card-body pb-0">
                    <div class="row align-items-center mb-3">
                        <div class="col-9">
                            <h5 class="mb-1">
                                <a href="javascript:;">Department</a>
                            </h5>
                        </div>
                        <div class="col-3 text-end">
                            <div class="dropstart">
                                <a href="javascript:;" class="text-secondary" id="dropdownMarketingCard"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                    aria-labelledby="dropdownMarketingCard">
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">Edit Team</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">Add Member</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">See Details</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Remove
                                            Team</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <h5 class="text-primary">
                        {{ DB::table('departments')->where('id', $staff->staff->department)->value('name') }}</h5>
                    <p>
                        {{ DB::table('departments')->where('id', $staff->staff->department)->value('description') }}
                    </p>
                    <ul class="list-unstyled mx-auto">
                        <li>
                            <hr class="horizontal dark">
                        </li>
                        <li class="d-flex">
                            <p class="mb-0">Position:</p>
                            <span class="badge badge-secondary ms-auto">{{ $staff->staff->position }}</span>
                        </li>
                        <li>
                            <hr class="horizontal dark">
                        </li>

                        <li class="d-flex">
                            <p class="mb-0">Members:</p>
                            <div class="avatar-group ms-auto">
                                @forelse(App\Models\Staff::where('department', $staff->staff->department)->where('user_id', '!=', $staff->id)->get() as $member)
                                    <a href="/staff/{{ $member->get->id ?? '' }}"
                                        class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        title="{{ $member->get->first_name . ' ' . $member->get->last_name }}">
                                        <img alt="Image placeholder"
                                            src="{{ $member->get->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}">
                                    </a>
                                @empty
                                    <span class="">No other staff</span>
                                @endforelse


                            </div>
                        </li>
                        <li>
                            <hr class="horizontal dark">
                        </li>
                        <div class="card">
                            <div class="card-body border-radius-lg bg-gradient-primary p-3">
                                <h6 class="mb-0 text-whit" style="color:white;">
                                    Change Department?
                                </h6>
                                <p class="text-whit text-sm mb-4" style="color:white;">
                                    click on the box and select from list
                                </p>
                                <form action="/staff/{{ $staff->id }}/department/update" method="POST">
                                    @csrf
                                    <select class="multisteps-form__select form-control" name="department"
                                        onchange="this.form.submit()">
                                        <option value="" disabled>-select-</option>
                                        @foreach (DB::table('departments')->get() as $department)
                                            <option value="{{ $department->id }}"
                                                @if ($staff->staff->department == $department->id) selected @endif>
                                                {{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>

                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#delete-staff-button").click(function() {
                const suggestedButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn bg-gradient-danger mx-1',
                        cancelButton: 'btn bg-gradient-dark mx-1'
                    },
                    buttonsStyling: false
                })

                suggestedButtons.fire({
                    icon: 'warning',
                    title: 'Delete?',
                    text: 'Are you sure you want to delete this staff',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, continue!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $("#delete-staff").submit()
                        // this.form.submit()
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        //   swalWithBootstrapButtons.fire(
                        //     'Cancelled',
                        //     'Your imaginary file is safe :)',
                        //     'error'
                        //   )
                    }
                })
                // alert('jhg')
            });

        });
    </script>

@endsection
