@extends('layouts.main')
@section('page-title', 'Invoices')
@section('content')
<div class="row mt-3">
    
  
  
    <div class="col-12">
        <div class="card mb-4">
         
          <div class="card-header pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">Invoices for {{ $user->first_name}} {{ $user->middle_name}}{{ $user->last_name}}</h5>
                {{-- <p class="text-sm mb-0">
                  A lightweight, extendable, dependency-free javascript HTML table plugin.
                </p> --}}
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                <div class="ms-auto my-auto">
                  <a href="/invoices/resident/{{ $user->id}}" class="@if (request('sort') == Null) bg-gradient-primary btn-sm mb-0 @endif btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1">All</a>
                  <a href="/invoices/resident/{{ $user->id}}?sort=pending" class="@if (request('sort') == 'pending') bg-gradient-primary btn-sm mb-0 @endif btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1">Pending</a>
                  <a href="/invoices/resident/{{ $user->id}}?sort=successful" class="@if (request('sort') == 'successful') bg-gradient-primary btn-sm mb-0 @endif btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1">Successful</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table id="invoices" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                        <td>
                          <div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $invoice->full_name }} ({{ $invoice->application_no }})</h6>
                              <p class="text-sm font-weight-bold text-secondary mb-0">{{ $invoice->email }}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <h6 class="text-sm font-weight-bold mb-0">N{{ $invoice->amount }}</h6>
                          @if ($invoice->payment_status == 'paid')
                          <p class="text-sm  text-success mb-0">{{ $invoice->status }} <i class="ni ni-bold-up text-sm ms-1 mt-1 text-success"></i></p>
                           @else<p class="text-sm  text-secondray mb-0">{{ $invoice->status }} <i class="ni ni-bold-down text-sm ms-1 mt-1 text-secondray"></i></p>
                          @endif
                           
                          
                        </td>
                        <td class="align-middle text-center text-sm">
                          <div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $invoice->type }}</h6>
                              <p class="text-xs font-weight-bold text-secondary mb-0">
                                {{-- {{json_encode($invoice->payment_data)}} --}}
                                @if ($payment_data = json_decode($invoice->payment_data))
                               
                                @if (isset($payment_data->admin_id))
                      recieved by <a href="mailto:{{$payment_data->admin_email}}">{{$payment_data->admin_name}}</a> 
                              @endif
                              @else
                              paid online
                                @endif
                              </p>
                            </div>
                          </div>
                          
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-sm font-weight-bold mb-0">{{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}</p>
                          </td>
                        <td class="align-middle text-end">
                          <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                            {{-- <p class="text-sm font-weight-bold mb-0">13</p> --}}
                            {{-- <i class="ni ni-bold-down text-sm ms-1 mt-1 text-success"></i>
                             --}}
                             @if ($invoice->payment_status == 'paid')
                             <a href="/invoice/{{ $invoice->application_no }}" class="btn btn-sm btn-dark mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-3" >
                                View Invoice
                             </a>
                              @else
                              <a href="/create-payment/{{ $invoice->application_no }}" class="btn btn-sm btn-outline-dark mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-3" >
                                Create Payment
                             </a>
                              {{-- <button data-application-no="{{ $invoice->application_no }}"
                                data-amount="{{ $invoice->amount }}"
                              id="create-payment-button" onclick="createPayment()" class="btn btn-sm btn-outline-dark mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-3" >
                                Create Payment
                              </button> --}}
                          @endif
                           
                           
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

    
@endsection
@section('script')
<script>
  $(function() {
    

      $('#invoices').DataTable({
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
         
          
      });
  });
</script>
@endsection
