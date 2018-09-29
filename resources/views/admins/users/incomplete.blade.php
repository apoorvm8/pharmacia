@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Incomplete Users</h2>
    </div>

    <!-- Unverified Users top -->
    
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Unverified Users List</h2>
                    <small>List of all incomplete users ( without GST <strong>and</strong> Drug no.) present in record</small>
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
                                    <th>Mobile No.</th>
                                    <th>GST No.</th>
                                    <th>Drug Licence No.</th>
                                    <th>Details</th>
                                    <th>Email</th>
                                    <th>Blacklist</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @if(!empty($str))
                                    {!! $str !!}
                                @endif 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
      
</script>
@endsection