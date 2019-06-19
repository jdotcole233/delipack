@extends('systemheaders.dashboardheaders')
@section('content')
<div class="panel-header panel-header-sm">
</div>



<div class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
              <div class="card-header">
                <h4 class="card-title"> All Deliveries </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="transactionstable">
                    <thead class=" text-primary">
                      <th> Ref </th>
                      <th> Customer</th>
                      <th> Phone </th>
                      <th> Pick-up </th>
                      <th> Delivery </th>
                      <th> Date </th>
                      <th> Rider name </th>
                      <th> Action </th>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>






<div class="modal fade bd-quickview-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">



      <div class="modal-body">
          <div class="content">
<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h6 class="title" id="transaction_title">From: {Source name}  - to: {Destination name}, Rider: {Rider namee}</h6>
              </div>
              <div class="card-body">
                <form>

                    <fieldset class="border p-2">
                        <legend class="w-auto">Delivery summary</legend>
                        <div class="row">
                            <div class="col-md 6">
                                 <table class="table">
                                    <tr>
                                        <td><strong>Transaction ID</strong></td>
                                        <td id="transaction_number" >{Transaction number}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date & time</strong></td>
                                        <td id="created_at">{Date & time}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ride (Brand)</strong></td>
                                        <td id="brand_name">{Motor name}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md 6">
                               <table class="table">
                                    <tr>
                                        <td><strong>ETA</strong></td>
                                        <td >{00:00}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Rating</strong></td>
                                        <td id="rating">{*****}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ride Number</strong></td>
                                        <td id="registered_number">{Registered number}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md 12">
                               <table class="table">
                                    <tr>
                                        <td><strong>Delivery fee:</strong></td>
                                        <td id="delivery_fee">GHC 15</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Commission</strong></td>
                                        <td id="commission">GHC 2</td>
                                    </tr>
                                     <tr>
                                        <td><strong>Total amount</strong></td>
                                        <td id="transtotal">GHC 13</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
 
                    </fieldset>

                    <fieldset class="border p-2">
                        <legend class="w-auto">Sender's Information</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" id="customerfirstname" class="form-control" placeholder="Username" value="michael23" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" id="customerlastname" class="form-control" placeholder="Username" value="michael23" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="text" id="customerphonenumber" class="form-control" placeholder="Username" value="michael23" readonly>
                                </div>
                            </div>
                        </div>
                    </fieldset>



                    <fieldset class="border p-2">
                        <legend class="w-auto">Rider's Information</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" id="riderFirstName" class="form-control" placeholder="Username" value="michael23" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" id="riderLastName" class="form-control" placeholder="Username" value="michael23" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Personal number</label>
                                    <input type="text" id="personalnumber" class="form-control" placeholder="Username" value="michael23" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Work number</label>
                                    <input type="text" id="worknumber"  class="form-control" placeholder="Username" value="michael23" readonly>
                                </div>
                            </div>
                        </div>
                    </fieldset>



                    <fieldset class="border p-2">
                        <legend class="w-auto">Errand's Information</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pick up location</label>
                                    <input type="text" id="pickup" class="form-control" placeholder="Username" value="michael23" readonly>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Delivery location</label>
                                    <input type="text" id="delivery" class="form-control" placeholder="Username" value="michael23" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Delivery status</label>
                                    <input type="text" id="deliverystatus" class="form-control" placeholder="Username" value="michael23" readonly>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </form>
              </div>
            </div>
          </div>
        </div>
</div>

      </div>
    </div>
  </div>
</div>

@endsection