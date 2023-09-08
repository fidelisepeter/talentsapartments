@extends('layouts.main')
@section('page-title', 'Products')
@if (Auth::user()->role == 'student')
    {{-- Stay --}}
@else
    {{ Session::flash('error', 'You are not permited to view that page') }}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@section('content')

    <div class="row mt-3">
        {{-- <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count($bedspaces) }}
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
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Allocated</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $allocated }}
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
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Free Bed</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $freespace }}
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
        </div> --}}
        {{-- <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Rooms</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count(\App\Helpers\Rooms::allRooms()) }}
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
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Bedspace</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ DB::table('bed_spaces')->get()->count() }}
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
        </div> --}}
    </div>
    <div class="row">
        @foreach ($services as $product)
        <div class="col-lg-4 col-12 mt-4 mt-lg-0 mb-3">
            <div class="card">
              <div class="card-header p-3 pb-0">
                <div class="row">
                  <div class="col-8 d-flex">
                    <div>
                      <img src="{{ $product->photo }}" class="avatar avatar-sm me-2" alt="avatar image">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">uploaded on</h6>
                      <p class="text-xs">{{ \Carbon\Carbon::parse($product->created_at)->format('d/m/Y') }}</p>
                    </div>
                  </div>
                  <div class="col-4">
                      @if (\Carbon\Carbon::parse($product->updated_at) >= \Carbon\Carbon::now()->subDays(7))
                      <span class="badge bg-gradient-info ms-auto float-end">New</span>
                      @endif
                    
                  </div>
                </div>
              </div>
              <div class="card-body p-3 pt-1">
                <h6>{{ $product->name }} @if (count(explode(',', $product->price)) > 1) (Multi-price) @endif</h6>
                <p class="text-sm">{{ $product->description }}</p>
                <form action="/create_product_invoice/{{$product->uid}}" method="post">
                    @csrf
                <div class="d-flex bg-gray-100 border-radius-lg p-3">
                  <h4 class="my-auto d-inline-flex">
                    @if (count(explode(',', $product->price)) > 1)
                        <span class="text-secondary text-sm me-1">N</span> 
                        <select name="price" class="form-control room h4 bg-gray-100 m-0 py-1" style="border: 0px;" name="room" id="room" name="room" required oninvalid="this.setCustomValidity('Click here to select price from dropdown')" oninput="setCustomValidity('')">
                            <option value="">Choose</option>
                            @foreach (explode(',', $product->price) as $price)
                            <option value="{{ $price }}">{{ number_format($price) }}</option>
                            @endforeach
                        </select>
                    @else
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <span class="text-secondary text-sm me-1">N</span>{{ number_format($product->price) }}<span class="text-secondary text-sm ms-1"></span>
    
                    @endif
                    </h4>
                  {{-- @if (DB::table('purchased_services')->where('user_id', Auth::user()->id)->where('service_uid', $product->uid)->value('status') == 'purchased')
                  <a href="#" class="btn btn-dark mb-0 ms-auto">Purchased</a>
                  @elseif(DB::table('purchased_services')->where('user_id', Auth::user()->id)->where('service_uid', $product->uid)->value('status') == 'waiting')
                  <a href="/services/purchase/__product/{{DB::table('purchased_services')->where('user_id', Auth::user()->id)->where('service_uid', $product->uid)->value('service_uid')}}/invoice/{{DB::table('purchased_services')->where('user_id', Auth::user()->id)->where('service_uid', $product->uid)->value('application_no')}}" class="btn btn-outline-dark mb-0 ms-auto">Continue Purchase</a>
                  @else --}}
                  <button type="submit" class="btn btn-outline-dark mb-0 ms-auto">Purchase</button>
                  
                  {{-- @endif --}}
                  
                </div>
            </form>
              </div>
            </div>
          </div>
        @endforeach
    </div>

        
    @endsection
    @section('script')
        <script>
            // Limit user from selecting more than one amenities
            $(document).ready(function() {
                // $("#updateProduct").click(function() {
                //     alert('ghhgjbj')
                //     // $("#updateProductModel").modal("show")
                // });

                $("#updateProduct").on('click', function() {
                    alert('ghhgjbj')
                    // $("#updateProductModel").modal("show")
                });

                $('#bed-space').DataTable({
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


                }).buttons().container().appendTo('#bed-space-data');

            });
        </script>
    @endsection
