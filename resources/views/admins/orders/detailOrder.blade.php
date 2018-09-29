@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>View Orders by Unverified Users</h2>
    </div>

    <!-- Unverified Users top -->
    
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Order No. {{$order->id}}</h2>
                    <small>List of all orders by unverified users present in record</small>
                    @include('inc.messages')
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <p><b>Delivery Address</b></p>
                    <div class="address">
                        <span>{{$order->houseNo}}</span><br>
                        <span>{{$order->streetName}}</span><br>
                        <span>{{$order->city . ", " . $order->pincode}}</span><br>
                        <span>Landmark: {{$order->landmark}}</span>
                    </div>

                    <h2 class="card-inside-title">Order Details</h2>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dashboard-task-infos display">
                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Medicine Name</th>
                                    <th>Cost Price (Single Medicine)</th>
                                    <th>Sell Price (Single Medicine)</th>
                                    <th>Quantity</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($detailOrders as $detailOrder) 
                                    <tr>
                                        {{-- <td>{{$order->id}}</td> --}}
                                        <td>{{$detailOrder->medicineName}}</td>
                                        <td>Rs.{{$detailOrder->cost}}</td>
                                        <td>Rs.{{$detailOrder->cost - ($detailOrder->cost * ($detailOrder->discount/100))}}</td>
                                        <td>{{$detailOrder->quantity}}</td>
                                        <td>{{$detailOrder->discount}}%</td>
                                        <td>Rs.{{$detailOrder->rate}}</td>
                                    </tr>
                               @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-center" style="font-size:130%;"><strong>Total: Rs.{{$order->totalAmount}}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection