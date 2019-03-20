@extends('systemheaders.dashboardheaders')
@section('content')
<div class="panel-header panel-header-sm">
</div>


<div class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Reports </h4>

                <fieldset class="border p-2">
                    <legend class="w-auto">From - to</legend>
                     <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>From</label>
                                <input type="Date" class="form-control" placeholder="Username" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>To</label>
                                <input type="Date" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p></p>
                                <!-- <input type="submit" class="btn btn-primary" placeholder="Username" value="michael23"> -->
                                <button class="btn btn-primary">Generate</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <br>
                <br>

              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="riderstable">
                    <thead class=" text-primary">
                      <th> Trans ID </th>
                      <th> Sender name </th>
                      <th> Receiver name </th>
                      <th> Delivery St.</th>
                      <th> Rider </th>
                      <th> Date & Time </th>
                      <th> Charge </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td> 1</td>
                        <td> Dakota Rice </td>
                        <td> Oud-Turnhout </td>
                        <td> $36,738 </td>
                        <td> Dakota Rice</td>
                        <td> Niger </td>
                        <td> $36,738 </td>
                      </tr>
                      
                    </tbody>
                  </table>

                 <div class="row">
                    <div class="col-md-12">
                        <form>
                            <fieldset class="border p-2">
                                <legend class="w-auto">Total</legend>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td>{GHC 4400}</td>
                                            </tr>
                                        </table>
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



@endsection