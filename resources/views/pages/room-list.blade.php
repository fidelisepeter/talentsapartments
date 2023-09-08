@extends('layouts.main')
@section('page-title', 'Room List')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
{{-- Stay --}}
@else
{{ Session::flash('error','You are not permited to view that page') }}
<script>
  window.location.href = "{{ url('/dashboard') }}";
</script>
@endif
@section('content')
    <div class="card card-body blur shadow-blur overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">

            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Talents Room List

                    </h5>

                </div>
            </div>

        </div>
    </div>
    
    <div class="row">

       
        <div class="col-md-12 mb-md-0 mb-4 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <span class="d-sm-inline d-none text-body font-weight-bold px-3">
                                    Room List
                                </span>

                                

                            </div>
                        </div>
                        <div class="col-sm-6" id="room-list-data">
                        </div>
                        
                    </div>
                    
                </div>
                <div class="card-body px-3 pb-2">
                    <div class="table-responsive">
                        <table id="room-list" class="table table-bordered table-hover align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (DB::table('bed_spaces')->where('year', $viewingYear)->whereNotNull('user_id')->where('allocated', true)->get() as $room)
                                    <tr>
                                        <td>
                                            <table class="table table-hover  align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="">
                                                                <h1 class="text-sm font-weight-bold">
                                                                    <span class=" text-uppercase ">
                                                                        {{ $room->room_number ?? '' }}
                                                                    </span>
                                                                    
                                                                </h1>
                                                                <p class="text-xs text-secondary mb-0">{{ $room->building_name ?? '' }}</p>
                                                            </div>
                                                    </th>
                                                    <th></th>
                                                    <th></th>
                                                        
                                                    </tr>
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach (\App\Models\BedSpace::where('id', $room->id)->where('year', $viewingYear)->whereNotNull('user_id')->where('allocated', true)->get() as $resident)
                                                    <tr>
                                                        <td>

                                                        </td>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                {{-- <div>
                                                                    <span class="text-xs font-weight-bold">
                                                                        1
                                                                    </span>
                                                                  </div> --}}
                                                                <div>
                                                                  <img src="{{ $resident->user->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                                                                </div>
                                                                <a href="/resident/{{ $resident->user->id }}">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                  <h6 class="mb-0 text-xs font-weight-bold ">{{ $resident->user->first_name }}
                                                                  {{ $resident->user->middle_name }}
                                                                  {{ $resident->user->last_name }} <a href="/resident/{{ $resident->user->id }}"><i class="fa fa-pencil"></i></a></h6>
                                                                  <p class="text-xxs text-secondary mb-0">{{ $resident->user->phone_number }}, {{ $resident->user->email }}, {{ $resident->user->ta_uid }} </p>
                                                                </div>
                                                                </a>
                                                              </div>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">{{ $resident->user->course }}, {{ $resident->user->faculty }}, {{ $resident->user->department }}</p>
                                                            <p class="text-xs text-secondary mb-0">{{ $resident->user->matric_number }}, {{ $resident->user->year }}</p>
                                                          
                                                        </td>
                                                        
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            
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
            // Select all elements with data-toggle="popover" in the document
            // $('[data-toggle="popover"]').popover();

        });
    </script>
    <script>
        $(function() {
            $('#rooms').DataTable({
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
                // "lengthMenu": [[2, 25, 50, -1], [2, 25, 50, "All"]],
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                "responsive": false,
                // "buttons": ["csv", "excel", "pdf", "print"]
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
                    // "buttonLiner": {
                    //     "tag": "span",
                    //     "className": ""
                    // }
                }
                },
                // "columnDefs": [{
                //     "targets": -1,
                //     "className": 'dt-body-right'
                // }],
                // "select": true,
                "info": false,
                // "infoCallback": function(settings, start, end, max, total, pre) {
                //     var api = this.api();
                //     var pageInfo = api.page.info();

                //     return 'Page ' + (pageInfo.page + 1) + ' of ' + pageInfo.pages;
                // },
                // "dom": 'rt<"bottom-right"p><"clear">',
                // "dom": {
                //     // "container": {
                //     //     "tag": "div",
                //     //     "className": "dt-buttons"
                //     // },
                //     // "collection": {
                //     //     "tag": "div",
                //     //     "className": ""
                //     // },
                //     // "button": {
                //     //     "tag": "button",
                //     //     "className": "dt-button",
                //     //     "active": "active",
                //     //     "disabled": "disabled"
                //     // },
                //     // "buttonLiner": {
                //     //     "tag": "span",
                //     //     "className": ""
                //     // }
                // }
            }).buttons().container().appendTo('#rooms-data');

            $('#free-rooms').DataTable({
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
               
                
            }).buttons().container().appendTo('#free-rooms-data');


            $('#room-list').DataTable({
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
               
                
            }).buttons().container().appendTo('#room-list-data');
        });
    </script>
@endsection
