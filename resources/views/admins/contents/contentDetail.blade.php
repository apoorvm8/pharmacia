@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Content Details</h2>
    </div>


    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Content- {{ ucwords($content->contentName)}} </h2>
                    <small>Below are the details of the content</small>
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
                    
                    <h2 class="card-inside-title">Uses</h2>
                    <p>{!! $content->uses !!}</p>
                    <hr>
                    <h2 class="card-inside-title">How It Works</h2>
                    <p>{!! $content->howItWorks !!}</p>
                    <hr>
                    <h2 class="card-inside-title">Side Effects</h2>
                    <p>{!! $content->sideEffects !!}</p>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
    </div>
</div>
@endsection