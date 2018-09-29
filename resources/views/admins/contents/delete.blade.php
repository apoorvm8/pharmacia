@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Delete Contents</h2>
    </div>

    <!-- Content top -->
   
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Contents List</h2>
                    <small>List of all contents present in record</small>
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
                                    <th>Content Name</th>
                                    <th>Uses</th>
                                    <th>How it Works</th>
                                    <th>Side Effects</th>
                                    <th>Prescription Required</th>
                                    <th>Detail</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>1</td>
                                    <td>Crocin</td>
                                    <td>For fever, cold and other common symptoms</td>
                                    <td>xyz how it works</td>
                                    <td>xyz side effects</td>
                                    <td>
                                        <a class="btn btn-primary waves-effect btn-sm" href="#">Detail</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger waves-effect btn-sm" href="">Delete</a>
                                    </td>
                                </tr>  --}}
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
@endsection