@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('style')
@endsection
@section('page-title', 'Creat Inventory')
@section('content')
    <div class="row">
        <div class="col-12 col-lg-8 m-auto">
            <form class="multisteps-form__form mb-8" action="/inventories/store" method="POST" id="inventory-form">
                @csrf
                <!--single form panel-->
                <div class="card border-radius-xl js-active bg-white p-3" data-animation="FadeIn">
                    <h5 class="font-weight-bolder">Item Information</h5>
                    <div class="">
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6 fv-row">


                                <label class="">Category</label>
                                <select class="form-control" name="category_id" id="category_id" data-control="select2"
                                    data-hide-search="true" data-placeholder="Select Category type">
                                    @foreach (\App\Models\InventoryCategory::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-12 col-sm-6 mt-sm-0 fv-row mt-3">
                                <label class="">Item <span class="text-primary" id="switch-item-input"
                                        style="cursor: pointer;">
                                        @if (\App\Models\Inventory::get('item')->unique('item')->count() > 0)
                                            New
                                        @else
                                            Existing
                                        @endif
                                    </span></label>
                                <input class="form-control @if (\App\Models\Inventory::get('item')->unique('item')->count() > 0) d-none @endif" type="text"
                                    placeholder="eg. Bulb" name="item_input" id="item-input"
                                    @if (\App\Models\Inventory::get('item')->unique('item')->count() > 0) disabled @endif />
                                <select class="form-control @if (\App\Models\Inventory::get('item')->unique('item')->count() == 0) d-none @endif"
                                    name="item_select" id="item-select" data-control="select2" data-hide-search="true"
                                    data-placeholder="Select Category type"
                                    @if (\App\Models\Inventory::get('item')->unique('item')->count() == 0) disabled @endif>
                                    @foreach (\App\Models\Inventory::get('item')->unique('item') as $data)
                                        <option value="{{ $data->item }}">{{ $data->item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="fv-row">
                                    <label class="mt-3">Quantity <span id="pre-quantity"></span></label>
                                    <input class="form-control" type="text" placeholder="Quantity you're adding eg. 10" name="quantity" />

                                </div>
                                <div class="fv-row">
                                    <label class="mt-3">Cost</label>
                                    <input class="form-control" type="text" placeholder="cost per each" name="cost" />
                                </div>


                            </div>
                            <div class="col-sm-6 mt-sm-0 fv-row mt-4">
                                <label class="mt-3">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
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
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
    <style>
        .custom-element {
            display: flex;
        }

        .custom-element select,
        .custom-element input {
            flex: 1;
        }
    </style>
@endsection

@section('script')

    <script src="{{ asset('assets/js/plugins/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/FormValidation.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Excluded.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Bootstrap3.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            const loadItems = () => {
                $.ajax({
                    url: "/inventories/get-items-by-category/" + document.querySelector(
                        '#category_id').value,
                    method: "GET",

                    success: function(data) {

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

            document.querySelector('#item-select').addEventListener('change', function() {

                $.ajax({
                    url: "/inventories/get-items-details-by-name/" + document.querySelector(
                        '#item-select').value,
                    method: "GET",
                    dataType: 'JSON',
                    success: function(data) {

                        document.querySelector('#pre-quantity').innerText =
                            `(${data[0].quantity} remaining ${data[0].remaining_quantity})`;
                        document.querySelector('input[name="cost"]').value = data[0].cost;
                        document.querySelector('input[name="quantity"]').placeholder =
                            `Quantity you're adding or subtracting eg. 10 or -10`;
                    },
                    error: function(xhr) {}
                });

            })
            document.querySelector('#category_id').addEventListener('change', function() {
                loadItems()
            })

            document.querySelector('#switch-item-input').addEventListener('click', function() {
                const value = this.innerText;
                //   alert(value)
                if (value == 'New') {
                    document.querySelector('#item-input').disabled = false;
                    document.querySelector('#item-select').disabled = true;
                    document.querySelector('#item-select').classList.add('d-none');
                    document.querySelector('#item-input').classList.remove('d-none');
                    document.querySelector('#switch-item-input').innerText = 'Existing';
                    document.querySelector('#pre-quantity').innerText = '';
                    document.querySelector('input[name="cost"]').value = '';
                    document.querySelector('input[name="quantity"]').placeholder = 'eg. 42';
                } else {
                    loadItems()
                    document.querySelector('#item-select').disabled = false;
                    document.querySelector('#item-input').disabled = true;
                    document.querySelector('#item-input').classList.add('d-none');
                    document.querySelector('#item-select').classList.remove('d-none');
                    document.querySelector('#switch-item-input').innerText = 'New';

                    $.ajax({
                        url: "/inventories/get-items-details-by-name/" + document.querySelector(
                            '#item-select').value,
                        method: "GET",
                        dataType: 'JSON',
                        success: function(data) {
                            document.querySelector('#pre-quantity').innerText =
                                `(${data[0].quantity} remaining ${data[0].remaining_quantity})`;
                            document.querySelector('input[name="cost"]').value = data[0].cost;
                            document.querySelector('input[name="quantity"]').placeholder =
                                `Quantity you're adding or subtracting eg. 10 or -10`;
                        },
                        error: function(xhr) {}
                    });
                }
            });

            if (document.getElementById('deschiption')) {
                var quill = new Quill('#deschiption', {
                    theme: 'snow' // Specify theme in configuration
                });
                console.log(quill);
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
                    'item_input': {
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
                                },
                                method: 'GET',
                            },
                        }
                    },
                    'item_select': {
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
                            digits: {
                                message: "Value must contain only digits"
                            },
                        },
                    },
                    cost: {
                        validators: {
                            notEmpty: {
                                message: "Item cost is required"
                            },
                            customQuantityValidator: {
                                    message: "Value must contain only positive or nagative number"
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
                       
                    }))
            }));

        });
    </script>
    <script></script>
@endsection
