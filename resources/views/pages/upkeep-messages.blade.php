@extends('layouts.main')
@section('page-title', 'Complain #' . $complain->id)
@php
    
    $messages = [];
    
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
function date_compare($element1, $element2)
{
    $created_at1 = strtotime($element1['created_at']);
    $created_at2 = strtotime($element2['created_at']);
    return $created_at1 - $created_at2;
}

$tasks = DB::table('tasks')
    ->where('task_of', $complain->id)
    ->first();
if ($tasks) {
    $messages = DB::table('messages')
        ->where('user_id', Auth::id())
        ->where('tasks_id', $tasks->id)
        ->orderBy('created_at', 'asc')
        ->get();
}

$items = DB::table('purchased_items')
    ->where('task_id', $tasks->id ?? 'NOTHING')
    ->get();
$tolCost = DB::table('purchased_items')
    ->where('task_id', $tasks->id)
    ->sum('cost');
$tolLabour = DB::table('purchased_items')
    ->where('task_id', $tasks->id)
    ->sum('labour');

if ($complain->status == 'pending') {
    if ($tasks != null) {
        $currentstatus = 'ongoing';
        $currentstatusClass = 'primary';
    } else {
        $currentstatus = 'new';
        $currentstatusClass = 'primary';
    }
} elseif ($complain->status == 'completed' && $tasks->status == 'completed') {
    $currentstatus = 'completed';
    $currentstatusClass = 'success';
} else {
    $currentstatus = 'ongoing';
    $currentstatusClass = 'primary';
}

$complian_list = DB::table('complaints')
    ->where('user_id', Auth::id())
    ->whereNotNull('complain')
    ->orderBy('created_at', 'asc')
    ->get();

$message_list = DB::table('messages')
    ->where('user_id', Auth::id())
    ->whereNotNull('tasks_id')
    ->orderBy('created_at', 'asc')
        ->get();
    
@endphp
@section('content')

    <div class="row">
        <div class="col-sm-5">
            <div class="card mb-lg-0 blur-modified mb-5">

                <div class="card-body p-2">
                    <div class="p-3">
                        <h5 class="mb-3">Compliant</h5>
                        <div class="nav-wrapper z-index-2 mb-3">
                            <ul class="nav nav-pills nav-fill flex-row p-1" id="tabs-pricing" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-primary @if ($currentstatus == 'new') active @endif mb-0"
                                        data-target="new" id="tabs-iconpricing-tab-1" data-bs-toggle="tab"
                                        href="javascript:;" role="tab" aria-controls="new"
                                        @if ($currentstatus == 'new') aria-selected="true" @else  aria-selected="false" @endif>
                                        New
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-primary @if ($currentstatus == 'ongoing') active @endif mb-0"
                                        data-target="ongoing" id="tabs-iconpricing-tab-2" data-bs-toggle="tab"
                                        href="javascript:;" role="tab" aria-controls="ongoing"
                                        @if ($currentstatus == 'ongoing') aria-selected="true" @else  aria-selected="false" @endif>
                                        Ongoing
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-primary @if ($currentstatus == 'completed') active @endif mb-0"
                                        data-target="completed" id="tabs-iconpricing-tab-2" data-bs-toggle="tab"
                                        href="javascript:;" role="tab" aria-controls="completed"
                                        @if ($currentstatus == 'completed') aria-selected="true" @else  aria-selected="false" @endif>
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
                                    <tr class="{{ $complaint->id == $complain->id ? 'bg-gray-200' : '' }}">
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
        <div class="col-sm-7 mb-3">
            <div class="card blur-modified shadow-blur max-height-vh-70">
                <div class="card-header shadow-lg">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center">
                                <img alt="Image"
                                    src="{{ Auth::user()->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                                    class="avatar">
                                <div class="ms-3">
                                    <h6 class="d-block mb-0">Complain no #{{ $complain->id }}
                                        ({{ \App\Models\InventoryCategory::where('id', $complain->category_id)->first()->title }})
                                    </h6>
                                    <span class="text-dark opacity-8 text-sm"></span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="overflow-auto overflow-x-hidden" id="message-box">
                    <div class="card-body">


                        <div class="row justify-content-end mb-4 text-right">
                            <div class="col-auto">
                                <div class="card bg-gray-200">
                                    <div class="card-body px-3 py-2">
                                        <h4 class="font-weight-bolder mb-0 text-center">
                                            {{ $complain->description ?? '' }}
                                        </h4>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end mb-4 text-right">
                            <div class="col-auto">


                                <div class="card bg-gray-200">
                                    <div class="card-body px-3 py-2">

                                        <p class="mb-0">
                                            {{ $complain->complain ?? '' }}
                                        </p>
                                        @if (isset($complain->file))
                                        <hr class="bg-dark text-dark">
                                        @php
                                            $fileDetails = pathinfo($complain->file);
                                        @endphp
                                        
                                            @if (getimagesize($complain->file))
                                                <div class="col-12 p-0" title="{{ $fileDetails['basename'] }}">
                                                    <img src="{{ $complain->file ?? '' }}" width="50%"
                                                        alt="{{ $fileDetails['basename'] }}" class="img-fluid border-radius-lg mb-2">
                                                        {{-- <h6 class="mb-0">{{ $fileDetails['basename'] }}</h6> --}}
                                                </div>
                                            @else
                                                @php
                                                    // Get the file extension from the URL
                                                    $fileExt = pathinfo($complain->file, PATHINFO_EXTENSION);
                                                    
                                                    // Define an array with file extensions and their corresponding Font Awesome icons
                                                    $fileIcons = [
                                                        'pdf' => 'file-pdf',
                                                        'doc' => 'file-word',
                                                        'docx' => 'file-word',
                                                        'xls' => 'file-excel',
                                                        'xlsx' => 'file-excel',
                                                        'ppt' => 'file-powerpoint',
                                                        'pptx' => 'file-powerpoint',
                                                        'zip' => 'file-archive',
                                                        'rar' => 'file-archive',
                                                        // Add more extensions and icons as needed
                                                        // You can find the complete list of Font Awesome icons here: https://fontawesome.com/icons
                                                    ];
                                                    
                                                    // Default icon for unknown file types
                                                    $defaultIcon = 'file';

                                                    $fileName = isset($fileIcons[$fileExt]) ? $fileIcons[$fileExt] : $defaultIcon;
                                                @endphp
                                            
                                            <div class="d-flex p-2" title="{{ $fileDetails['basename'] }}">
                                                <div class="avatar shadow">
                                                    <i class="text-dark far fa-{{ $fileName }}" style="font-size: 50px;"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0">{{ $fileDetails['basename'] }}</h6>
                                                    <a target="_blank" href="{{ $complain->file ?? '' }}" class="text-muted mb-2 text-xs">View File</a>
    
                                                </div>
                                            </div>
                                            @endif
                                        @endif
                                        

                                        <div class="d-flex align-items-center justify-content-end opacity-6 text-sm">
                                            <i class="ni ni-check-bold me-1 text-sm"></i>
                                            <small>{{ \Carbon\Carbon::parse($complain->created_at)->format('j M h:i A') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-start mb-4">
                            <div class="col-auto">
                                <span class="font-weight-bold text-primary ml-5">Talentapartments</span>
                                <div class="card">
                                    <div class="card-body px-3 py-2">
                                        <p class="mb-1">
                                            Your complian has been sent! an admin will attend to you shortly.
                                            please wait while your complain is been assign to our customer service
                                        </p>
                                        <div class="d-flex align-items-center opacity-6 text-sm">
                                            <i class="ni ni-check-bold me-1 text-sm"></i>
                                            <small>{{ \Carbon\Carbon::parse($complain->created_at)->addSeconds(10)->format('j M h:i A') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($tasks)
                            @php
                                $attendant = \App\Models\User::find($tasks->attendant);
                            @endphp
                            <div class="row justify-content-start mb-4">
                                <div class="col-auto">
                                    <span class="font-weight-bold text-primary ml-5">Talentapartments</span>
                                    <div class="card">
                                        <div class="card-body px-3 py-2">
                                            <p class="mb-1">
                                                Your complian has been assigned to {{ $attendant->first_name }}
                                                {{ $attendant->last_name }}
                                            </p>
                                            <div class="d-flex align-items-center opacity-6 text-sm">
                                                <i class="ni ni-check-bold me-1 text-sm"></i>
                                                <small>{{ \Carbon\Carbon::parse($tasks->created_at)->format('j M h:i A') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @foreach ($messages as $message)
                            @if ($message->status == 'sent')
                                <div class="row justify-content-start mb-4">
                                    <div class="col-auto">
                                        <span class="font-weight-bold text-primary ml-5">
                                            {{ DB::table('users')->where('id',DB::table('tasks')->where('user_id', Auth::id())->value('attendant'))->value('first_name') }}
                                            {{ DB::table('users')->where('id',DB::table('tasks')->where('user_id', Auth::id())->value('attendant'))->value('last_name') }}
                                        </span>
                                        <div class="card">
                                            <div class="card-body px-3 py-2">
                                                <p class="mb-1">
                                                    {!! $message->message ?? '' !!}
                                                </p>
                                                <div class="d-flex align-items-center opacity-6 text-sm">
                                                    <i class="ni ni-check-bold me-1 text-sm"></i>
                                                    <small>{{ \Carbon\Carbon::parse($message->created_at)->format('j M h:i A') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row justify-content-end mb-4 text-right">
                                    <div class="col-auto">


                                        <div class="card bg-gray-200">
                                            <div class="card-body px-3 py-2">
                                                <p class="mb-0">
                                                    {!! $message->message ?? '' !!}
                                                </p>
                                                <div
                                                    class="d-flex align-items-center justify-content-end opacity-6 text-sm">
                                                    <i class="ni ni-check-bold me-1 text-sm"></i>
                                                    <small>{{ \Carbon\Carbon::parse($message->created_at)->format('j M h:i A') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach


                        @if (isset($message->tasks_id) &&
                                DB::table('tasks')->where('id', $message->tasks_id)->value('status') == 'completed' &&
                                $complain->status != 'completed')
                            <div class="row justify-content-start mb-4">
                                <div class="col-auto">
                                    <span class="font-weight-bold text-primary ml-5">Talentapartments</span>
                                    <div class="card">
                                        <div class="card-body px-3 py-2">
                                            <p class="font-weight-bold mb-1">
                                                Admin ended the conversation!
                                            </p>
                                            @if ($items->count() >= 1 && $tolCost + $tolLabour > 0)
                                                <div class="my-2">

                                                    <p class="font-weight-bold mb-1 text-xs">Cost of Items</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                        ₦{{ $tolCost + $tolLabour }}
                                                        @if ($tolLabour > 0)
                                                            <span
                                                                class="text-success font-weight-bolder mb-0 mt-auto text-end text-xs">+
                                                                <span
                                                                    class="font-weight-normal text-secondary">Labour</span></span>
                                                        @endif
                                                    </h5>


                                                </div>
                                            @endif
                                            <p>
                                                @if ($complain->satisfactory == 'not satisfied')
                                                    Is the complain resolved?
                                                @else
                                                    Please confirm satisfaction
                                                @endif
                                            </p>
                                            <div class="my-3">
                                                <a href="/upkeep/complain/{{ $complain->id }}/satisfactory/completed"
                                                    class="btn btn-sm bg-gradient-primary mb-0 me-3">
                                                    Job done satisfactory

                                                </a>
                                                <a href="javascript:;" id="not-satisfied-button"
                                                    class="btn btn-sm bg-gradient-dark mb-0">
                                                    @if ($complain->satisfactory == 'not satisfied')
                                                        Complain still not resolved?
                                                    @else
                                                        Complain not resolved
                                                    @endif
                                                </a>
                                            </div>
                                            <div id="not-satisfied-field" data-show="false" class="d-none mb-3">
                                                <form action="/upkeep/complain/{{ $complain->id }}/satisfactory/message"
                                                    method="post" id="not-satisfied-form">
                                                    @csrf
                                                    <span class="small">
                                                        Tell us why you were not satisfied
                                                    </span>
                                                    <div class="fv-row">

                                                        <input type="text" class="form-control"
                                                            placeholder="Tell us why you were not satisfied"
                                                            aria-label="Tell us why you were not satisfied"
                                                            onfocus="focused(this)" onfocusout="defocused(this)"
                                                            name="not_satisfied_message" />
                                                    </div>
                                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                    <input type="hidden" name="tasks_id"
                                                        value="{{ $tasks->id ?? null }}">
                                                    <button id="not-satisfied-submit-button"
                                                        class="btn btn-sm bg-gradient-primary me-3 mt-3">Submit</button>
                                                </form>
                                            </div>
                                            <div class="d-flex align-items-center opacity-6 text-sm">
                                                <i class="ni ni-check-bold me-1 text-sm"></i>
                                                <small>{{ \Carbon\Carbon::parse(DB::table('tasks')->where('id', $message->tasks_id)->value('updated_at'))->format('j M h:i A') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif
                        @if ($currentstatus == 'completed')
                            <div class="row justify-content-start mb-4">
                                <div class="col-auto">
                                    <span class="font-weight-bold text-primary ml-5">Talentapartments</span>
                                    <div class="card">
                                        <div class="card-body px-3 py-2">
                                            <p class="fontf-weight-bold mb-1">
                                                This complaint has been resolved
                                            </p>
                                            @if ($items->count() >= 1 && $tolCost + $tolLabour > 0)
                                                <div class="my-2">

                                                    <p class="font-weight-bold mb-1 text-xs">Cost of Items</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                        ₦{{ $tolCost + $tolLabour }}
                                                        @if ($tolLabour > 0)
                                                            <span
                                                                class="text-success font-weight-bolder mb-0 mt-auto text-end text-xs">+
                                                                <span
                                                                    class="font-weight-normal text-secondary">Labour</span></span>
                                                        @endif
                                                    </h5>


                                                </div>
                                            @endif

                                            <div class="d-flex align-items-center opacity-6 text-sm">
                                                <i class="ni ni-check-bold me-1 text-sm"></i>
                                                <small>{{ \Carbon\Carbon::parse($tasks->created_at)->format('j M h:i A') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>

                <div class="card-footer d-block">
                    <form method="POST" action="/send_message" enctype="multipart/form-data">@csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="tasks_id" value="{{ $tasks->id ?? null }}">
                        <div class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    @if (isset($tasks->id)) placeholder="Type here" 
                                @else
                                placeholder="please wait while your complain is been assign to our customer service" @endif
                                    aria-label="Message example input" onfocus="focused(this)"
                                    onfocusout="defocused(this)" name="message"
                                    @if (!isset($tasks->id)) disabled @endif>
                            </div>
                            <button class="btn bg-gradient-primary mb-0 ms-2"
                                @if (!isset($tasks->id)) disabled @endif>
                                <i class="ni ni-send"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">



        </div>
    @endsection
    @section('styles')
        <link rel="stylesheet" type="text/css" media="all"
            href="{{ asset('assets/js/plugins/formvalidation/dist/css/formValidation.min.css') }}" />
        <style>
            .blur-modified {
                box-shadow: inset 0px 0px 2px #fefefed1;
                -webkit-backdrop-filter: saturate(200%) blur(30px);
                backdrop-filter: saturate(200%) blur(30px);
            }
        </style>
    @endsection
    @section('script')
        <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/FormValidation.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Excluded.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/formvalidation/dist/js/plugins/Bootstrap3.min.js') }}"></script>
        <script>
            // function replyTo(id, email){
            //         alert("You entered p1!"+id+email);
            //     }
            $(document).ready(function() {


                const messages = document.getElementById('message-box');

                function scrollToBottom() {
                    messages.scrollTop = messages.scrollHeight;
                }
                scrollToBottom();
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
                    "pageLength": 2,
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


                $('.list-group #replyUser').click(function() {
                    id = $(this).data('id');
                    email = $(this).data('email');
                    $("#GetIt option").attr('selected', false);
                    $("#GetIt option[value=" + id + "]").attr('selected', true);
                    $("#startTyping textarea").focus();
                    $("#startTyping textarea").attr('placeholder', 'Start a message to ' + email);

                });
                var notSatisfiedButton = document.querySelector('#not-satisfied-button');
                if (notSatisfiedButton) {
                    notSatisfiedButton.addEventListener("click", function() {
                        var attr = document.querySelector('#not-satisfied-field').getAttribute('data-show');
                        document.querySelector('#not-satisfied-field').classList.remove('d-none');
                        scrollToBottom();

                    });
                    const form = document.querySelector("#not-satisfied-form");
                    const button = document.querySelector("#not-satisfied-submit-button");

                    const fv = FormValidation.formValidation(form, {
                        fields: {
                            'not_satisfied_message': {
                                validators: {
                                    notEmpty: {
                                        message: "field is required"
                                    },
                                }
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
                                        text: "Please tell use what the problem is.",
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

                }




                filterByStatus('{{ $currentstatus }}');

            });
        </script>
    @endsection
