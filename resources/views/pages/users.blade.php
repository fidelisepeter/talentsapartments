@extends('layouts.main')
@section('page-title', 'Users')
@section('content')


    <div class="row pb-5">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Approved</p>
                    <h5 class="font-weight-bolder mb-0">
                    {{ count( DB::table('rents')->where('status','Approved')->where('year', $viewingYear)->get()) }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Declined</p>
                    <h5 class="font-weight-bolder mb-0">
                    {{ count( DB::table('rents')->where('status','Declined')->where('year', $viewingYear)->get()) }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending</p>
                    <h5 class="font-weight-bolder mb-0">
                    {{ count( DB::table('rents')->where('status','Pending')->where('year', $viewingYear)->get()) }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Users</p>
                    <h5 class="font-weight-bolder mb-0">
                    {{ count(DB::table('users')->where('role','student')->where('year', $viewingYear)->get()) }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

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
                      {{-- <form action="" method="get">
                        <div class="row">
                          <div class="col-auto">
                            <input  name="search" type="text" class="form-control form-control-sm"
                            placeholder="Type here...">
                          </div>
                          <div class="col-auto">
                            <button class="btn btn-info btn-sm"><i class="fa fa-search"
                              aria-hidden="true"></i> Search</button>
                          </div>
                           
                          
                          </div>
                      </form> --}}
                        
                    
                    </div>
                </div>
            </div>
            <span class="text-danger px-0 pt-0 pb-2 text-center">@error('search'){{ $message }} @enderror</span>
            <div class="card-body px-0 pt-0 pb-2">
              <div class=" p-0">
                <table id="userTable" class="table align-items-center mb-0">
                 
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Users</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Matric Number</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Room Booked</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date booked</th>
                      <th class="text-secondary opacity-7">Recent Bookings</th>
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
                          <a href="/booking_view/{{ $user->current_rent }}" class="" data-toggle="tooltip" data-original-title="View Cuurent Booking">
                          <p class="text-xs font-weight-bold mb-0">{{ DB::table('rooms')->where('id', DB::table('rents')->where('user_id', $user->id)->value('room_id'))->value('name') }}</p>
                          <p class="text-xs text-secondary mb-0">{{ DB::table('rents')->where('user_id', $user->id)->value('price') }}</p>
                          </a>
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
                          <div class="dropdown pt-2">
                            <a href="javascript:;" class="text-secondary text-xs font-weight-bold ps-4" id="dropdownCam" data-toggle="dropdown" aria-expanded="false">
                              {{-- <i class="fas fa-ellipsis-v" aria-hidden="true"></i>  --}}
                              Click to select
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end me-sm-n4 px-2 py-3" aria-labelledby="dropdownCam" style="">
                              @foreach (DB::table('rents')->where('user_id', $user->id)->get() as $booking)
                              <li><a class="dropdown-item border-radius-md" href="/booking_view/{{ $booking->id }}">{{ DB::table('rooms')->where('id', $booking->room_id)->value('name') }} - {{ $booking->year }} [{{ $booking->status }}]</a></li>
                              @endforeach
                              
                            </ul>
                          </div>
                          <!-- <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                            Edit
                          </a> -->
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
@endsection
@section('script')
    <script>
        // Limit user from selecting more than one amenities
        $(document).ready(function() {
            $("input[name='amenities[]']").change(function() {
                var maxAllowed = 10;
                var cnt = $("input[name='amenities[]']:checked").length;
                if (cnt > maxAllowed) {
                    $(this).prop("checked", "");

                    $('#amenities-error').attr({
                        "class": "text-danger",
                        "role": "alert"
                    });
                }
            });
           

        });
    </script>

<script>
    $(function() {
       

        $('#userTable').DataTable({
            "paging": true,
            "pagingType": "full_numbers",
            "language": {
                "paginate": {
                    "previous": "‹",
                    "first": "«",
                    "next": "›",
                    "last": "»",
                }
            },
            "retrieve": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
           "buttons": {
                "buttons": ["csv", "excel", "pdf", "print"],
                 "dom": {
                "container": {
                    "tag": "div",
                    "className": "text-end align-items-right"
                },
                "collection": {
                    "tag": "div",
                    "className": ""
                },
                "button": {
                    "tag": "button",
                    "className": "btn btn-sm bg-gradient-primary",
                    "active": "active",
                    "disabled": "disabled"
                },
                
            }
            },
            "info": false,
           
            
        })
        .buttons().container().appendTo('#user-data');

        let tableId = $('#userTable'),
    searchInput = table
      .parents('.dataTables_wrapper')
      .find('input[type=search]'),
    ourInput = $(document.createElement('input'))
      .attr({
        type: 'search',
        'class': 'form-control form-control-sm',
        'aria-controls': tableId,
      });
    });
</script>
@endsection