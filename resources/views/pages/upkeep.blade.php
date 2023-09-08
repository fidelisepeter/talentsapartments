@extends('layouts.main')
@section('page-title', 'Complaints')
@section('content')

@section('content')
    @php
        function truncateTextToSentences($text, $maxSentences)
        {
            $maxCharacters = 150; // Adjust this value based on the font size and container width
        
            if (mb_strlen($text) <= $maxCharacters) {
                return $text;
            } else {
                $truncatedText = mb_substr($text, 0, $maxCharacters);
                // Make sure the truncated text doesn't cut a word in the middle
        $truncatedText = mb_substr($truncatedText, 0, mb_strrpos($truncatedText, ' '));
        return $truncatedText . '...';
            }
        }
    @endphp
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card mb-lg-0 mb-5 blur">

                <div class="card-body p-2">
                    <div class="p-3">
                        <h5 class="mb-3">Compliant</h5>
                        <div class="nav-wrapper z-index-2 mb-3">
                            <ul class="nav nav-pills nav-fill flex-row p-1" id="tabs-pricing" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-primary mb-0" data-target="new" id="tabs-iconpricing-tab-1"
                                        data-bs-toggle="tab" href="javascript:;"  aria-selected="false" role="tab" aria-controls="monthly">
                                        New
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-primary active mb-0" data-target="ongoing"
                                        id="tabs-iconpricing-tab-2" data-bs-toggle="tab" href="javascript:;" role="tab"
                                        aria-controls="ongoing"
                                        aria-selected="true">
                                        Ongoing
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-primary mb-0" data-target="completed"
                                        id="tabs-iconpricing-tab-2" data-bs-toggle="tab" href="javascript:;" role="tab"
                                        aria-controls="completed" aria-selected="false" >
                                        Completed
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <table class="table" id="datatable-search">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 40px;"></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (DB::table('complaints')->where('user_id', Auth::id())->whereNotNull('complain')->orderBy('created_at', 'asc')->get() as $complaint)
                                    @php
                                        // print_r();
                                        $subText = truncateTextToSentences($complaint->description . ': ' . $complaint->complain, 3);
                                        
                                        if ($complaint->status == 'pending') {
                                            if (
                                                DB::table('tasks')
                                                    ->where('task_of', $complaint->id)
                                                    ->first() != null
                                            ) {
                                                $status = 'ongoing';
                                                $statusClass = 'primary';
                                            } else {
                                                $status = 'new';
                                                $statusClass = 'primary';
                                            }
                                        } elseif (
                                            $complaint->status == 'completed' &&
                                            DB::table('tasks')
                                                ->where('task_of', $complaint->id)
                                                ->first()->status == 'completed'
                                        ) {
                                            $status = 'completed';
                                            $statusClass = 'success';
                                        } else {
                                            $status = 'ongoing';
                                            $statusClass = 'primary';
                                        }
                                        
                                    @endphp
                                    <tr class="">
                                        <td data-status="{{ $status }}">
                                            <div class="flex-shrink-0">

                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-{{ $statusClass }} d-flex align-items-center justify-content-center mb-0 me-3">
                                                    @if ($status == 'new')
                                                        <i class="fas fa-certificate"></i>
                                                    @elseif($status == 'ongoing')
                                                        <i class="fas fa-certificate"></i>
                                                    @elseif($status == 'completed')
                                                        <i class="fas fa-certificate"></i>
                                                    @else
                                                    @endif
                                                </button>
                                            </div>
                                        </td>
                                        <td class="">
                                            <div class="">
                                                <a href="/upkeep/complain/{{ $complaint->id }}"
                                                    class="h5 text-{{ $statusClass }} mt-0">#{{ $complaint->id }}
                                                    ({{ \App\Models\InventoryCategory::where('id', $complaint->category_id)->first()->title }})
                                                </a>
                                                <p class="text-sm" style="text-wrap: wrap;">{{ $subText }}
                                                </p>
                                                <div class="d-flex">
                                                    <div>
                                                        @if ($status == 'new')
                                                            <i
                                                                class="far fa-newspaper text-{{ $statusClass }} me-1 cursor-pointer"></i>
                                                        @elseif($status == 'ongoing')
                                                            <i
                                                                class="fas fa-spinner text-{{ $statusClass }} me-1 cursor-pointer"></i>
                                                        @elseif($status == 'completed')
                                                            <i
                                                                class="fas fa-check text-{{ $statusClass }} me-1 cursor-pointer"></i>
                                                        @else
                                                        @endif
                                                    </div>
                                                    <span
                                                        class="text-{{ $statusClass }} me-2 text-sm">{{ $status }}</span>
                                                    <div>
                                                        <i class="far fa-calendar me-1 cursor-pointer"></i>
                                                    </div>
                                                    <span
                                                        class="me-2 text-sm">{{ \Carbon\Carbon::parse($complaint->created_at)->format('j M h:i A') }}</span>
                                                </div>
                                            </div>
                                        </td>


                                    </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header p-3 pb-0">
                    <h6 class="mb-0">New Complaints</h6>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="/new-complaint" enctype="multipart/form-data" id="complain-form">@csrf

                        <ul class="list-group">
                            <li class="list-group-item border-0 px-0">
                                <div class="text-sm">Category</div>
                                <div class="form-check form-switch fv-row ps-0">
                                    <select name="category" class="form-control">
                                        @foreach (\App\Models\InventoryCategory::all() as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="mb-1 mt-2 text-sm">Description</div>
                                <div class="form-check form-switch fv-row ps-0">
                                    <input class="form-control" required name="description" id=""
                                        placeholder="Description" />
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="mb-1 mt-2 text-sm">Complian Details</div>
                                <div class="form-check form-switch fv-row ps-0">
                                    <textarea class="form-control" required name="complain" id="" cols="30" rows="10"></textarea>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="mb-1 mt-2 text-sm">Attached File</div>
                                <div class="form-check form-switch fv-row ps-0">
                                    <input type="file" class="form-control" required name="file" id=""
                                        placeholder="File" />
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="mb-1 mt-2 text-sm">Have you complained on this matter before?</div>
                                <div class="form-check form-switch fv-row ps-0">
                                    <input name="complained_before" value="yes" class="form-check-input ms-auto"
                                        type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label text-body text-truncate mb-0 ms-3 w-80"
                                        for="flexSwitchCheckDefault">No/Yes</label>
                                </div>
                            </li>
                            <li class="list-group-item d-none border-0 px-0" id="date-row">
                                <div class="mb-1 mt-2 text-sm">Complain Date</div>
                                <div class="form-check form-switch fv-row ps-0">
                                    <input type="date" name="last_date" class="form-control mb-2" id=""
                                        placeholder="Date" />
                                </div>
                            </li>

                            </li>
                            <input class="btn btn-info" type="submit" value=" submit a complaint"
                                id="complain-form-submit" />

                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/js/plugins/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
    <style>
        #datatable-search_filter {
            /* display: none; */
        }
    </style>
@endsection
@section('script')
    <script src="{{ asset('assets/js/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/FormValidation.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Excluded.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Bootstrap3.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            const t = $('#datatable-search').DataTable({
                'dom': 'lrtip',
                "paging": true,
                // "pagingType": "full_numbers",
                "language": {
                    "paginate": {
                        "previous": "‹",
                        "first": "«",
                        "next": "›",
                        "last": "»",
                    }
                },
                "pageLength": 3,
                "retrieve": true,
                "lengthChange": false,
                // "searching": false,
                // "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": false,
                "info": false,
            })


            // Function to filter table based on status
            var filterByStatus = (status) => {

                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    var rowStatus = t.cell(dataIndex, 0).nodes().to$().attr('data-status');
                    return status === rowStatus;
                });
                t.draw();
                $.fn.dataTable.ext.search.pop()
            };

            document.querySelectorAll('[data-target]').forEach((e => {
                e.addEventListener("click", (a => {
                    const targetStatus = a.target.getAttribute('data-target');
                    filterByStatus(targetStatus);

                }))
            }));


            c = document.querySelector('input[name="complained_before"]');
            c.addEventListener("change", function() {
                if (c.checked) {
                    document.querySelector('#date-row').classList.remove('d-none');
                } else {
                    document.querySelector('#date-row').classList.add('d-none');
                }
            });





            const form = document.querySelector("#complain-form");
            const button = document.querySelector("#complain-form-submit");

            const fv = FormValidation.formValidation(form, {
                fields: {
                    'category_id': {
                        validators: {
                            notEmpty: {
                                message: "Category is required"
                            },
                        }
                    },
                    'description': {
                        validators: {
                            notEmpty: {
                                message: "Description is required"
                            },
                        }
                    },
                    'complain': {
                        validators: {
                            notEmpty: {
                                message: "Please add complain here"
                            },
                        },
                    },

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
            filterByStatus('ongoing');

        });
    </script>
@endsection
