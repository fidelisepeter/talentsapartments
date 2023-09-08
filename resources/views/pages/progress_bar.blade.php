@extends('layouts.main')
@section('page-title', 'User Upload Progress')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
{{-- Stay --}}
@else
{{ Session::flash('error','You are not permited to view that page') }}
<script>
  window.location.href = "{{ url('/dashboard') }}";
</script>
@endif
@section('content')

@php
    $list_rents =  json_decode(json_encode($rents), true);
// Comparison function
function status_rate($element1, $element2) {
    $progress1 = $element1['progress'];
    $progress2 = $element2['progress'];
    return $progress2 - $progress1;
} 
  
// Sort the array 
usort($list_rents, 'status_rate');
$all_rents =  json_decode(json_encode($list_rents));
@endphp
    
    <!-- here -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Progress Bar</h6>
                        </div>
                        <div class="col-auto d-flex align-items-right">
                            {{-- <span class="mb-0">View By</span> --}}
                        </div>
                        <div class="col-auto d-flex align-items-right">
                           
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="">
                      <table id="progressTable" class="table align-items-center mb-0">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Room type</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        </thead>
                        <tbody>
                        @foreach ($all_rents as $rent)
                          <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        {{-- <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"> --}}
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">
                                            {{ DB::table('users')->where('id', $rent->user_id)->value('last_name') }}
                                            {{ DB::table('users')->where('id', $rent->user_id)->value('first_name') }}
                                            {{ DB::table('users')->where('id', $rent->user_id)->value('middle_name') }}
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            {{ DB::table('users')->where('id', $rent->user_id)->value('email') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-xs font-weight-bold"> {{ DB::table('rooms')->where('id', $rent->room_id)->value('name') }} </span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-xs font-weight-bold"> ₦{{ $rent->price }} </span>
                            </td>
                            <td class="align-middle">
                                 {{-- Approved --}}
                                @if ($rent->school_check_status != 'Approved' && $rent->payment_reference == null && $rent->guarantor_letter_photo == null && $rent->health_check_photo == null && $rent->attestation_letter_photo == null)
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                        <div class="progress-percentage">
                                            <span class="text-xs font-weight-bold">10%</span>
                                        </div>
                                        </div>
                                        <div class="progress">
                                        <div class="progress-bar bg-gradient-danger w-10" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                   
                                    
                                @elseif ($rent->school_check_status == 'Approved' && $rent->payment_reference == null && $rent->guarantor_letter_photo == null && $rent->health_check_photo == null && $rent->attestation_letter_photo == null)
                               
                                <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                        <div class="progress-percentage">
                                            <span class="text-xs font-weight-bold">20%</span>
                                        </div>
                                        </div>
                                        <div class="progress">
                                        <div class="progress-bar bg-gradient-info w-20" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @elseif ($rent->school_check_status == 'Approved' && $rent->payment_reference != null && $rent->guarantor_letter_photo == null && $rent->health_check_photo == null && $rent->attestation_letter_photo == null)
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                        <div class="progress-percentage">
                                            <span class="text-xs font-weight-bold">35%</span>
                                        </div>
                                        </div>
                                        <div class="progress">
                                        <div class="progress-bar bg-gradient-info w-35" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @elseif ($rent->school_check_status == 'Approved' && $rent->payment_reference != null && $rent->guarantor_letter_photo != null && $rent->health_check_photo == null && $rent->attestation_letter_photo == null)
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                        <div class="progress-percentage">
                                            <span class="text-xs font-weight-bold">70%</span>
                                        </div>
                                        </div>
                                        <div class="progress">
                                        <div class="progress-bar bg-gradient-info w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @elseif ($rent->school_check_status == 'Approved' && $rent->payment_reference != null && $rent->guarantor_letter_photo != null && $rent->health_check_photo != null && $rent->attestation_letter_photo == null)
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                        <div class="progress-percentage">
                                            <span class="text-xs font-weight-bold">85%</span>
                                        </div>
                                        </div>
                                        <div class="progress">
                                        <div class="progress-bar bg-gradient-info w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @elseif ($rent->school_check_status == 'Approved' && $rent->payment_reference != null && $rent->guarantor_letter_photo != null && $rent->health_check_photo != null && $rent->attestation_letter_photo != null)
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                        <div class="progress-percentage">
                                            <span class="text-xs font-weight-bold">100%</span>
                                        </div>
                                        </div>
                                        <div class="progress">
                                        <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                           
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>



            </div>
            <div class="align-items-center" style="float:right;align-items: center !important;">
                {{-- {!! $rents->links() !!} --}}
            </div>
        </div>
    </div>





@endsection

@section('script')

<script>
    $(function() {
       

        $('#progressTable').DataTable({
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
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 15,
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
        .buttons().container().appendTo('#progress-data');

    //     let tableId = $('#progresTable'),
    // searchInput = table
    //   .parents('.dataTables_wrapper')
    //   .find('input[type=search]'),
    // ourInput = $(document.createElement('input'))
    //   .attr({
    //     type: 'search',
    //     'class': 'form-control form-control-sm',
    //     'aria-controls': tableId,
    //   });
    });
</script>
@endsection
