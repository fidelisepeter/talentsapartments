@extends('layouts.main')
@section('page-title', 'Notifications')
@section('content')
    <div class="card card-body blur shadow-blur overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">

            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Notifications

                    </h5>

                </div>
            </div>

        </div>
    </div>
    <div class="row mt-5">
            <div class="col-12">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Latest Notifications</h6>

            </div>
            <div class="card-body p-3">
                <div class="timeline timeline-one-side">
                    @foreach ($notifications as $notification)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="ni ni-key-25 text-primary text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    {{$notification->created_by}},
                                    {{$notification->message}}
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    {{ \Carbon\Carbon::parse($notification->created_at)->format('j M h:i A') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
    {!! $notifications->links() !!}
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
                $("input[name='amenities[]']").change(function() {
                    var maxAllowed = 10;
                    var cnt = $("input[name='amenities[]']:checked").length;
                    if (cnt > maxAllowed) {
                        $(this).prop("checked", "");

                        $('#amenities-error').attr({
                            "class": "text-danger",
                            "role": "alert"
                        });
                    }
                });
                // Select all elements with data-toggle="popover" in the document
                // $('[data-toggle="popover"]').popover();

            });
        </script>
    @endsection
