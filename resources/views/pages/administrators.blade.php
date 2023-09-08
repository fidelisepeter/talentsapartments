@extends('layouts.main')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
{{-- Stay --}}
@else
{{ Session::flash('error','You are not permited to view that page') }}
<script>
  window.location.href = "{{ url('/dashboard') }}";
</script>
@endif
@section('page-title', 'Administrators')
@section('content')
@if (Auth::user()->role == 'super_admin')
<div class="row">
 
            <div class="col-12">
              <div class="card mb-4">
                <div class="card-header pb-0">
                  <h6>Create a new Admin</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Name</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Password</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Create Admin</th>
                        </tr>
                      </thead>
                      <tbody>

                        <form action="/create_admin" method="post"> @csrf
                          <tr>
                            <td>
                              <div class="d-flex px-2 py-1">

                                <div class="d-flex flex-column justify-content-center">
                                  <input  class="form-control" required type="text" name="first_name" id="">
                                </div>
                              </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <input  class="form-control" required type="text" name="last_name" id="">
                                  </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <input  class="form-control" required type="text" name="email" id="">
                                  </div>
                            </td>

                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <input  class="form-control" required type="text" name="password" id="">
                                  </div>
                            </td>

                            <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-success">
                                    <select name="role" required class="form-control" id="" >
                                     <option disabled selected>-set Role-</option>
                                     <option value="super_admin">super admin</option>
                                     <option value="admin">admin</option>
                                     <option value="complaints_manager">complaints_manager</option>
                                     <option value="accountant">accountant</option>
                                    </select>
                                </span>
                              </td>

                            <td class="align-middle text-center">
                              <button type="submit" class="btn btn-primary bg-gradient text-xs font-weight-bold">Create</button>
                            </td>
                            </form>

                          </tr>






                      </tbody>
                    </table>
                    <!-- here -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif

    <!-- here -->
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Administrators</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                      @if (Auth::user()->role == 'super_admin')
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Password</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Update Role</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">update</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">delete</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $user)

                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">

                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{$user->role}}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{$user->email}}</p>
                        </td>
                        @if (Auth::user()->role == 'super_admin')
                        <form action="/update_admin/{{$user->id}}" method="post"> @csrf
                          <td>
                            <input type="password" name="password" class="form-control form-control-sm" id="" placeholder="create new password">
                          </td>
                        <td class="align-middle text-center text-sm">

                            {{-- <span class="badge badge-sm bg-gradient-success"> --}}
                                <select class="form-control form-control-sm" name="role" id="" >
                                 <option value="">-change role-</option>
                                 <option value="super_admin">super admin</option>
                                 <option value="admin">admin</option>
                                 <option value="complaints_manager">complaints_manager</option>
                                 <option value="accountant">accountant</option>
                                </select>
                            {{-- </span> --}}
                          </td>

                        <td class="align-middle text-center text-sm">
                          <input type="submit" class="form-control form-control-sm bg-gradient-primary font-weight-bold" style="color: white;" value="Update Admin">
                        </td>
                        </form>
                        <td class="align-middle">
                         <a href="delete_admin/{{$user->id}}" class="form-control form-control-sm bg-gradient-danger font-weight-bold" style="color: white;">
                            Delete
                          </a>
                          
                        </td>
                        @endif
                      </tr>
                      @endforeach





                  </tbody>
                </table>
                <!-- here -->

              </div>
            </div>
          </div>
          <div class="align-items-center" style="float:right;align-items: center !important;">
                {!! $users->links() !!}
          </div>
        </div>
      </div>


      @endsection
