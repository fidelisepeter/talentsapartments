@extends('layouts.main')
@section('page-title', 'Complaints')
@section('content')
@php
  $complian_list = DB::table('complaints')->where('user_id', Auth::id())->whereNotNull('complain')->orderBy('created_at', 'asc')->get();
  $message_list = DB::table('messages')->where('user_id', Auth::id())->whereNotNull('tasks_id')->orderBy('created_at', 'asc')->get();
  
$list_messages =  json_decode(json_encode($message_list->concat($complian_list)), true);
// Comparison function
function date_compare($element1, $element2) {
    $created_at1 = strtotime($element1['created_at']);
    $created_at2 = strtotime($element2['created_at']);
    return $created_at1 - $created_at2;
} 
  
// Sort the array 
usort($list_messages, 'date_compare');
$all_messages =  json_decode(json_encode($list_messages));
@endphp
    <div class="row">
        <div class="col-12 col-xl-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Complaints</h6>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="/new-complaint" enctype="multipart/form-data">@csrf

                        <ul class="list-group">
                            <li class="list-group-item border-0 px-0">
                                <div class="text-sm">Category</div>
                                <div class="form-check form-switch ps-0">
                                    <select name="category" class="form-control">
                                        <option>Pumbling</option>
                                        <option>Electricals</option>
                                        <option>Capentry</option>
                                    </select>
                                </div>
                            </li>
                          <li class="list-group-item border-0 px-0">
                            <div class="mt-2 text-sm mb-1">Description</div>
                                <div class="form-check form-switch ps-0">
                                    <input class="form-control" required name="description" id="" placeholder="Description" />
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="mt-2 text-sm mb-1">Complian Details</div>
                                <div class="form-check form-switch ps-0">
                                    <textarea class="form-control" required name="complain" id="" cols="30" rows="10"></textarea>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="mt-2 text-sm mb-1">Attached File</div>
                                    <div class="form-check form-switch ps-0">
                                        <input type="file" class="form-control" required name="file" id="" placeholder="File" />
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <div class="mt-2 text-sm mb-1">Have you complained on this matter before?</div>
                                    <div class="form-check form-switch ps-0">
                                        <input name="complained_before" value="completed"
                                            class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">No/Yes</label>
                                    </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0 d-none" id="date-row">
                                        <div class="mt-2 text-sm mb-1">Complain Date</div>
                                    <div class="form-check form-switch ps-0">
                                        <input type="date" name="last_date"
                                                    class="form-control mb-2"
                                                     id="" placeholder="Date" />
                                    </div>
                                        </li>
                                    
                                </li>
                            <input class="btn btn-info" type="submit" value=" submit a complaint" />

                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-8 mb-3">
            <div class="card blur shadow-blur max-height-vh-70">
                <div class="card-header shadow-lg">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center">
                                <img alt="Image" src="{{ Auth::user()->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}" class="avatar">
                                <div class="ms-3">
                                    <h6 class="mb-0 d-block">Messages</h6>
                                    <span class="text-sm text-dark opacity-8"></span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="overflow-auto overflow-x-hidden"  id="message-box">
                <div class="card-body" >
                  
                    @foreach ($all_messages as $messages)
                        @php
                        if(isset($messages->tasks_id)){
                          $task_id = $messages->tasks_id;

                        }elseif(isset($messages->id) && isset($messages->complain)){
                          $task_id = DB::table('tasks')->where('task_of', $messages->id)->value('id');
                        }else {
                          $task_id = Null;
                        }
                         @endphp
                        @if ($messages->status == 'sent')
                            <div class="row justify-content-start mb-4">
                                <div class="col-auto">
                                    <span>
                                        {{ DB::table('users')->where('id',DB::table('tasks')->where('user_id', Auth::id())->value('attendant'))->value('first_name') }}
                                        {{ DB::table('users')->where('id',DB::table('tasks')->where('user_id', Auth::id())->value('attendant'))->value('last_name') }}</span>
                                    <div class="card ">
                                        <div class="card-body py-2 px-3">
                                            <p class="mb-1">
                                                {{ $messages->message ??  $messages->complain}}
                                            </p>
                                            <div class="d-flex align-items-center text-sm opacity-6">
                                                <i class="ni ni-check-bold text-sm me-1"></i>
                                                <small>{{ \Carbon\Carbon::parse($messages->created_at)->format('j M h:i A') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        @else
                        @if (isset($messages->complain))
  <hr>
@endif
                            <div class="row justify-content-end text-right mb-4">
                                <div class="col-auto">


                                    <div class="card bg-gray-200">
                                        <div class="card-body py-2 px-3">
                                            <p class="mb-0">
                                              {{ $messages->message ??  $messages->complain}}
                                            </p>
                                            <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                                                <i class="ni ni-check-bold text-sm me-1"></i>
                                                <small>{{ \Carbon\Carbon::parse($messages->created_at)->format('j M h:i A') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    

                    @if (isset($messages->tasks_id) && DB::table('tasks')->where('id', $messages->tasks_id)->value('status') == 'completed') 
                            <div class="row justify-content-start mb-4">
                                <div class="col-auto">
                                    <span>....</span>
                                    <div class="card ">
                                        <div class="card-body py-2 px-3">
                                            <p class="mb-1">
                                                Last conversation ended! You can start a new complian from the other card
                                            </p>
                                            <div class="d-flex align-items-center text-sm opacity-6">
                                                <i class="ni ni-check-bold text-sm me-1"></i>
                                                <small>{{ \Carbon\Carbon::now()->format('j M h:i A') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                  @if (!isset($task_id)) 
                            <div class="row justify-content-start mb-4">
                                <div class="col-auto">
                                    <span>System</span>
                                    <div class="card ">
                                        <div class="card-body py-2 px-3">
                                            <p class="mb-1">
                                                Your complian has been sent! an admin will attend to you shortly
                                            </p>
                                            <div class="d-flex align-items-center text-sm opacity-6">
                                                <i class="ni ni-check-bold text-sm me-1"></i>
                                                <small>{{ \Carbon\Carbon::now()->format('j M h:i A') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif (!isset($messages->tasks_id)) 
                    <div class="row justify-content-start mb-4">
                        <div class="col-auto">
                            <span>....</span>
                            <div class="card ">
                                <div class="card-body py-2 px-3">
                                    <p class="mb-1">
                                        Your complian has been assigned to {{ DB::table('users')->where('id', DB::table('tasks')->where('task_of', $messages->id)->value('attendant'))->value('first_name') }} {{ DB::table('users')->where('id', DB::table('tasks')->where('task_of', $messages->id)->value('attendant'))->value('last_name') }}
                                    </p>
                                    <div class="d-flex align-items-center text-sm opacity-6">
                                        <i class="ni ni-check-bold text-sm me-1"></i>
                                        <small>{{ \Carbon\Carbon::now()->format('j M h:i A') }}</small>
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
                        <input type="hidden" name="tasks_id" value="{{ $task_id ?? Null }}">
                        <div class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type here"
                                    aria-label="Message example input" onfocus="focused(this)" onfocusout="defocused(this)"
                                    name="message" @if (isset($messages->tasks_id) && DB::table('tasks')->where('id', $messages->tasks_id)->value('status') == 'completed' || !isset($task_id)) disabled @endif>
                            </div>
                            <button class="btn bg-gradient-primary mb-0 ms-2" @if (isset($messages->tasks_id) && DB::table('tasks')->where('id', $messages->tasks_id)->value('status') == 'completed' || !isset($task_id)) disabled @endif>
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
    @section('script')
    <script>
        // function replyTo(id, email){
        //         alert("You entered p1!"+id+email);
        //     }
        $(document).ready(function() {

            c = document.querySelector('input[name="complained_before"]');
                    c.addEventListener("change", function() {
                        if (c.checked) {
                            document.querySelector('#date-row').classList.remove('d-none');
                        } else {
                            document.querySelector('#date-row').classList.add('d-none');
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
            
           
    const messages = document.getElementById('message-box');
    function scrollToBottom() {
  messages.scrollTop = messages.scrollHeight;
}

scrollToBottom();
                       

        });
    </script>
@endsection