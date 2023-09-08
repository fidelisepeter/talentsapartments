@extends('layouts.main')
@section('page-title', 'Login Users')

@section('content')
<div class="row pb-5">
      
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-sm-6"><h6>Login Users</h6></div>
                    <div class="col-sm-6" id="loginuser-data"></div>
                  </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table id="residentTable" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Browser</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ip Address</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Login Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Login Time</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($logins as $user)
                  @php
                    $details = json_decode($user->details);
                    // $location = $details->location;
                    if($details->location){
                      $location = $details->location;
                     
                    }else{
                      $location = [];
                      // $location = \Stevebauman\Location\Facades\Location::get($user->ip_address) !== false ? Location::get($user->ip_address) : [];
                    }
                    
                  @endphp
                  @if (DB::table('users')->where('id', $user->user_id)->value('role') != 'student')
                      
                  
                      <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{ DB::table('users')->where('id', $user->user_id)->value('photo') ?? asset('assets/img/no-pics-placeholder.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <a href="#">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">
                            {{ DB::table('users')->where('id', $user->user_id)->value('first_name') }}
                            {{DB::table('users')->where('id', $user->user_id)->value('middle_name') }}
                            {{DB::table('users')->where('id', $user->user_id)->value('last_name') }} <a href="#"><i class="fa fa-pencil"></i></a></h6>
                            <p class="text-xs text-secondary mb-0">{{DB::table('users')->where('id', $user->user_id)->value('email') }} - {{DB::table('users')->where('id', $user->user_id)->value('phone_number') }}</p>
                          </div>
                          </a>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $user->browser }}</p>
                        <p class="text-xxs opacity-7 mb-0">Location: {{ $location ? $location->cityName." - ".$location->regionName.", ".$location->countryName :  'No details' }}</p>
                        <p class="text-xxs opacity-7 m-0 p-0 mb-0" style="font-style: italic;color: #17C1E8 !important;">{{ $location ? " (latitude: ".$location->latitude.", longitude: ".$location->longitude.") " : ""}}</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $user->ip_address }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($user->login_date)->format('j M, Y') }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($user->login_date)->format('H:i:s') }}</span>
                      </td>
                      
                    </tr>
                    @endif
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
       

        $('#residentTable').DataTable({
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
            "autoWidth": true,
            "responsive": false,
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
           
            
        });
        // .buttons().container().appendTo('#loginuser-data');

        let tableId = $('#residentTable'),
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
