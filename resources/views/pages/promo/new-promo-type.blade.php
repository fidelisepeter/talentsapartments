@extends('layouts.main')
@section('page-title', 'New Promo')
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

    </div>
    
    <div class="row mt-4">
        <h2 class="mb-3">Select Promo Type</h2>
        <div class="col-lg-6 col-md-6 col-12">
          <div class="card text-center">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover p-3" style="background-image: url('../../assets/img/office-dark.jpg')">
              <span class="mask bg-gradient-dark opacity-6"></span>
              <div class="card-body position-relative z-index-1 d-flex flex-column mt-5">
                <h2  style="color: white" class="text-uppercase">Regular</h2>
                <p class="font-weight-bolder"  style="color: white">With A PROMO CODE user can get a room at a discount price. allowing them to pay with a percentage off the original price on a specific room type.</p>
                <a class="text-sm font-weight-bold btn bg-gradient-primary btn-sm mb-0 icon-move-right mt-4" style="color: white" href="/new-promo/regular">
                  Create Promo Code
                  <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                </a>
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12 mt-4 mt-lg-0">
          <div class="card text-center">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover p-3" style="background-image: url('../../assets/img/office-dark.jpg')">
              <span class="mask bg-gradient-dark opacity-6"></span>
              <div class="card-body position-relative z-index-1 d-flex flex-column mt-5">
                <h2  style="color: white" class="font-weight-bolder text-uppercase">Special</h2>
                <p class="font-weight-bolder" style="color: white">This is a combined intrest PROMO where users will come together to occupy a specific room on a discount price once all tenant is completed</p>
                <a class="text-sm font-weight-bold btn bg-gradient-success btn-sm mb-0 icon-move-right mt-4" style="color: white" href="/new-promo/special">
                    Create Promo Code
                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                  </a>
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

            function checkKey() {
                var clean = this.value.replace(/[^0-9,]/g, "")
                    .replace(/(,.?),(.,)?/, "$1");
                // don't move cursor to end if no change
                if (clean !== this.value) this.value = clean;
            }

            // demo
            document.querySelector('#price').oninput = checkKey

            // $("#price").oninput = checkValue;
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
