@extends('layouts.main')
@section('page-title', 'Complians')
@if (Auth::user()->hasRole(DB::table('settings')->value('complaints_management_role') ?? '-') ||
        Auth::user()->can('view-task') ||
        DB::table('tasks')->where('task_of', $complaint->id)->value('attendant') == Auth::id())
    {{-- Stay --}}
@else
    {{ Session::flash('error', 'You are not permited to view that page') }}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@section('content')
@php
    $task = DB::table('tasks')->where('task_of', $complaint->id)->first();
    $items = DB::table('purchased_items')->where('task_id', $task->id ?? 'NOTHING')->get();
    $tolSum = DB::table('purchased_items')->where('task_id', $task->id)->sum('cost')+DB::table('purchased_items')->where('task_id', $task->id)->sum('labour');
    
    if ($complaint->status == 'pending'){
            if ($task != null ){
                $currentstatus = 'ongoing';
                $currentstatusClass = 'primary';
            }else{
                $currentstatus = 'new';
                $currentstatusClass = 'primary';
            }
        }elseif ($complaint->status == 'completed' &&  $task->status == 'completed') {
            $currentstatus = 'completed';
            $currentstatusClass = 'success';
        }else {
            $currentstatus = 'ongoing';
            $currentstatusClass = 'primary';
        }
@endphp
    <div class="row">

        <div class="col-12 col-xl-4 mb-3">
            <div class="card mb-sm-3">
                <div class="card-header p-3 pb-0">
                    <h6 class="mb-0">Student Details</h6><br>
                </div>
                <div class="card-body">

                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                Name:</strong>
                            {{ DB::table('users')->where('id', $complaint->user_id)->value('first_name') }}
                            {{ DB::table('users')->where('id', $complaint->user_id)->value('middle_name') }}
                            {{ DB::table('users')->where('id', $complaint->user_id)->value('last_name') }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong>
                            {{ DB::table('users')->where('id', $complaint->user_id)->value('phone_number') }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                            {{ DB::table('users')->where('id', $complaint->user_id)->value('email') }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong>
                            &nbsp; State: {{ DB::table('users')->where('id', $complaint->user_id)->value('state') }} | City:
                            {{ DB::table('users')->where('id', $complaint->user_id)->value('city') }} |
                            Street:{{ DB::table('users')->where('id', $complaint->user_id)->value('street') }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">School:</strong>
                            {{ DB::table('users')->where('id', $complaint->user_id)->value('school') }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Department:</strong>
                            {{ DB::table('users')->where('id', $complaint->user_id)->value('department') }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Course:</strong>
                            {{ DB::table('users')->where('id', $complaint->user_id)->value('course') }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Level:</strong>
                            {{ DB::table('users')->where('id', $complaint->user_id)->value('level') }}</li>

                    </ul>
                </div>
            </div>
            {{-- @dd(DB::table('settings')->value('complaints_management_role')) --}}
            @if (Auth::user()->role == 'super_admin' ||
                    Auth::user()->hasRole(DB::table('settings')->value('complaints_management_role') ?? '-') ||
                    Auth::user()->can('assign-task'))
                <div class="card">
                    <div class="card-header p-3 pb-0">
                        <h6 class="mb-0">Assign Task</h6>
                        <small>Select an administrator to assign task to</small>
                        <br>
                    </div>



                    <div class="card-body p-3">
                        {{-- @dd(DB::table('users')->where('role', ['super_admin', 'complaints_manager', 'admin', 'staff'])->get()) --}}
                        @if (App\Models\User::where('role', '!=', 'student')->get()->count() > 0)
                            <form method="POST" action="/assign" enctype="multipart/form-data">@csrf

                                <ul class="list-group">
                                    @foreach (App\Models\User::where('role', '!=', 'student')->get() as $user)
                                        @if ($user->can('view-complaints'))
                                            <li class="list-group-item border-0 px-0">
                                                <div class="form-check form-switch ps-0">
                                                    <input type="hidden" name="user_id" value="{{ $complaint->user_id }}">
                                                    <input type="hidden" name="task_of" value="{{ $complaint->id }}">
                                                    <input class="form-check-input ms-auto" type="radio"
                                                        onChange="this.form.submit()" name="attendant"
                                                        id="flexSwitchCheckDefault" value="{{ $user->id }}"
                                                        @if (DB::table('tasks')->where('task_of', $complaint->id)->value('attendant') == $user->id) checked="" @endif>
                                                    <label class="form-check-label text-body text-truncate mb-0 ms-3 w-80"
                                                        for="flexSwitchCheckDefault">{{ $user->first_name }}
                                                        {{ $user->middle_name }} {{ $user->last_name }} </label>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </form>
                        @else
                            <h6 class="text-danger text-center">You don't have any complaints manager or staff with
                                permission to compliants</h6>
                            <p>Please add permission to <code>View Compliants</code> to staff or Staff Role</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="col-12 col-xl-8 mb-3">
            @if ((
                Auth::user()->role == 'super_admin' || 
                Auth::user()->hasRole(DB::table('settings')->value('complaints_management_role') ?? '-') ||
                Auth::user()->can('can-assign-task')
                ) && $task == null)
                <div class="alert alert-info" style="color:white">
                    This Complaint has not been assigned to an attendant
                </div>
            @endif
            <div class="card shadow-blur max-height-vh-70 blur">
                <div class="card-header shadow-lg">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="d-flex align-items-center">
                                <img alt="Image"
                                    src="{{ DB::table('users')->where('id', $complaint->user_id)->value('photo') ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                                    class="avatar">
                                <div class="ms-3">
                                    <h6 class="d-block mb-0">Messages</h6>
                                    <span class="text-dark opacity-8 text-sm">
                                        @if (DB::table('tasks')->where('task_of', $complaint->id)->value('status') == 'completed')
                                            <span class="text-success"> Already Completed</span>
                                        @else
                                            <span class="text-warning"> Pending</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex">
                                <span>
                                    Mark as completed task
                                </span>
                                <form action="/task_completed" method="POST">@csrf
                                    <div class="form-check form-switch ps-0">
                                        <input name="status" onChange="this.form.submit()" value="completed"
                                            class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault"
                                            @if (DB::table('tasks')->where('task_of', $complaint->id)->value('status') == 'completed') checked="" disabled @endif>
                                        <input type="hidden" name="task_id"
                                            value="{{ DB::table('tasks')->where('task_of', $complaint->id)->value('id') }}">

                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="overflow-auto overflow-x-hidden" id="message-box">

                    <div class="card-body">
                        <div class="row justify-content-start mb-4">
                            <div class="col-auto">
                                <div class="card">
                                    <div class="card-body px-3 py-2">
                                        <h4 class="font-weight-bolder mb-0 text-center">
                                            {{ $complaint->description ?? '' }}
                                        </h4>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-start mb-4">
                            <div class="col-auto">
                                <div class="card">
                                    <div class="card-body px-3 py-2">
                                        <p class="mb-1">
                                            {{ $complaint->complain }}
                                        </p>
                                        <div class="d-flex align-items-center opacity-6 text-sm">
                                            <i class="ni ni-check-bold me-1 text-sm"></i>
                                            <small>{{ \Carbon\Carbon::parse($complaint->created_at)->format('j M h:i A') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach (DB::table('messages')->where(
                'tasks_id',
                DB::table('tasks')->where('task_of', $complaint->id)->value('id'),
            )->whereNotNull('tasks_id')->get() as $messages)
                            @if ($messages->status == 'sent')
                                <div class="row justify-content-end mb-4 text-right">
                                    <div class="col-auto">
                                        <span>
                                            {{ DB::table('users')->where('id',DB::table('tasks')->where('task_of', $complaint->id)->value('attendant'))->value('first_name') }}
                                            {{ DB::table('users')->where('id',DB::table('tasks')->where('task_of', $complaint->id)->value('attendant'))->value('last_name') }}</span>

                                        <div class="card bg-gray-200">
                                            <div class="card-body px-3 py-2">
                                                <p class="mb-0">
                                                    {{ $messages->message }}
                                                </p>
                                                <div
                                                    class="d-flex align-items-center justify-content-end opacity-6 text-sm">
                                                    <i class="ni ni-check-bold me-1 text-sm"></i>
                                                    <small>{{ \Carbon\Carbon::parse($messages->created_at)->format('j M h:i A') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row justify-content-start mb-4">
                                    <div class="col-auto">
                                        <div class="card">
                                            <div class="card-body px-3 py-2">
                                                <p class="mb-1">
                                                    {{ $messages->message }}
                                                </p>
                                                <div class="d-flex align-items-center opacity-6 text-sm">
                                                    <i class="ni ni-check-bold me-1 text-sm"></i>
                                                    <small>{{ \Carbon\Carbon::parse($messages->created_at)->format('j M h:i A') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="card-footer d-block">
                    <form method="POST" action="/message" enctype="multipart/form-data">@csrf
                        <input type="hidden" name="user_id"
                            value="{{ DB::table('users')->where('id', $complaint->user_id)->value('id') }}">
                        <input type="hidden" name="tasks_id"
                            value="{{ DB::table('tasks')->where('task_of', $complaint->id)->value('id') }}">

                        <div class="d-flex">
                            <div class="w-100 d-flex">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Type here"
                                        aria-label="Message example input" required name="message"
                                        @if (!isset($task->id)) checked="" disabled @endif>
                                </div>
                                <button class="btn bg-gradient-primary mb-0 ms-2"
                                    @if (!isset($task->id)) checked="" disabled @endif>
                                    <i class="ni ni-send"></i>
                                </button>
                            </div>
                            <div class="">
                                <button id="add-items" type="button"
                                    class="btn btn-block bg-gradient-dark w-100 mb-0 ms-2 @if ($items->count() >= 1) d-none @endif" style="text-wrap: nowrap;"
                                    @if (!isset($task->id) || $currentstatus == 'completed') disabled @endif>
                                    <i class="fas fa-plus me-3"></i>Add what is needed
                                </button>
                                @if ($currentstatus == 'completed')
                                    <button id="remove-items" type="button"
                                        class="@if ($items->count() == 0) d-none @endif btn btn-block bg-gradient-dark w-100 mb-0 ms-2"  style="text-wrap: nowrap;"
                                        @if (!isset($task->id) || $currentstatus == 'completed') disabled @endif>
                                        <i class="fas fa-trash me-3"></i>Remove all Items
                                    </button>
                                @else
                                <a id="remove-items" href="/complaint/{{ $complaint->id }}/remove-all-items"
                                    class="@if ($items->count() == 0) d-none @endif btn btn-block bg-gradient-dark w-100 mb-0 ms-2" style="text-wrap: nowrap;"
                                    @if (!isset($task->id) || $currentstatus == 'completed') disabled @endif>
                                    <i class="fas fa-trash me-3"></i>Remove all Items
                            </a>
                                @endif
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-5 @if ($items->count() == 0) d-none @endif" id="items-field">
                <div class="card-header p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">Items Needed</h6>
                        </div>
                        <div class="col-md-6 h4 font-weight-bolder d-flex justify-content-end align-items-center">
                            <small>₦</small><small id="sum-field">0</small>

                        </div>
                    </div>
                    <hr class="horizontal dark mb-0">
                </div>
                <form action="/complaint/{{ $complaint->id }}/update-items" method="POST">
                    @csrf
                <div id="items"  class="card-body p-3 pt-0">
                    <ul data-repeater-list="items" class="list-group list-group-flush" data-toggle="checklist">
                        @forelse ($items as $item)
                        <li data-repeater-item="" class="list-group-item flex-column align-items-start mb-3 border-0 py-0 ps-0">
                            <div class="checklist-item @if ($currentstatus == 'completed') checklist-item-secondary @else checklist-item-primary @endif ms-3 ps-2">
                                <div id="item-viewer">
                                    <div class="d-flex align-items-center">

                                        <h6 class="text-dark font-weight-bold mb-0 text-sm" id="description-value">{{ $item->description }}</h6>

                                    </div>
                                    <div class="d-flex align-items-center ms-4 mt-3 ps-1">
                                        <div>
                                            <p class="text-secondary font-weight-bold mb-0 text-xs">Department</p>
                                            <span class="font-weight-bolder text-xs"> <span id="department-value">{{ DB::table('inventory_categories')->where('id', DB::table('inventories')->where('id', $item->inventory_id)->first()->category_id)->first()->title }}</span></span>

                                        </div>
                                        <div class="ms-auto">
                                            <p class="text-secondary font-weight-bold mb-0 text-xs">item needed</p>
                                            <span class="font-weight-bolder text-xs"> <span id="item-value">{{ DB::table('inventories')->where('id', $item->inventory_id)->first()->item }}</span></span>
                                        </div>
                                        <div class="mx-auto">
                                            <p class="text-secondary font-weight-bold mb-0 text-xs">cost of Materials</p>
                                            <span class="font-weight-bolder text-xs"> ₦<span id="cost-value">{{ $item->cost }}</span></span>
                                        </div>
                                        <div class="mx-auto">
                                            <p class="text-secondary font-weight-bold mb-0 text-xs">Labour</p>
                                            <span class="font-weight-bolder text-xs"> ₦<span id="labour-value">{{ $item->labour }}</span></span>
                                        </div>
                                        <div class="mx-auto">

                                            @if ($currentstatus == 'completed')
                                            <span class="me-3"><i class="fas fa-edit text-secondary"></i></span>
                                            <span class="me-3"><i class="fas fa-trash text-secondary"></i></span>
                                            @else
                                            <a href="javascript:;" id="edit-item" class="me-3">
                                                <i class="fas fa-edit text-secondary"></i>
                                            </a>

                                            <a href="javascript:;" data-bs-toggle="tooltip" class="d-none"
                                                data-bs-original-title="Delete Item"
                                                data-inventory-table-filter="delete_row" data-original-title="" data-repeater-delete=""
                                                title="">
                                                <i class="fas fa-trash text-secondary"></i>
                                            </a>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                                <div id="item-editor" class="d-none">
                                   
                                    <div class="w-100 d-flex">
                                        <div class="me-2 text-dark font-weight-bold text-sm">
                                            Description:
                                        </div>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm w-100" placeholder="Type here" name="description"
                                                aria-label="Message example input" required id="description-input" value="{{ $item->description }}">
                                        </div>


                                    </div>
                                    <div class="d-flex align-items-center mt-3 ps-1">

                                        <div class="me-2">
                                            <div class="form-group">
                                                <label class="form-label text-secondary">Dept</label>
                                                <select class="form-control form-control-sm"
                                                    name="department" required id="department-input">
                                                    @foreach (\App\Models\InventoryCategory::all() as $category)
                                                        <option value="{{ $category->id }}" @if (DB::table('inventory_categories')->where('id', DB::table('inventories')->where('id', $item->inventory_id)->first()->category_id)->first()->id == $category->id) selected @endif>{{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group ms-auto me-2">
                                            <label class="form-label text-secondary">item</label>
                                            <select class="form-control form-control-sm" name="item"
                                                required id="item-input">
                                                @foreach (\App\Models\Inventory::where('category_id', DB::table('inventory_categories')->where('id', DB::table('inventories')->where('id', $item->inventory_id)->first()->category_id)->first()->id)->get()->unique('item') as $data)
                                        <option value="{{ $data->id }}" @if ($data->id == $item->inventory_id) selected @endif>{{ $data->item }}</option>
                                    @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group ms-auto me-2">
                                            <label class="form-label text-secondary">Quantity</label>
                                            <input type="hidden" name="cost" id="cost-input" value="{{ $item->cost }}">
                                            <input type="number"
                                                class="form-control form-control-sm" name="quantity" required id="quantity-input" value="{{ $item->quantity }}">
                                        </div>

                                        <div class="form-group ms-auto me-2">
                                            <label class="form-label text-secondary">Labour</label>
                                            <input  type="number"
                                                class="form-control form-control-sm" name="labour" required id="labour-input" value="{{ $item->labour }}">
                                        </div>
                                        <div class="form-group mx-auto me-2" style="margin-top: 30px;">
                                            <div class="d-flex align-item-center">
                                                <button class="btn bg-gradient-dark btn-sm mb-0" @if ($currentstatus == 'completed') disabled @endif
                                                    type="button" id="save-item">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark mb-0 mt-4">
                        </li>
                      
                        @empty
                        <li data-repeater-item="" class="list-group-item flex-column align-items-start mb-3 border-0 py-0 ps-0">
                            <div class="checklist-item checklist-item-primary ms-3 ps-2">
                                <div id="item-viewer">
                                    <div class="d-flex align-items-center">

                                        <h6 class="text-dark font-weight-bold mb-0 text-sm" id="description-value"><span class="text-muted">Description</span></h6>

                                    </div>
                                    <div class="d-flex align-items-center ms-4 mt-3 ps-1">
                                        <div>
                                            <p class="text-secondary font-weight-bold mb-0 text-xs">Department</p>
                                            <span class="font-weight-bolder text-xs"> <span id="department-value">-</span></span>

                                        </div>
                                        <div class="ms-auto">
                                            <p class="text-secondary font-weight-bold mb-0 text-xs">item needed</p>
                                            <span class="font-weight-bolder text-xs"> <span id="item-value">-</span></span>
                                        </div>
                                        <div class="mx-auto">
                                            <p class="text-secondary font-weight-bold mb-0 text-xs">cost of Materials</p>
                                            <span class="font-weight-bolder text-xs"> ₦<span id="cost-value">-</span></span>
                                        </div>
                                        <div class="mx-auto">
                                            <p class="text-secondary font-weight-bold mb-0 text-xs">Labour</p>
                                            <span class="font-weight-bolder text-xs"> ₦<span id="labour-value">-</span></span>
                                        </div>
                                        <div class="mx-auto">

                                            <a href="javascript:;" id="edit-item" class="me-3">
                                                <i class="fas fa-edit text-secondary"></i>
                                            </a>

                                            <a href="javascript:;" data-bs-toggle="tooltip" class="d-none"
                                                data-bs-original-title="Delete Item"
                                                data-inventory-table-filter="delete_row" data-original-title="" data-repeater-delete=""
                                                title="">
                                                <i class="fas fa-trash text-secondary"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="item-editor" class="d-none">
                                   
                                    <div class="w-100 d-flex">
                                        <div class="me-2 text-dark font-weight-bold text-sm">
                                            Description:
                                        </div>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm w-100" placeholder="Type here" name="description"
                                                aria-label="Message example input" required id="description-input">
                                        </div>


                                    </div>
                                    <div class="d-flex align-items-center mt-3 ps-1">

                                        <div class="me-2">
                                            <div class="form-group">
                                                <label class="form-label text-secondary">Dept</label>
                                                <select class="form-control form-control-sm"
                                                    name="department" required id="department-input">
                                                    @foreach (\App\Models\InventoryCategory::all() as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group ms-auto me-2">
                                            <label class="form-label text-secondary">item</label>
                                            <select class="form-control form-control-sm" name="item"
                                                required id="item-input">
                                                @foreach (\App\Models\Inventory::where('category_id', App\Models\InventoryCategory::first()->id)->get()->unique('item') as $data)
                                        <option value="{{ $data->id }}">{{ $data->item }}</option>
                                    @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group ms-auto me-2">
                                            <label class="form-label text-secondary">Quantity</label>
                                            <input type="hidden" name="cost" id="cost-input">
                                            <input type="number"
                                                class="form-control form-control-sm" name="quantity" required id="quantity-input">
                                        </div>

                                        <div class="form-group ms-auto me-2">
                                            <label class="form-label text-secondary">Labour</label>
                                            <input  type="number"
                                                class="form-control form-control-sm" name="labour" required id="labour-input">
                                        </div>
                                        <div class="form-group mx-auto me-2" style="margin-top: 30px;">
                                            <div class="d-flex align-item-center">
                                                <button class="btn bg-gradient-dark btn-sm mb-0"
                                                    type="button" id="save-item">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark mb-0 mt-4">
                        </li>
                      
                        @endforelse
                        
                        <!--end::Form group-->
                    </ul>
                    <div class="d-flex">
                        <button class="btn bg-gradient-primary mb-0 ms-2" data-repeater-create="" type="button" @if ($currentstatus == 'completed') disabled @endif>
                        <i class="fas fa-plus me-2"></i> Add Item
                    </button>
                        <div class="">
                            <button type="submit" @if ($currentstatus == 'completed') disabled @endif
                                class="btn btn-block bg-gradient-dark w-100 mb-0 ms-2" style="text-wrap: nowrap;">
                                Save
                            </button>
                        </div>
                    </div>
                   
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ asset('assets/js/plugins/formrepeater/formrepeater.bundle.js') }}"></script>

    <script>
        // function replyTo(id, email){
        //         alert("You entered p1!"+id+email);
        //     }
        $(document).ready(function() {

            $('#items').repeater({
                        initEmpty: false,

                        defaultValues: {
                            'text-input': 'foo'
                        },

                        show: function() {
                            // deleteHide
                            $(this).slideDown();
                            
                            var items = $(this).parent().find('li[data-repeater-item]');
                            items.parent().find('li[data-repeater-item] [data-repeater-delete]')
                                .removeClass('d-none');
                        },

                        hide: function(deleteElement) {

                            $(this).slideUp(deleteElement);

                            //Find all the items in the form repeater
                            var items = $(this).parent().find('li[data-repeater-item]');

                            //count the items in the repaeter
                            var count = items.length - 1;

                            if (count <= 1) {
                                items.parent().find('li[data-repeater-item] [data-repeater-delete]')
                                    .addClass('d-none');
                            }
                        }
                    });
           
            $('.list-group #replyUser').click(function() {
                id = $(this).data('id');
                email = $(this).data('email');
                $("#GetIt option").attr('selected', false);
                $("#GetIt option[value=" + id + "]").attr('selected', true);
                $("#startTyping textarea").focus();
                $("#startTyping textarea").attr('placeholder', 'Start a message to ' + email);

            });

            const totalSum = () => {
                var totalCost = 0;
                var totalLabourCost = 0;
                document.querySelectorAll('#cost-input').forEach((e => {
                    totalCost =  totalCost+Number(e.value);
                }));

                document.querySelectorAll('#labour-input').forEach((e => {
                    totalLabourCost = totalLabourCost+Number(e.value);
                }));

                var sum = totalLabourCost+totalCost;
                document.querySelector('#sum-field').innerText = sum;
            }
            $(document).on('click', '#add-items', function(a) { 
               
                document.querySelector('#remove-items').classList.remove('d-none')
                document.querySelector('#items-field').classList.remove('d-none')
                a.target.classList.add('d-none')
                
            })

            $(document).on('click', '#edit-item', function(a) {
                console.log(a);
                var itemParent = a.target.closest('.checklist-item');
                console.log(itemParent);
                itemParent.querySelector('#item-editor').classList.remove('d-none')
                itemParent.querySelector('#item-viewer').classList.add('d-none')
            })


            $(document).on('change', '#department-input', function(a) {
                
                var itemParent = a.target.closest('.checklist-item');
                var departmentId = a.target.value;
                console.log(departmentId);
                $.ajax({
                    url: "/inventories/get-items-by-category/" + departmentId,
                    method: "GET",

                    success: function(data) {
                        console.log(data);
                        itemParent.querySelector('#item-input').innerHTML = data;
                    },
                    error: function(xhr) {}
                });
            })


            $(document).on('change', '#item-input', function(a) {
                var itemParent = a.target.closest('.checklist-item');

                var quantity = itemParent.querySelector('#quantity-input').value;
                var itemIndex = a.target.selectedIndex;
                var itemOption = a.target.options[itemIndex]
                var itemName = itemOption ? itemOption.textContent : '';
                $.ajax({
                    url: "/inventories/get-items-details-by-name/" + itemName,
                    method: "GET",
                    dataType: 'JSON',
                    success: function(data) {

                        var cost = quantity * data[0].cost;
                        itemParent.querySelector('#cost-input').value = cost;
                        itemParent.querySelector('#cost-value').innerText = cost;

                    },
                    error: function(xhr) {}
                });

            })

            $(document).on('change', '#quantity-input', function(a) {
                var itemParent = a.target.closest('.checklist-item');

                var quantity = a.target.value;
                // var itemName = itemParent.querySelector('#item-input').value;
                var itemIndex = itemParent.querySelector('#item-input').selectedIndex;
                var itemOption = itemParent.querySelector('#item-input').options[itemIndex]
                var itemName = itemOption ? itemOption.textContent : '';
                $.ajax({
                    url: "/inventories/get-items-details-by-name/" + itemName,
                    method: "GET",
                    dataType: 'JSON',
                    success: function(data) {

                        var cost = quantity * data[0].cost;
                        itemParent.querySelector('#cost-input').value = cost;
                        itemParent.querySelector('#cost-value').innerText = cost;
                    },
                    error: function(xhr) {}
                });
            })


            $(document).on('click', '#save-item', function(a) {
                var itemParent = a.target.closest('.checklist-item');

                var description = itemParent.querySelector('#description-input').value;
                var departmentIndex = itemParent.querySelector('#department-input').selectedIndex;
                var departmentOption = itemParent.querySelector('#department-input').options[departmentIndex]
                var department = departmentOption ? departmentOption.textContent : '';
                // var item = itemParent.querySelector('#item-input').value;
                var itemIndex = itemParent.querySelector('#item-input').selectedIndex;
                var itemOption = itemParent.querySelector('#item-input').options[itemIndex]
                var item = itemOption ? itemOption.textContent : '';
                var cost = itemParent.querySelector('#cost-input').value;
                var labour = itemParent.querySelector('#labour-input').value;

                itemParent.querySelector('#description-value').innerText = description;
                itemParent.querySelector('#department-value').innerText = department;
                itemParent.querySelector('#item-value').innerText = item;
                itemParent.querySelector('#cost-value').innerText = cost;
                itemParent.querySelector('#labour-value').innerText = labour;

                totalSum()
                

                itemParent.querySelector('#item-viewer').classList.remove('d-none')
                itemParent.querySelector('#item-editor').classList.add('d-none')
            })

        

       


            const messages = document.getElementById('message-box');

            function scrollToBottom() {
                messages.scrollTop = messages.scrollHeight;
            }

           
            totalSum()
            scrollToBottom();


        });
    </script>
@endsection
