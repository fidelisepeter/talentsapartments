@extends('layouts.main')
@section('page-title', 'Billings')
@section('content')
<div class="row mt-3">
    
  
  
  <div class="row mt-4">
    <div class="col-sm-10 mt-sm-0 mt-4 m-auto">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-6">
              <h6 class="mb-0">Billings</h6>
            </div>
            {{-- <div class="col-md-6 d-flex justify-content-end align-items-center">
              <i class="far fa-calendar-alt me-2" aria-hidden="true"></i>
              <small>01 - 07 June 2021</small>
            </div> --}}
          </div>
        </div>
        <div class="card-body p-3">
          <ul class="list-group">
            @foreach (DB::table('invoices')->where('user_id', $user->id)->orderBy('updated_at', 'DESC')->get()
            as $invoice)
            <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
              <div class="d-flex">
                <div class="d-flex align-items-center">
                    @if ($invoice->status != 'successful')
                    <a href="/invoice/{{ $invoice->application_no }}" class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down" aria-hidden="true"></i></a href="/invoice/">
                                    @else
                                    <a href="/invoice/{{ $invoice->application_no }}" class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up" aria-hidden="true"></i></a href="/invoice/">
                                    @endif
                  
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">{{ $invoice->payment_method }}</h6>
                    <span class="text-xs"> payment for {{ $invoice->type }} - {{ Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}</span>
                  </div>
                </div>
                @if ($invoice->status != 'successful')
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                    {{ $invoice->amount }}
                </div>
                <div class="d-flex align-items-center ms-auto">
                    <a href="/invoice/{{ $invoice->application_no }}" class="btn btn-sm bg-gradient-danger ms-auto mb-0 js-btn-next" title="Next"> 
                        <span  style="color:white"> View Invoice</span>
                       </a>
                       
                </div>
                 @else
                 <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                    ₦ {{ $invoice->amount }}
                </div>
                <div class="d-flex align-items-center ms-auto">
                    <a href="/invoice/{{ $invoice->application_no }}" class="btn btn-sm bg-gradient-success ms-auto mb-0 js-btn-next" title="Next"> 
                        <span  style="color:white"> View Invoice</span>
                       </a>
                       
                </div>
                @endif
                
              </div>
              <hr class="horizontal dark mt-3 mb-2">
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="update-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update</h4>

            </div>
            <form class="form-horizontal" method="POST" action="{{ route('profile.updatepersonalinfo') }}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-body">



                    <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                        <label for="photo" class="col-md-12 control-label">Profile Photo</label>

                        <div class="col-md-12">
                            <input required class="form-input ms-auto form-control" placeholder="500" type="file"
                                name="photo" id="">

                            @if ($errors->has('photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>



                </div>
                <div class="modal-footer justify-content-between">

                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-4">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="update-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Password</h4>

            </div>
            <div class="card-body p-3">
                <form class="form-horizontal" method="POST"
                                action="{{ route('profile.updatePassword') }}">
                                {{ csrf_field() }}
                <label class="form-label">Current password</label>
                <div class="form-group">
                    <input id="currentPassword" type="password" class="form-control"
                    name="currentPassword" placeholder="Current password" required>

                @if ($errors->has('currentPassword'))
                    <span class="help-block">
                        <strong>{{ $errors->first('currentPassword') }}</strong>
                    </span>
                @endif
                </div>
                <label class="form-label">New password</label>
                <div class="form-group">
                    <input id="newPassword" type="password" class="form-control" name="newPassword"
                    placeholder="New password" required>

                @if ($errors->has('newPassword'))
                    <span class="help-block">
                        <strong>{{ $errors->first('newPassword') }}</strong>
                    </span>
                @endif
                </div>
                <label class="form-label">Confirm new password</label>
                <div class="form-group">
                    <input id="newPasswordConfirm" type="password" class="form-control"
                    name="newPassword_confirmation" placeholder="Enter password" required>
                </div>
                <button class="btn bg-gradient-dark w-100 mb-0">Update password</button>
            </form>
              </div>
            
                                
                            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<div class="modal fade" id="submit-room-mate-code">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Password</h4>

            </div>
            <div class="card-body p-3">
                <form class="form-horizontal" method="POST"
                                action="/room-mate-code">
                                {{ csrf_field() }}
                                <p class="text-center">input the code given to by your prefered rom mate</p>
                <label class="form-label">Code </label>
                <div class="form-group">
                    <input id="room_mate_code" type="text" class="form-control"
                    name="verification_code" placeholder="Room mate code" required>

                @if ($errors->has('room_mate_code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('room_mate_code') }}</strong>
                    </span>
                @endif
                
                <button class="btn bg-gradient-dark w-100 mb-0 mt-3">Sumit</button>
            </form>
              </div>
            
                                
                            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();
        });
    </script>
@endsection
