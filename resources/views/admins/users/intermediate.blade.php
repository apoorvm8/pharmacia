@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>View Intermediate Users</h2>
    </div>

    <!-- Verified Users top -->
    
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Intermediate Users List</h2>
                    <small>List of all intermediate (either Gst No or Drug No) users present in record</small>
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
                                    <th>GST No.</th>
                                    <th>Drug Licence No.</th>
                                    <th>Remove</th>
                                    <th>Blacklist</th>
                                    <th>Orders</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($users as $user) 
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->retailerName}}</td>
                                        <td>{{$user->shopName}}</td>
                                        <td><span class="btn btn-success btn-sm" data-toggle="modal" data-target="#emailAdminModal{{$user->id}}">Email</span></td>
                                        <td>{{$user->mobileNo}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    {{$user->gstVerificationStatus == 1 ? 'Verified' : $user->gstNo}}
                                                </div>
                                            </div>
                                            @if($user->gstNo != null)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <a href="/storage/users/{{strtolower($user->retailerName) . "_" . $user->id}}/{{$user->gstNoImage}}" target="_blank">Image</a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="button" value="Verify" class="gstVerifyBtn btn btn-primary btn-sm" {{$user->gstVerificationStatus == 1 ? "disabled" : ""}}>
                                                        <img src="{{asset('assets/adminPanel/images/loading.gif')}}" height="80" width="80" style="display: none;">
                                                        <input type="hidden" value="{{$user->id}}">
                                                    </div>
                                                <div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    {{$user->drugVerificationStatus == 1 ? "Verified" : $user->drugNo}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if($user->drugNo != null)
                                                    <div class="col-md-4">
                                                        <a href="/storage/users/{{strtolower($user->retailerName) . "_" . $user->id}}/{{$user->drugNoImage}}" target="_blank">Image</a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="button" value="Verify" class="drugVerifyBtn btn btn-primary btn-sm" {{$user->drugVerificationStatus == 1 ? "disabled" : ""}}>
                                                        <img src="{{asset('assets/adminPanel/images/loading.gif')}}" height="80" width="80" style="display: none;">
                                                        <input type="hidden" value="{{$user->id}}">
                                                    </div>
                                                @endif
                                            <div>
                                        </td>
                                        <td>
                                            <form>
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="button" value="Remove" class="removeBtn btn btn-danger btn-sm">
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                @csrf
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="button" value="Blacklist" class="blacklistBtn btn btn-default btn-sm">
                                            </form>
                                        </td>
                                        <td><a class="btn btn-primary btn-sm" href="{{route('users.order', ['id' => $user->id, 'admin' => 'admin'])}}">View</a></td>
                                    </tr>

                                    @include('inc.admin.modals.emailModal')
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