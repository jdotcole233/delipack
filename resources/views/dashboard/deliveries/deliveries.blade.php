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
                  <table class="table" id="riderstable">
                    <thead class=" text-primary">
                      <th> Ref </th>
                      <th> Sender </th>
                      <th> Source </th>
                      <th> Receiver </th>
                      <th> Destination </th>
                      <th> Delivery St.</th>
                      <th> Rider </th>
                      <th> Action </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td> 1</td>
                        <td> Dakota Rice </td>
                        <td> Oud-Turnhout </td>
                        <td> $36,738 </td>
                        <td> Dakota Rice</td>
                        <td> Niger </td>
                        <td> Oud-Turnhout </td>
                        <td> <button class="btn btn-primary" data-toggle="modal" data-target=".bd-quickview-modal-lg"> Quick view</button> </td>
                      </tr>
                      
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
                <h6 class="title">From: {Source name}  - to: {Destination name}, Rider: {Rider namee}</h6>
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
                                        <td>{Transaction number}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date & time</strong></td>
                                        <td>{Date & time}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ride (Brand)</strong></td>
                                        <td>{Motor name}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md 6">
                               <table class="table">
                                    <tr>
                                        <td><strong>ETA</strong></td>
                                        <td>{00:00}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Rating</strong></td>
                                        <td>{*****}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ride Number</strong></td>
                                        <td>{Registered number}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md 12">
                               <table class="table">
                                    <tr>
                                        <td><strong>Delivery fee:</strong></td>
                                        <td>GHC 15</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Commission</strong></td>
                                        <td>GHC 2</td>
                                    </tr>
                                     <tr>
                                        <td><strong>Total amount</strong></td>
                                        <td>GHC 13</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
 
                    </fieldset>

                    <fieldset class="border p-2">
                        <legend class="w-auto">Sender's Information</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Other name</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                        </div>
                    </fieldset>



                    <fieldset class="border p-2">
                        <legend class="w-auto">Receiver's Information</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Other name</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                        </div>
                    </fieldset>



                    <fieldset class="border p-2">
                        <legend class="w-auto">Rider's Information</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Other name</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
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