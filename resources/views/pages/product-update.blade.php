@extends('layouts.main')
@section('page-title', 'Products')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
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
        <div class="col-sm-8 m-auto">
            <div class="card shadow ">
                <div class="card-header  p-3">
                    <h6 class="mb-0">Update Products</h6>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="alert alert-info" style="color: white"> 
                        Seperate prices with comma
                    </div>
                    <form method="POST" action="/update_product/{{ $product->id}}" enctype="multipart/form-data">@csrf

                        <div class="row mt-3">
                            <div class="col-12">
                              <label>Name</label>
                              <input class=" form-control" name="name" type="text" placeholder="eg. Television" value="{{ $product->name}}">
                            </div>
                            
                          </div>
                          <div class="row">
                            <div class="col-sm-6">
                              <label class="mt-4">Description</label>
                              <textarea class=" form-control"  name="description" id="" cols="30" rows="5">{{ $product->description}}</textarea>
                            </div>
                            <div class="col-sm-6 mt-sm-0 mt-4">
                              <label class="mt-4">Price</label>
                              <input class=" form-control" name="price" id="price" type="text" value="{{ $product->price}}">
                            <label>Image</label>
                            <input class=" form-control" name="photo" type="file" >
                        </div>
                          </div>
                          <div class="button-row d-flex mt-4">
                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit">Update Product</button>
                          </div>



                    </form>
                    </ul>
                </div>
            </div>

        </div>
    </div>

        <div class="modal fade" id="newProducts" tabindex="-1" role="dialog" aria-labelledby="newProducts"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card shadow ">
                            <div class="card-header  p-3">
                                <h6 class="mb-0">Create Products</h6>
                            </div>
                            <div class="card-body p-3 pt-0">
                                <form method="POST" action="create_product" enctype="multipart/form-data">@csrf

                                    <div class="row mt-3">
                                        <div class="col-12">
                                          <label>Name</label>
                                          <input class=" form-control" name="name" type="text" placeholder="eg. Television">
                                        </div>
                                        
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label class="mt-4">Description</label>
                                          <textarea class=" form-control"  name="description" id="" cols="30" rows="5"></textarea>
                                        </div>
                                        <div class="col-sm-6 mt-sm-0 mt-4">
                                          <label class="mt-4">Price</label>
                                          <input class=" form-control" name="price" type="text" >
                                        <label>Image</label>
                                        <input class=" form-control" name="photo" type="file" >
                                    </div>
                                      </div>
                                      <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit">Upload Product</button>
                                      </div>



                                </form>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateProductModel" tabindex="-1" role="dialog" aria-labelledby="updateProducts"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card shadow ">
                            <div class="card-header  p-3">
                                <h6 class="mb-0">Update Products</h6>
                            </div>
                            <div class="card-body p-3 pt-0">
                                <form method="POST" action="update_product/33" enctype="multipart/form-data">@csrf

                                    <div class="row mt-3">
                                        <div class="col-12">
                                          <label>Name</label>
                                          <input class=" form-control" name="name" type="text" placeholder="eg. Television">
                                        </div>
                                        
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label class="mt-4">Description</label>
                                          <textarea class=" form-control"  name="description" id="" cols="30" rows="5"></textarea>
                                        </div>
                                        <div class="col-sm-6 mt-sm-0 mt-4">
                                          <label class="mt-4">Price</label>
                                          <input class=" form-control" name="price" type="text" >
                                        <label>Image</label>
                                        <input class=" form-control" name="photo" type="file" >
                                    </div>
                                      </div>
                                      <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit">Update Product</button>
                                      </div>



                                </form>
                                </ul>
                            </div>
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
                // $("#updateProduct").click(function() {
                //     alert('ghhgjbj')
                //     // $("#updateProductModel").modal("show")
                // });

                function checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.?),(.,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#price').oninput = checkKey

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
