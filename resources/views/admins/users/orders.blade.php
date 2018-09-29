@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>View Orders by {{$user->retailerName}}</h2>
    </div>

    <!-- Unverified Users top -->
    
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Orders By {{$user->retailerName}} List</h2>
                    <small>List of all orders by {{$user->retailerName}} present in record</small>
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
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos display" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Shop Name</th>
                                    <th>Email</th>
                                    <th>Mobile No</th>
                                    <th>Placed On</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($orders as $order) 
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->retailerName}}</td>
                                        <td>{{$order->shopName}}</td>
                                        <td><span class="btn btn-success btn-sm" data-toggle="modal" data-target="#emailAdminModal{{$order->id}}">Email</span></td>
                                        <td>{{$order->mobileNo}}</td>
                                        <td>{{date('d/m/Y, h:ia', strtotime($order->created_at))}}</td>
                                        <td><a href="{{route('orders.detail', ['id' => $order->id, 'admin' => 'admin'])}}" class="btn btn-primary btn-sm">Detail</a></td>
                                    </tr>

                                    @include('inc.admin.modals.orderEmailModal')
                               @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection