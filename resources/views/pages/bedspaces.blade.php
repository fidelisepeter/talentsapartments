@extends('layouts.main')
@section('page-title', 'Users')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
{{-- Stay --}}
@else
{{ Session::flash('error','You are not permited to view that page') }}
<script>
  window.location.href = "{{ url('/dashboard') }}";
</script>
@endif
@section('content')


    
    <!-- here -->
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Users</h6>
                    </div>
                    <div class="col-6 text-end">
                        <div class="input-group">
                            <form action="" method="get">
                                <div class="input-group">
                                    <input  name="search" type="text" class="form-control form-control-sm"
                                        placeholder="Type here...">
                                    <button class="input-group-text text-body"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <span class="text-danger px-0 pt-0 pb-2 text-center">@error('search'){{ $message }} @enderror</span>
            <div class="card-body px-0 pt-0 pb-2">

              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Users</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Matric Number</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Room Booked</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date booked</th>
                      <!-- <th class="text-secondary opacity-7"></th> -->
                    </tr>
                  </thead>
                  <tbody>
                      
@foreach ($users as $user)

                      <tr>
                        <td>

                          <div class="d-flex px-2 py-1">
                          <!-- <div>
                            <img src="../assets/img/avatar5.png" class="avatar avatar-sm me-3" alt="user1">
                          </div> -->
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</h6>

                              <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">Matric Number</p>
                          <p class="text-xs text-secondary mb-0">{{$user->matric_number}}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ DB::table('rooms')->where('id', DB::table('rents')->where('user_id', $user->id)->value('room_id'))->value('name') }}</p>
                          <p class="text-xs text-secondary mb-0">{{ DB::table('rents')->where('user_id', $user->id)->value('price') }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm @if(DB::table('rents')->where('user_id', $user->id)->value('status')== 'Approved')
                          bg-gradient-success @elseif(DB::table('rents')->where('user_id', $user->id)->value('status')== 'Declined')
                          bg-gradient-danger @else bg-gradient-warning @endif">{{ DB::table('rents')->where('user_id', $user->id)->value('status') }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse(DB::table('rents')->where('user_id', $user->id)->value('created_at'))->format('j M, Y') }}</span>
                        </td>
                        <td class="align-middle">
                          <!-- <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                            Edit
                          </a> -->
                        </td>
                      </tr>
                      @endforeach




                  </tbody>

                </table>
                <!-- here -->

              </div>

            </div>

          </div>
          <div class="align-items-center" style="float:right;align-items: center !important;">
                
          </div>

        </div>
      </div>
@endsection
