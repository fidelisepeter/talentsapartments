@extends('layouts.main')
@section('page-title', 'Invoices')
@section('content')
<div class="row mt-3">
    
  @if ($invoice->sender_details != Null)
  <div class="col-sm-4 mx-auto">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Payment Details</h6>
      </div>
      <div class="card-body ">

        <ul class="list-group">
          <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Method:</strong> {{ $invoice->payment_method }}</li>
          <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Amount:</strong> {{ $invoice->amount }}</li>
          <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Original Amount:</strong> {{ $invoice->original_amount }}</li>
          
          @foreach (json_decode($invoice->sender_details) as $key => $value)
          
          <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">{{ucwords(str_replace('_', ' ', $key))}}:</strong> {{ $value }}</li>
          
         
          
          @endforeach
         
        </ul>
      </div>
    </div>
  </div>
  @endif
  
    <div class="col-sm-8 mx-auto">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Create Payment</h6>
          </div>
          <div class="card-body ">
            <form class="form-horizontal" method="POST"
                    action="/create-manual-payment">
                    {{ csrf_field() }}
                    
    <label class="form-label">Application No</label>
    <div class="form-group">
        <input id="application-no" type="text" class="form-control" name="application_no"
    value="{{ $invoice->application_no }}"
        required>
    </div>
    <label class="form-label">Method</label>
    <div class="form-group">
        <select id="" class="form-control"
        name="type" placeholder="Current password" required>
        <option value="bank">Bank Transfer</option>
        <option value="direct">Direct Cash</option>
        
        </select>
    </div>
    <label class="form-label">Amount (Original {{ $invoice->original_amount ?? $invoice->amount }})</label>
    <div class="form-group">
        <input id="amount" type="text" class="form-control" name="amount"
         value="{{ $invoice->amount }}" required>

  
    </div>
    <label class="form-label">Message</label>
    <div class="form-group">
        <textarea id="message"  class="form-control"
        name="message"></textarea>
    </div>
    
    <button class="btn bg-gradient-dark w-100 mb-0">Approve Payment</button>
</form>
          </div>
        </div>
      </div>

      
    
    
@endsection
@section('script')
   
@endsection
