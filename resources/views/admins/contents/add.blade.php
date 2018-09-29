@extends('layouts.appAdmin')

@section('content')
<style>
    .form-group {
        padding: 1% 0.5%;
    }

    .form-check>span {
        margin: 1% 0 !important;
        font-weight: 100 !important;
    }

    button {
        margin-top: 3%;
    }
</style>
<div class="container-fluid">
    <div class="block-header">
        <h2>Add Content</h2>
    </div>


    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Add Content</h2>
                    <small>Fill the form below to add content to record</small>
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
                    <h2 class="card-inside-title">Content Details</h2>
                    <form id='add-form' action="{{route('content.add.submit', ['admin' => 'admin'])}}" class="form" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="contentName" id="contentName" class="form-control" placeholder="Content Name" value="{{ old('contentName') }}" autofocus>
                            </div>

                            @if ($errors->has('contentName'))
                                <span class="help-block" style="color:red;" role="alert">
                                    <small><b>{{ $errors->first('contentName') }}</b></small>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <div class="form-line">
                                <label for="uses">Uses:-</label>
                                <textarea id="editor-uses" placeholder="Uses" name="uses" id="uses" class="form-control" value="{{ old('uses') }}"></textarea>
                            </div>
                            @if ($errors->has('uses'))
                                <span class="help-block" style="color:red;" role="alert">
                                    <small><b>{{ $errors->first('uses') }}</b></small>
                                </span>
                            @endif
                        </div>

                        <div class="form-group ">
                            <div class="form-line">
                                <label for="howItWorks">How It Works:-</label>
                                <textarea id="editor-howItWorks" placeholder="How it works" name="howItWorks" id="howItWorks" class="form-control" value="{{ old('howItWorks') }}"></textarea>
                            </div>

                            @if ($errors->has('howItWorks'))
                                <span class="help-block" style="color:red;" role="alert">
                                    <small><b>{{ $errors->first('howItWorks') }}</b></small>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <label for="sideEffects">Side Effects:-</label>
                                <textarea id="editor-sideEffects" placeholder="Side Effects" name="sideEffects" id="sideEffects" class="form-control" value="{{ old('sideEffects') }}"></textarea>
                            </div>

                            @if ($errors->has('sideEffects'))
                                <span class="help-block" style="color:red;" role="alert">
                                    <small><b>{{ $errors->first('sideEffects') }}</b></small>
                                </span>
                            @endif
                        </div>

                        <div class="form-check">
                            <span>Prescription Required:</span>
                            <input class="form-check-input" type="radio" name="prescription" id="yes" value="1">
                            <label class="form-check-label" for="yes">
                                Yes
                            </label>
                            
                            <input class="form-check-input" type="radio" name="prescription" id="no" value="0" checked>
                            <label class="form-check-label" for="no">
                                No
                            </label>

                            @if ($errors->has('prescription'))
                                <span class="help-block" style="color:red;" role="alert">
                                    <small><b>{{ $errors->first('prescription') }}</b></small>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success waves-effect" id='submitBtn'>Add Content</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
    </div>
</div>
<script>
        let add_form = document.querySelector('#add-form');
        let submitBtn = document.querySelector('#submitBtn');
        add_form.addEventListener('submit', function() {
            submitBtn.disabled = true;
        });
    </script>
@endsection