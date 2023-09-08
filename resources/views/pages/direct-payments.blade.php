@extends('layouts.main')
@section('page-title', 'Direct Payments')
@section('content')
<div class="row mt-3">
    
  
  
    <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
              <div class="col-lg-6 col-7">
                <h6>Direct Payments</h6>
                      
              </div>
              <div class="col-lg-6 col-5 my-auto text-end">
                  <button href="" type="button" class="btn btn-primary mb-0" data-toggle="modal" data-target="#newPayment">New Payment</button>
              </div>
            </div>  
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table id="manual_payment"  class="table mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Application No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Transaction ID</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach (DB::table('manual_payment')->where('year', $viewingYear)->get() as $manual_payment)
                    <tr>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">{{ $manual_payment->application_no }}</p>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">N{{ $manual_payment->amount }}</p>
                            
                          
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-sm font-weight-bold mb-0">{{ $manual_payment->type }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-sm font-weight-bold mb-0">{{ \Carbon\Carbon::parse($manual_payment->created_at)->format('d/m/Y') }}</p>
                          </td>
                        <td class="align-middle text-center">
                            <p class="text-sm font-weight-bold mb-0">{{ $manual_payment->transaction_id }}</p>
                            
                        </td>
                      </tr>
                    @endforeach
                  
             
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    
      <div class="modal fade" id="newPayment" tabindex="-1" role="dialog" aria-labelledby="newPayment"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
              <div class="modal-body p-0">
                  <div class="card shadow ">
                      <div class="card-header  p-3">
                          <h6 class="mb-0">Create A Payment</h6>
                          <small>Input the application no</small>
                      </div>
                      <div class="card-body p-3 pt-0">
                          <form method="GET" action="new_payment" enctype="multipart/form-data">@csrf

                              

                              <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                  Application Number</h6>
                              <div class="border-0 px-0 text-sm mb-3 mt-3">
                                  <input class="form-control" type="text" name="application_no"
                                      placeholder="Anything..." />
                              </div>



                              <div class="border-0 px-0 text-sm mb-3 ">
                                  <input class="btn btn-primary mt-3" type="submit" value="Create Payment" />
                              </div>



                          </form>
                          </ul>
                      </div>
                  </div>

              </div>
          </div>
      </div>
  </div>
    
@endsection
@section('script')
<script>
    $(function() {
      

        $('#manual_payment').DataTable({
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
