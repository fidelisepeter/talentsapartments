@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('style')
@endsection
@section('page-title', 'Inventories')
@section('content')
    <div class="row pb-5">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <a href="javascript:;">
                                    <p class="text-capitalize font-weight-bold mb-0 text-sm">Total</p>
                                </a>
                                <h5 class="font-weight-bolder mb-0">
                                    
                                    {{ count(\App\Models\Inventory::all()); }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary border-radius-md text-center shadow">
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
                                <a href="javascript:;">
                                    <p class="text-capitalize font-weight-bold mb-0 text-sm">Items Worth</p>
                                </a>
                                <h5 class="font-weight-bolder mb-0">

                                    ₦{{ \App\Models\Inventory::sum(DB::raw('cost * quantity')) }}

                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary border-radius-md text-center shadow">
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
                                <a href="javascript:;">
                                    <p class="text-capitalize font-weight-bold mb-0 text-sm">Purchased</p>
                                </a>
                                <h5 class="font-weight-bolder mb-0">
                                    
                                    ₦{{ \App\Models\PurchasedItem::sum('cost') }}
                                    {{-- ₦{{ \App\Models\PurchasedItem::sum(DB::raw('quantity * (SELECT cost FROM inventories WHERE inventories.id = purchased_items.inventory_id)')) }} --}}
                                
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary border-radius-md text-center shadow">
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
                                <a href="javascript:;">
                                    <p class="text-capitalize font-weight-bold mb-0 text-sm">Available</p>
                                </a>
                                <h5 class="font-weight-bolder mb-0">
                                    {{-- {{ (\App\Models\Inventory::all()->sum('cost') - \App\Models\PurchasedItem::all()->sum('cost')) }} --}}
                                    {{-- {{ 
                                    \App\Models\Inventory::where('quantity', '>', 0) // Assuming you want to consider only items with a positive initial quantity
    ->whereColumn('quantity', '>', DB::raw('(SELECT SUM(quantity) FROM purchased_items WHERE inventory_id = inventories.id)'))
    ->where('quantity', '>', 0)
    ->count() }} --}}
@php
 $count = 0;
    foreach (\App\Models\Inventory::all() as $item) {
       if ($item->status != 'Out of Stock') {
        $count++;
        # code...
       }
    }
@endphp
{{ $count }}

                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary border-radius-md text-center shadow">
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

       
        <div class="card">
            <!-- Card header -->
            <div class="card-header p-3 pb-0">
                <div class="d-sm-flex justify-content-between mb-2">
                    <div>
                        <h5 class="mb-md-3 mb-3">Inventories</h5>
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
                        <div class="dropdown d-inline me-2">
                            <a href="javascript:;" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown"
                                id="navbarDropdownMenuLink2">
                                Filters
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                aria-labelledby="navbarDropdownMenuLink2" data-popper-placement="left-start">
                                <div class="row d-none d-lg-block">
                                    <div class="col-12 px-4 py-2">
                                        <div class="row">
                                            <div class="col-6 position-relative">
                                                <div
                                                    class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0">
                                                    <div class="d-inline-block">
                                                        <div
                                                            class="icon icon-shape icon-xs border-radius-md bg-gradient-primary me-2 d-flex align-items-center justify-content-center text-center">
                                                            <svg width="12px" height="12px" viewBox="0 0 40 44"
                                                                version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                <title>document</title>
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <g transform="translate(-1870.000000, -591.000000)"
                                                                        fill="#FFFFFF" fill-rule="nonzero">
                                                                        <g transform="translate(1716.000000, 291.000000)">
                                                                            <g
                                                                                transform="translate(154.000000, 300.000000)">
                                                                                <path
                                                                                    d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                                                    opacity="0.603585379"></path>
                                                                                <path
                                                                                    d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                                                </path>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    Filter Options



                                                </div>


                                            </div>
                                            <div data-inventory-table-filter="form">

                                                <div class="mt-2">
                                                    <label class="">Category</label>
                                                    <select class="form-control" data-inventory-table-filter="category">
                                                        <option value="">All</option>
                                                        @foreach (\App\Models\InventoryCategory::all() as $category)
                                                            <option value="{{ $category->title }}">{{ $category->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mt-2">
                                                    <label class="">Status</label>
                                                    <select class="form-control" data-inventory-table-filter="status">
                                                        {{-- <option value="">All</option> --}}
                                                        <option>Available</option>
                                                        <option>Low Stock</option>
                                                        <option>Out of Stock</option>
                                                    </select>
                                                </div>
                                                <div class="button-row d-flex mt-4">
                                                    <button class="btn bg-default ms-auto js-btn-next me-2 mb-0"
                                                        data-inventory-table-filter="reset">Reset</button>
                                                    <button class="btn bg-gradient-dark ms-auto js-btn-next mb-0"
                                                        data-inventory-table-filter="filter">Apply</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <a href="inventories/create" class="btn btn-icon bg-gradient-primary ms-2">
                            Create
                        </a>
                    </div>
                </div>
            </div>


            <div class="card-body px-0 pb-0">
                <div class="table-responsive px-3">
                    <table class="table-flush table" id="inventories">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-start">Items</th>
                                <th>Category</th>
                                <th>Cost</th>
                                <th>Quantity</th>
                                <th>Purchased</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\Inventory::all() as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check my-auto">
                                                <input class="form-check-input" type="checkbox" id="customCheck1">
                                            </div>

                                            <h6 class="ms-3 my-auto">{{ $item->item }}</h6>
                                        </div>
                                    </td>
                                    <td class="text-sm">{{ $item->category_name }}</td>
                                    <td class="text-sm">₦{{ $item->cost }}</td>
                                    <td class="text-sm">{{ $item->quantity-$item->purchased->sum('quantity') }}</td>
                                    <td class="text-sm">{{ $item->purchased->sum('quantity') }}</td>
                                    <td class="text-sm">{{ \Carbon\Carbon::parse($item->updated_at)->format('j M Y') }}
                                    </td>
                                    <td>
                                        @if ($item->status == 'Out of Stock')
                                            <span class="badge badge-danger badge-sm">{{ $item->status }}</span>
                                        @elseif ($item->status == 'Low Stock')
                                            <span class="badge badge-warning badge-sm">{{ $item->status }}</span>
                                        @elseif ($item->status == 'Available')
                                            <span class="badge badge-success badge-sm">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-sm">
                                        <a href="/inventories/{{ $item->id }}" data-bs-toggle="tooltip" class="me-3"
                                            data-bs-original-title="Preview product">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </a>
                                       
                                        <a href="/inventories/{{ $item->id }}/delete" data-bs-toggle="tooltip"
                                            data-bs-original-title="Delete product"
                                            data-inventory-table-filter="delete_row">
                                            <i class="fas fa-trash text-secondary"></i>
                                        </a>
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
                        targets: 4
                    },
                    {
                        searchable: false,
                        targets: 4
                    }
                ]
            });

            document.querySelector('[data-inventory-table-filter="search"]')
                .addEventListener("keyup", (function(t) {
                    e.search(t.target.value).draw()
                }))


            const t = document.querySelector('[data-inventory-table-filter="form"]');
            const n = t.querySelector('[data-inventory-table-filter="filter"]');
            const r = t.querySelectorAll("select");
            n.addEventListener("click", (function() {
                var v = "";
                r.forEach(((e, n) => {
                    e.value && "" !== e.value && (0 !== n && (v +=
                        " "), v += e.value)
                }));
               
                e.search(v).draw();
            }))

            document.querySelector('[data-inventory-table-filter="reset"]').addEventListener(
                "click", (function() {
                    document.querySelector('[data-inventory-table-filter="form"]')
                        .querySelectorAll("select").forEach((e => {
                            $(e).val("").trigger("change")
                        })), e.search("").draw()
                }));

            document.querySelectorAll('[data-inventory-table-filter="delete_row"]').forEach((t => {
                t.addEventListener("click", (function(t) {
                    t.preventDefault();
                    const n = t.target.closest("tr"),
                        r = n.querySelectorAll("td")[0].innerText,
                        url = this.getAttribute('href');
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
                }))
            }));

          


        });
    </script>
@endsection
