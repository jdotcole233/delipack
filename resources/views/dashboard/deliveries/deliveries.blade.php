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
                <button type="button" class="btn btn-info btn-outline pull-right" name="button" data-toggle="modal" data-target="#manual_record_modal">Manual Record</button>
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
                                        <td id="rating">
                                            <select id="rating_tag">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </td>
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



                    <fieldset class="border delivery_box p-2">
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

<div class="modal fade bd-example-modal-lg" id="manual_record_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Add Manual record</h5>
      </div>
      <div class="modal-body">
          <form class="form container manual_record_form" action="index.html" method="post">
              <div class="row mb-2">
                <div class="form-group col-md-12">
                  <label for="riders">Select rider</label>
                  <select class="form-control" name="rider" id="select_rider_input" required>
                      <option value="">Choose one</option>
                      @foreach($company_rider_bikes as $rider)
                      <option value="{{$rider->company_rider_id}}" data-rider="{{$rider}}">{{$rider->first_name }} {{$rider->first_name}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <meta name="csrf-token" content="{{csrf_token()}}">
                  <label for="brand">Motor Brand</label>
                  <input type="text" name="brand" value="" id="brand_name14" class="form-control" readonly>
                </div>
                <div style="display:none" class="form-group col-md-6">
                  <input type="text" name="rider_details" id="rider_details123" value="Hello" class="form-control">
                </div>
                <div class="form-group col-md-6">
                  <label for="brand">Registration Number</label>
                  <input type="text" name="registered_number" value="" id="reg_number" class="form-control" readonly>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="brand">Pick up From</label>
                  <input type="text" name="source" value="" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="brand">Deliver To</label>
                  <input type="text" name="destination" value="" class="form-control" required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="brand">Customer Name</label>
                  <input type="text" name="customer_name" value="" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="brand">Customer Contact</label>
                  <input type="text" name="phone_number" value="" class="form-control" id="phone_num" required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="brand">Payment Type</label>
                  <select class="form-control" id="payment_type" name="payment_type" required>
                    <option value="">Choose one</option>
                    <option value="cash">Cash</option>
                    <option value="mobilemoney">Mobile Money</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="brand">Delivery Charge</label>
                  <input type="text" name="delivery_charge" value="" class="form-control" required>
                </div>
              </div>
              <div class="row mb-2" id="payment_mode">
                <div class="form-group col-md-12">
                  <label for="">Payment Mode</label>
                  <select class="form-control" name="">
                    <option value="pay at pick up">Pay at pick up</option>
                      <option value="pay on delivery">Pay on delivery</option>
                  </select>
                </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
          <button type="button" id="manual_record_form_button" name="button" class="btn btn-success pull-right">Submit</button>
          <button type="button" name="button" data-dismiss="modal" class="btn btn-secondary pull-right">Cancel</button>
      </div>
    </div>
  </div>
</div>

@endsection
