@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Medicine Details</h2>
    </div>


    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2 style='margin-bottom:0.8%;'>{{ strtoupper($medicine->medicineName)}} </h2>
                    <small>By {{ ucwords($medicine->manufacturer)}} <br> {{$medicine->remark}}</small>
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
                    <div class="card">
                        <div class="body bg-light">
                            <h2 style='font-size: 120%;'>Substitute Medicines</h2>
                            <small>Click the <b>Medicine Name</b> to go to that medicine page</small>
                            <hr>
                            @if($commonContentsCount == 0)
                            <p class="card-inside-title">No Substitute Medicines Present.</p>
                            @endif
                            @foreach($commonContents as $commonContent)
                                @if($commonContent->id !== $medicine->id)
                                <h2 class="card-inside-title"><a href="{{route('medicine.detail', ['id' => $commonContent->id, 'admin' => 'admin'])}}" style='color:black;'>{{ strtoupper($commonContent->medicineName)}}</a></h2>
                                    
                                    <small>By {{ $commonContent->manufacturer}} <br> {{$commonContent->remark}}</small>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="body bg-light">
                        <h2 style='font-size: 120%;'>Medicine Contents</h2>
                        <hr>
                        @foreach($results as $result)
                            <h2 class="card-inside-title">{{ucwords($result->contentName)}}</h2>
                            <hr>
                            <p><b>Uses</b></p>
                            <p>{!! $result->uses !!}</p>
                            <hr>
                            <p><b>How It Works</b></p>
                            <p>{!! ($result->howItWorks) !!}</p>
                            <hr>
                            <p><b>Side Effects</b></p>
                            <p>{!! $result->sideEffects !!}</p>
                            <hr><hr>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
    </div>
</div>
@endsection