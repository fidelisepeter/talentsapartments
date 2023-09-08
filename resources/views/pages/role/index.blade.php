@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('page-title', 'Site Roles')
@section('content')

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Roles</h5>
                            <p class="text-sm mb-0">
                                {{-- COunt: {{$roles->count()}} --}}
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">


                                <button data-toggle="modal" data-target="#new-role"
                                    class="btn bg-gradient-primary btn-sm export mb-0 mt-sm-0 mt-1" type="button" name="button">Create New Role</button>
                                @if ($roles->count() !== 0)
                                    <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                                        type="button" name="button">Export</button>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table id="staff-table" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Permissions</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Staff</th>
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th> --}}
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">


                                                <h6 class="mb-0 text-sm">
                                                    {{ $role->name ?? '' }}

                                                </h6>

                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm text-secondary mb-0">{{ $role->permissions()->count() ?? '' }}
                                            </p>
                                        </td>
                                        <td>

                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        
                                                        $max = 5;
                                                        $total = $role->users()->count();
                                                        $sub = $total - $max;
                                                        $counter = $sub > 0 ? '+ ' . $sub . ' more' : '';
                                                        
                                                    @endphp
                                                    @forelse($role->users()->limit($max)->get() as $staff)
                                                        {{-- @dd($staff) --}}
                                                        <a href="/staff/{{ $staff->id ?? '' }}"
                                                            class="avatar avatar-xs rounded-circle" data-toggle="tooltip"
                                                            data-original-title="{{ $staff->first_name . ' ' . $staff->last_name }}"
                                                            title="{{ $staff->first_name . ' ' . $staff->last_name }}">
                                                            <img alt="/"
                                                                src="{{ $staff->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                                                                class="">
                                                        </a>
                                                        {{-- <a href="/staff/{{ $staff->id ?? '' }}"
                                                            class="avatar avatar-lg avatar-sm rounded-circle"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="{{ $staff->first_name . ' ' . $staff->last_name }}">
                                                            <img alt="e" src="{{ $staff->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}">
                                                        </a> --}}

                                                    @empty

                                                        <span class="text-dark text-xs">No staff</span>
                                                    @endforelse

                                                </div>
                                                <small class="ps-2 font-weight-bold">{{ $counter }}</small>
                                            </div>

                                        </td>
                                        {{-- <td class="align-middle text-center text-sm">
                      <p class="text-secondary mb-0 text-sm">{{ $staff->get->email ?? ''}}</p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-sm">{{ $staff->start_date ?? ''}}</span>
                    </td> --}}
                                        <td class="align-middle text-center">
                                            {{-- <span class="text-secondary text-sm"></span> --}}
                                            <div class="d-flex align-items-center">
                                                <a class="text-dark text-sm mx-3" href="role/{{ str_replace(' ', '-', strtolower($role->name)) }}"> Update Role</a>
                                                {{-- <a href="/role/{{ $role->id }}/delete" class="text-danger text-sm"  type="button" onclick="deleteStaff()" id="delete-role-butto"> Delete</a> --}}
                                            
                                            </div>
                                           
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

    <div class="modal fade" id="new-role" tabindex="-1" role="dialog" aria-labelledby="new-role" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-info text-gradient">Create Role</h3>
                            <p class="mb-0">You will be directed to add permission after role has been created</p>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" action="/role/store" method="POST">
                                @csrf
                                <label>Role Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="eg. Admin" aria-label="eg. Admin"
                                        aria-describedby="role-addon" name="name" required>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Create</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            {{-- <p class="mb-4 text-sm mx-auto">
                                Don't have an account?
                                <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign up</a>
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script> --}}

    <script>
        // Limit user from selecting more than one staff
        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip();

            $("input[name='staff[]']").change(function() {
                var maxAllowed = 10;
                var cnt = $("input[name='staff[]']:checked").length;
                if (cnt > maxAllowed) {
                    $(this).prop("checked", "");

                    $('#staff-error').attr({
                        "class": "text-danger",
                        "role": "alert"
                    });
                }
            });
            $('#staff-tables').DataTable({



            }).buttons().container().appendTo('#staff-table-data');

    

            if (document.getElementById('staff-table')) {
                
                const dataTableSearch = new simpleDatatables.DataTable("#staff-table", {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
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
                            filename: "roles-talentapartment-" +
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
    <script>
     

        $(document).ready(function() {

            
            $("#delete-role-button").click(function() {
                var value = $(this).data('id');
   console.log("The value is=" + value);
                const suggestedButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn bg-gradient-danger',
                        cancelButton: 'btn bg-gradient-dark'
                    },
                    buttonsStyling: false
                })

                suggestedButtons.fire({
                    title: 'Delete?',
                    text: 'Are you sure you want to delete this role',
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
