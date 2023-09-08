@extends('layouts.main')
@section('page-title', 'Residents')

@section('content')
<div class="row pb-5">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <a href="/residents"><p class="text-sm mb-0 text-capitalize font-weight-bold">Total</p></a>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count($residents); }}
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
                                <a href="/residents?sort=expiring-65-days"><p class="text-sm mb-0 text-capitalize font-weight-bold">65 days to Expire</p></a>
                                <h5 class="font-weight-bolder mb-0">
                                
                                    {{ count(\App\Helpers\Rooms::expiredInDays(65, 35)) }}
                                    
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
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <a href="/residents?sort=expiring-35-days"><p class="text-sm mb-0 text-capitalize font-weight-bold">35 days to Expire</p></a>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::expiredInDays(35, 0)); }}
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
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <a href="/residents?sort=expired"><p class="text-sm mb-0 text-capitalize font-weight-bold">Expired</p></a>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::expired()); }}
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
        </div>
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-sm-6"><h6>Residents</h6></div>
                    <div class="col-sm-6" id="residents-data"></div>
                  </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table id="residentTable" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Resident</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Room</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Room Price</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Move in</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Move out</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($residents as $resident)
                      <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{ $resident->user->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <a href="/resident/{{ $resident->user->id }}">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $resident->user->first_name }}
                            {{ $resident->user->middle_name }}
                            {{ $resident->user->last_name }} <a href="/resident/{{ $resident->user->id }}"><i class="fa fa-pencil"></i></a></h6>
                            <p class="text-xs text-secondary mb-0">{{ $resident->user->email }} - {{ $resident->user->phone_number }}</p>
                          </div>
                          </a>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $resident->building_name }}, {{ $resident->room_label }}</p>
                        <p class="text-xs text-secondary mb-0">{{ $resident->room_number }}, {{ $resident->room->name }}, {{ $resident->name }}</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ isset($resident->rent) && $resident->rent->price ? \App\Helper\Helper::currency($resident->rent->price) : '' }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ isset($resident->rent) && $resident->rent->move_in ? \Carbon\Carbon::parse($resident->rent->move_in)->format('j M, Y') : '' }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ isset($resident->rent) && $resident->rent->expiring_date ? \Carbon\Carbon::parse($resident->rent->expiring_date)->format('j M, Y') : '' }}</span>
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
           
            
        })
        .buttons().container().appendTo('#residents-data');

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
