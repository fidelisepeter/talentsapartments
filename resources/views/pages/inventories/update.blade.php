@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('style')
@endsection
@section('page-title', 'Item ', $item->name)
@section('content')
<div class="row">
    <div class="col-12 col-lg-8 m-auto">
      <form class="multisteps-form__form mb-8" action="/inventories/update/{{ $item->id }}" method="POST" id="inventory-form">
        @csrf
        <!--single form panel-->
        <div class="card border-radius-xl js-active bg-white p-3" data-animation="FadeIn">
            <h5 class="font-weight-bolder">Item Information</h5>
            <div class="">
                <div class="row mt-3">
                    <div class="col-12 col-sm-6 fv-row">


                        <label class="">Category</label>
                        <select class="form-control" name="category_id" id="category_id">
          @foreach (\App\Models\InventoryCategory::all() as $category)
          <option value="{{ $category->id }}" @if($item->category_name == $category->id) seleted @endif>{{ $category->title }}</option>
          @endforeach
        </select>

                    </div>
                    <div class="col-12 col-sm-6 mt-sm-0 fv-row mt-3">
                        <label class="">Item </label> 
                        <input class="form-control" type="text" placeholder="eg. Bulb" name="item_input"
                            id="item-input"  value="{{ $item->item }}"/>
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="fv-row">
                            <label class="mt-3">Quantity ({{ $item->quantity }} remaining {{ $item->quantity-$item->purchased->sum('quantity') }})</label>
                            <input class="form-control" type="text" placeholder="Quantity you're adding or subtracting eg. 10 or -10" name="quantity"/>

                        </div>
                        <div class="fv-row">
                            <label class="mt-3">Cost</label>
                            <input class="form-control" type="text" placeholder="2000" name="cost" value="{{ $item->cost }}"/>
                        </div>


                    </div>
                    <div class="col-sm-6 mt-sm-0 fv-row mt-4">
                        <label class="mt-3">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{ $item->description }}</textarea>
                    </div>
                </div>

                <div class="button-row d-flex mt-4">
                    <button class="btn bg-gradient-dark ms-auto js-btn-next mb-0" type="submit" title="Save"
                        id="inventory-form-button">Save</button>
                </div>
            </div>
        </div>



    </form>

    </div>
  </div>
@endsection

        @section('styles')
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/js/plugins/formvalidation/dist/css/formValidation.min.css') }}" />
        @endsection

        @section('script')

        <script src="{{ asset('assets/js/plugins/quill.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/FormValidation.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Excluded.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Bootstrap3.min.js') }}"></script> --}}
    
        <script>
            $(document).ready(function() {

              
    
                const loadItems = () => {
                    $.ajax({
                        url: "/inventories/get-items-by-category/" + document.querySelector(
                            '#category_id').value,
                        method: "GET",
    
                        success: function(data) {
                          document.querySelector('#item-input').value = '';
                            if (data != '') {
                                document.querySelector('#item-select').innerHTML = data;
                                document.querySelector('#item-select').disabled = false;
                                document.querySelector('#item-input').disabled = true;
                                document.querySelector('#item-input').classList.add('d-none');
                                document.querySelector('#item-select').classList.remove('d-none');
                                document.querySelector('#switch-item-input').innerText = 'New';
                            } else {
                                document.querySelector('#item-input').disabled = false;
                                document.querySelector('#item-select').disabled = true;
                                document.querySelector('#item-select').classList.add('d-none');
                                document.querySelector('#item-input').classList.remove('d-none');
                                document.querySelector('#switch-item-input').innerText = 'Existing';
                                document.querySelector('#item-select').innerHTML =
                                    '<option disabled>nothing to select</option>';
                            }
    
                        },
                        error: function(xhr) {}
                    });
                }
    
                document.querySelector('#category_id').addEventListener('change', function() {
                    // loadItems()
                })

    
                if (document.getElementById('deschiption')) {
                    var quill = new Quill('#deschiption', {
                        theme: 'snow' // Specify theme in configuration
                    });
                    
                };
    
                const form = document.querySelector("#inventory-form");
                const button = document.querySelector("#inventory-form-button");
               
                FormValidation.validators.customQuantityValidator = function() {
                            return {
                                validate: function(input) {
                                    const value = input.value;

                                    // Check if it's in the specified format
                                    if (/^-?\d+$/.test(value)) {
                                        return {
                                            valid: true
                                        };
                                    }

                                    return {
                                        valid: false
                                    };
                                },
                            };
                        };
                const fv = FormValidation.formValidation(form, {
                    fields: {
                        'item-input': {
                            validators: {
                                notEmpty: {
                                    message: "Item name is required"
                                },
                                remote: {
                                  message: "Item already exist",
                                    url: function() {
                                      return '/inventories/item-exist';
                                    },
                                    data: {
                                      new_name: document.getElementById('item-input').value,
                                      id: '{{ $item->id }}',
                                    },
                                    method: 'GET',
                                },
                            }
                        },
                        'item-select': {
                            validators: {
                                notEmpty: {
                                    message: "Item name is required"
                                },
                            }
                        },
                        'category': {
                            validators: {
                                notEmpty: {
                                    message: "Please choose Item category"
                                },
                            },
                        },
                        'quantity': {
                            validators: {
                                notEmpty: {
                                    message: "Quantity is required"
                                },
                                customQuantityValidator: {
                                    message: "Value must contain only positive or nagative number"
                                },
                            },
                        },
                        cost: {
                            validators: {
                                notEmpty: {
                                    message: "Item cost is required"
                                },
                                digits: {
                                    message: "Value must contain only digits"
                                },
                            },
                        }
    
                    },
                    plugins: {
                        excluded: new FormValidation.plugins.Excluded({
                            excluded: function(field, element, elements) {
    
                                return element.disabled
                            },
                        }),
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "is-invalid",
                            eleValidClass: "is-valid"
                        })
                    }
                });
    
                button.addEventListener("click", (function(n) {
                    n.preventDefault(),
                        fv.validate().then((function(i) {
    
                            if ("Valid" == i) {
                                button.setAttribute("data-kt-indicator", "on");
                                button.removeAttribute("data-kt-indicator");
                                button.disabled = !1;
                                // button.setAttribute("data-kt-indicator", "on");
                                button.disabled = !0;
                                setTimeout((function() {
                                    // button.removeAttribute("data-kt-indicator"); 
                                    button.disabled = !1;
                                    form.submit();
                                }), 2e3)
                            } else {
                                Swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                })
                            }
                            // "Valid" == i ? (button.setAttribute("data-kt-indicator", "on"), t
                            //     .disabled = !0, setTimeout((function() {
                            //         button.removeAttribute("data-kt-indicator"), t
                            //             .disabled = !1,
                            //             // form.submit();
                            //     }), 2e3)) : Swal.fire({
                            //     text: "Sorry, looks like there are some errors detected, please try again.",
                            //     icon: "error",
                            //     buttonsStyling: !1,
                            //     confirmButtonText: "Ok, got it!",
                            //     customClass: {
                            //         confirmButton: "btn btn-primary"
                            //     }
                            // })
                        }))
                }));
    
            });
        </script>
        <script></script>
    @endsection
    
