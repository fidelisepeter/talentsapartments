@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('page-title', $staff->first_name . ' ' . $staff->last_name . ' Permissions')
@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-3">
                    <h5 class="mb-2">Permission Settings</h5>
                    {{-- <p class="mb-0">Track and find all the details about our referral program, your stats and revenues.</p> --}}
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        {{-- @foreach ($staff->roles as $role_list)
                <div class="col-lg-3 col-6 text-center">
                    <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                      <h4 class="font-weight-bolder">
                          <span id="state1" countto="23980">
                            {{ $role_list->name }}
                       </span></h4>
                       <h6 class="text-primary text-gradient mb-0">{{$role_list->permissions->count()}} permission</h6>
                      
                    </div>
                  </div>
                           
                            @endforeach --}}

                        <div class="col-lg-3 col-6 text-center">
                            <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                <h6 class="text-primary text-gradient mb-0">Current Role</h6>
                                <h4 class="font-weight-bolder"><span id="state2"
                                        countto="2400">{{ $staff->roles()->first()->name }}</span></h4>
                                <h6 class=" text-xs mb-0">{{ $staff->roles()->first()->permissions->count() }} permission
                                </h6>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-3">
                    <h5 class="mb-2">Change Role</h5>
                    {{-- <p class="mb-0">Track and find all the details about our referral program, your stats and revenues.</p> --}}
                </div>
                <div class="card-body p-3">
                    <form action="/staff/{{ $staff->id }}/role/update" method="POST">
                        @csrf
                        <select class="multisteps-form__select form-control" name="role" onchange="this.form.submit()">
                            <option value="">-select-</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @if ($staff->hasRole($role->name)) selected @endif>
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form action="/staff/{{ $staff->id }}/permission/update" method="POST">
        @csrf
        <div class="row mt-3">
            <div class="col-12 mb-4">
                {{-- @dd($staff->roles) --}}
                @php
                    $list = [];
                @endphp
                @foreach ($permissions as $permission)
                
                @php
                    $parts = explode('-', $permission->name);
                    // if (count($parts) != 2) {
                    //     // skip if not 2 parts
                    //     continue;
                    // }
                    $list[] = end($parts);
                @endphp
                @endforeach


                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Permisions</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row mt-3">
                            @foreach (array_unique($list) as $category)
                                <div class="col-12 col-md-6 col-xl-4 mb-4">

                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                        {{ Str::ucfirst($category) }} Permisions</h6>
                                    <ul class="list-group">

                                        @foreach ($permissions as $category_permission)
                                            @if (strpos($category_permission->name, $category) !== false)
                                                <li class="list-group-item border-0 px-0"
                                                    @if (in_array($category_permission->name, $user_roles_permissions)) title="This Permission is attached to the user role" @endif>
                                                    <div class="form-check form-switch ps-0">
                                                        <input class="form-check-input ms-auto" type="checkbox"
                                                            id="{{ $category_permission->name }}"
                                                            @if ($staff->can($category_permission->name)) checked="" @endif
                                                            name="{{ $category_permission->name }}"
                                                            @if (in_array($category_permission->name, $user_roles_permissions)) disabled="" @endif>
                                                        <label
                                                            class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                                            for="{{ $category_permission->name }}">{{ Str::ucfirst(str_replace('-', ' ', $category_permission->name)) }}</label>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach


                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn bg-gradient-info mb-0">Update Staff Permission</button>
            </div>


            {{-- @dd(array_unique($list)) --}}
        </div>
    </form>


@endsection
