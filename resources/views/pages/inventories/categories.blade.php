@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('style')
@endsection
@section('page-title', 'Inventory Categories')
@section('content')
    

    <div class="row mt-5">
        <div class="col-sm-4">
            <form class="multisteps-form__form mb-8" action="/inventories/category/store" method="POST" id="inventory-form">
                @csrf
                <!--single form panel-->
                <div class="card border-radius-xl js-active bg-white p-3" data-animation="FadeIn">
                    <h5 class="font-weight-bolder">New Category</h5>
                    <div class="">
                        <div class="mt-sm-0 fv-row mt-3">
                            <label class="">Title </label> 
                            <input class="form-control" type="text" placeholder="eg. Electrical" name="title"
                                id="title"/>
                           
                        </div>

                        <div class="mt-sm-0 fv-row mt-3">
                            <label class="mt-3">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                        </div>
                        <div class="button-row d-flex mt-4">
                            <button class="btn bg-gradient-primary ms-auto js-btn-next mb-0" type="submit" title="Save"
                                id="inventory-form-button">Save</button>
                        </div>
                    </div>
                </div>



            </form>
        </div>
        <div class="col-sm-8">

        <div class="card">
            <!-- Card header -->
            <div class="card-header p-3 pb-0">
                <div class="d-sm-flex justify-content-between mb-2">
                    <div>
                        <h5 class="font-weight-bolder">Categories</h5>
                        {{-- <p class="mb-0 text-sm">
                        Collections of all items in Inventories.
                    </p> --}}

                    </div>
                    <div class="d-flex">
                        <div class="input-group me-3">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" data-inventory-table-filter="search"
                                placeholder="Type here...">
                        </div>
                        
                    </div>
                </div>
            </div>


            <div class="card-body px-0 pb-0">
                <div class="table-responsive px-3">
                    <table class="table-flush table" id="inventories">
                       
                        <tbody>
                            @foreach (\App\Models\InventoryCategory::all() as $category)
                            <tr>
                              <td class="w-30" data-title="{{ $category->title }}">
                                <div class="d-flex px-2 py-1 align-items-center">
                                    <div class="icon icon-shape icon-sm shadow border-radius-sm bg-gradient-primary text-center me-2 d-flex align-items-center justify-content-center">
                                        <svg width="10px" height="10px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                          <title>settings</title>
                                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                              <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(304.000000, 151.000000)">
                                                  <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                                                  <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                                                  <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                                                </g>
                                              </g>
                                            </g>
                                          </g>
                                        </svg>
                                      </div>
                                  <div class="ms-4">
                                    <p class="text-xs font-weight-bold mb-0">Title:</p>
                                    <h6 class="text-sm mb-0">{{ $category->title }}</h6>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="text-center">
                                  <p class="text-xs font-weight-bold mb-0">Description:</p>
                                  <h6 class="text-sm mb-0">{{ $category->description }}</h6>
                                </div>
                              </td>
                              <td>
                                <div class="text-center">
                                  <p class="text-xs font-weight-bold mb-0">Created at:</p>
                                  <h6 class="text-sm mb-0">{{ \Carbon\Carbon::parse($category->created_at)->format('j M Y') }}</h6>
                                </div>
                              </td>
                              <td class="align-middle text-sm">
                                
                                <a href="javascript:;" class="me-3" data-toggle="modal"
                                    data-target="#edit-category-{{ $category->id }}">
                                    <i class="fas fa-eye text-secondary"></i>
                                </a>
                                <a href="javascript:;" data-bs-toggle="tooltip"
                                @if ($category->inventories->count() > 0)
                                data-delete-url=""
                                @else
                                data-delete-url="{{ url('/inventories/category/'.$category->id.'/delete') }}"
                                @endif
                                    data-bs-original-title="Delete product"
                                    data-inventory-table-filter="delete_row">
                                    <i class="fas fa-trash text-secondary"></i>
                                </a>
                               
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        <tbody>
                           
                              
                            

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    @foreach (\App\Models\InventoryCategory::all() as $category)
    <div class="modal fade" id="edit-category-{{ $category->id }}" role="dialog" aria-labelledby="edit-category-{{ $category->id }}"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card border-radius-xl shadow border-0 mb-0 js-active bg-white p-3" data-animation="FadeIn">
                        <div class="card-header d-flex p-3">
                            <h5 class="font-weight-bolder">Update Category</h5>
                            <button type="button" class="btn-close text-dark" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        <div class="card-body p-3">
                            <form class="" action="/inventories/category/{{ $category->id }}/update" method="POST" id="inventory-form">
                                @csrf
                               
                                        <div class="mt-sm-0 fv-row mt-3">
                                            <label class="">Title </label> 
                                            <input class="form-control" type="text" placeholder="eg. Electrical" name="title"
                                                id="title" value="{{ $category->title }}"/>
                                           
                                        </div>
                
                                        <div class="mt-sm-0 fv-row mt-3">
                                            <label class="mt-3">Description</label>
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{ $category->description }}</textarea>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-primary ms-auto js-btn-next mb-0" type="submit" title="Save"
                                                id="inventory-form-button">Update</button>
                                        </div>
                                  
                
                
                
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/assets/css/daterangepicker.css') }}" />

    <style>
        #inventories_filter {
            display: none;
        }
    </style>
@endsection

@section('script')

    <script>
        // function replyTo(id, email){
        //         alert("You entered p1!"+id+email);
        //     }
        $(document).ready(function() {



            const e = $('#inventories').DataTable({
                info: !1,
                language: {
                    paginate: {
                        previous: "‹",
                        first: "«",
                        next: "›",
                        last: "»",
                    }
                },
                order: [],
                pageLength: 10,
                lengthChange: !1,
                columnDefs: [{
                        orderable: !1,
                        targets: 0
                    }, {
                        orderable: !1,
                        targets: 3
                    },
                    {
                        searchable: false,
                        targets: 3
                    }
                ]
            });

            document.querySelector('[data-inventory-table-filter="search"]')
                .addEventListener("keyup", (function(t) {
                    e.search(t.target.value).draw()
                }))


           

            document.querySelectorAll('[data-inventory-table-filter="delete_row"]').forEach((t => {
                t.addEventListener("click", (function(t) {
                    t.preventDefault();
                    const n = t.target.closest("tr"),
                        r = n.querySelectorAll("td")[0].getAttribute('data-title'),
                        url = this.getAttribute('data-delete-url');
                       

                        if(url != ''){
                    Swal.fire({
                        text: "Are you sure you want to delete " + r + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger me-2 mb-4",
                            cancelButton: "btn fw-bold btn-primary mb-4"
                        }
                    }).then((function(t) {
                        t.value ? (window.location
                            .href =
                            url) : "cancel" === t.dismiss && Swal.fire({
                            text: r +
                                " was not deleted.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        })
                    }))
                }else{
                    Swal.fire({
                        text: "Sorry you can delete " + r + " because it is in use",
                        icon: "error",
                        showCancelButton: !1,
                        buttonsStyling: !1,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger me-2 mb-4",
                            cancelButton: "btn fw-bold btn-primary mb-4"
                        }
                    })
                }

                }))
            }));

          


        });
    </script>
@endsection
