@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('page-title', $role->name . ' Permissions')
@section('content')


    
   
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-3">
                    <h5 class="mb-2">Change Role name</h5>
                    {{-- <p class="mb-0">Track and find all the details about our referral program, your stats and revenues.</p> --}}
                </div>
                <div class="card-body p-3">
                    {{-- <div class="d-flex"> --}}
                        <div>
                    <form action="/role/{{ $role->id }}/update" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input 
                            value="{{ $role->name }}"
                            style="border-top-right-radius: 0px!important; border-bottom-right-radius: 0px!important;"
                            type="text" 
                            class="form-control" 
                            placeholder="Role name" 
                            aria-label="Role name" 
                            aria-describedby="button-addon2"
                            name="name" 
                            >
                            <button class="btn btn-outline-primary mb-0" type="submit" id="button-addon2">Update Role Name</button>
                          </div>
                    </form>
                        </div>
                        <div class="text-center">
                    <button class="btn mb-3 mx-3 bg-gradient-danger mb-0" type="submit" id="delete-role-button">Delete Role</button>
                        </div>
                {{-- </div>    --}}
                    <form action="/role/{{ $role->id }}" method="POST" id="delete-role">
                        @method('Delete')
                        @csrf




                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-4">
        <div class="card overflow-scroll">
          <div class="card-body d-flex">
            
            @forelse ($role->users as $staff)
            <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                <a href="/staff/{{ $staff->id ?? '' }}" class="avatar avatar-lg rounded-circle border border-primary">
                  <img alt="{{ $staff->first_name . ' ' . $staff->last_name }}" class="p-1" src="{{ $staff->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}">
                </a>
                <p class="mb-0 text-sm">{{ $staff->first_name . ' ' . substr($staff->last_name,0,1) }}</p>
              </div>
            @empty
            <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                <a href="javascript:;" class="avatar avatar-lg border-1 rounded-circle bg-gradient-primary">
                  <i class="fas fa-plus text-white" aria-hidden="true"></i>
                </a>
                <p class="mb-0 text-sm" style="margin-top:6px;">No Staff Yet</p>
              </div>
            @endforelse 
            
          </div>
        </div>
      </div>
    <form action="/role/{{ $role->id }}/permissions/update" method="POST">
        @csrf
        <div class="row mt-3">
            <div class="col-12 mb-4">
                {{-- @dd($role->roles) --}}
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
                                        @php
                                            // $data=DB::table('table_name')->select(.......)->get();
                                            // $role->permissions=array_map(function($item){
                                            //     return (array) $item;
                                            // },$role->permissions);
                                        @endphp
                                        {{-- @dd($role->permissions) --}}
                                            @if (strpos($category_permission->name, $category) !== false)
                                                <li class="list-group-item border-0 px-0"
                                                    {{-- @if (in_array($category_permission->name, (array) $role->permissions)) title="This Permission is attached to the user role" @endif --}}
                                                    >
                                                    <div class="form-check form-switch ps-0">
                                                        <input class="form-check-input ms-auto" type="checkbox"
                                                            id="{{ $category_permission->name }}"
                                                            @if ($role->hasPermissionTo($category_permission->name)) checked="" @endif
                                                            name="{{ $category_permission->name }}"
                                                            {{-- @if (in_array($category_permission->name, (array) $role->permissions)) disabled="" @endif --}}
                                                            >
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
                <button type="submit" class="btn bg-gradient-info mb-0">Update role Permission</button>
            </div>


            {{-- @dd(array_unique($list)) --}}
        </div>
    </form>


@endsection
@section('script')
<script>
     

    $(document).ready(function() {

        
        $("#delete-role-button").click(function() {
            
            const suggestedButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-gradient-danger mx-1',
                    cancelButton: 'btn bg-gradient-dark mx-1'
                },
                buttonsStyling: false
            })

            suggestedButtons.fire({
                title: 'Delete?',
                icon: 'warning',
                html: '<h6>Are you sure you want to delete this role </h6><p> Note: You can only delete roles that does not have staff attached to it.</p> <p>before deleting a role remove all staff that has the role</p>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, continue!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $("#delete-role").submit()
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

