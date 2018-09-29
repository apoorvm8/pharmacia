@extends('layouts.appAdmin')

@section('content')
<style>
        .form-group {
            padding: 1% 0.5%;
        }
    
        .form-group span {
            margin: 1% 0;
            font-weight: 100 !important;
        }
</style>
<div class="container-fluid">
       
        <div class="block-header">
            <h2>Add Medicine</h2>
        </div>
       

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Add Medicine</h2>
                        @include('inc.messages')
                        <small>Fill the form <b> completely </b>, below to add medicine to record</small>
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
                        <h2 class="card-inside-title">Medicine Details</h2>
                        <form id="add-form" action="{{route('medicine.add.submit', ['admin' => 'admin'])}}" class="form" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="form-line">
                                <input type="text" name="medicineName" id="medicineName" class="form-control"           placeholder="Enter Medicine" value="{{ old('medicineName') }}" autofocus>
                                </div>

                                @if ($errors->has('medicineName'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('medicineName') }}</b></small>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="manufacturer" id="manufacturer" class="form-control" placeholder="Enter Manufacturer" value="{{ old('manufacturer') }}">
                                </div>

                                @if ($errors->has('manufacturer'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('manufacturer') }}</b></small>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <span>Select the type below:-</span>
                                <select class="form-control" name="medicineType" id="medicineType">
                                    <option value="">Select a Type</option>
                                    <option value="tablet" {{ old('medicineType') == 'tablet' ? 'selected' : ''}}>Tablet</option>
                                    <option value="injection"  {{ old('medicineType') == 'injection' ? 'selected' : ''}}>Injection</option>
                                    <option value="syrup"  {{ old('medicineType') == 'syrup' ? 'selected' : ''}}>Syrup</option>
                                    <option value="bottle" {{ old('medicineType') == 'bottle' ? 'selected' : ''}}>Bottle</option>
                                    <option value="drop"  {{ old('medicineType') == 'drop' ? 'selected' : ''}}>Drop</option>
                                </select>

                                @if ($errors->has('medicineType'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('medicineType') }}</b></small>
                                    </span>
                                @endif
                            </div>  

                            <div class="form-group" id="remarkType">
                                <div class="form-line">
                                    <input type="text" name="remark" id="remark" class="form-control" placeholder="Enter details about type, like stip of 15 tablet, 15 ML drop, etc..." value="{{ old('remark') }}">
                                </div>

                                
                                @if ($errors->has('remark'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('remark') }}</b></small>
                                    </span>
                                @endif
                                {{-- <div class="form-line">
                                    <input type="number" name="remark" id="" class="form-control" placeholder="Enter Total  ML in Syrup">
                                </div> --}}
                            </div>                            
                            
                            <div class="form-group">
                                <span>Select the contents below:-</span>
                                <select class="form-control" name="medicineContent[]" multiple>
                                    <option value="">Select The Contents</option>
                                    @foreach($contents as $content)
                                    <option value="{{$content->id}}" {{ (collect(old('medicineContent'))->contains($content->id)) ? 'selected':'' }}>
                                            {{ucfirst($content->contentName)}}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('medicineContent'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('medicineContent') }}</b></small>
                                    </span>
                                @endif
                            </div>   
                            
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" name="cost" id="cost" class="form-control" placeholder="Enter Cost of One Strip, Syrup, etc..." value="{{ old('cost') }}">
                                </div>

                                @if ($errors->has('cost'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('cost') }}</b></small>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" name="stock" id="stock" class="form-control" placeholder="Enter Stock" value="{{ old('stock') }}">
                                </div>

                                @if ($errors->has('stock'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('stock') }}</b></small>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="discount" id="discount" class="form-control" placeholder="Enter Discount (%), eg: 10, 12.5 Don't write '%'" value="{{ old('discount') }}">
                                </div>

                                @if ($errors->has('discount'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('discount') }}</b></small>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success waves-effect" id='submitBtn'>Add Medicine</button>
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