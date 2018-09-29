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
            <h2>Add Article</h2>
        </div>
       

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        @if($errors->count() > 0)
                            <p class="text-danger text-center bg-red"><b>Please check your fields and try again</b></p>
                        @endif
                        <h2>Add Article</h2>
                        @include('inc.messages')
                        <small>Fill the form <b> completely </b>, below to create article</small>
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
                        <h2 class="card-inside-title">Artcile Details</h2>
                        {{-- <form class="form" enctype="multipart/form-data"> --}}
                        <form id="add-article" action="{{route('article.add.submit', ['admin' => 'admin'])}}" class="form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-line">
                                <label for="title">Article Title</label>
                                <input type="text" name="title" id="title" class="form-control"           placeholder="Enter Title" value="{{ old('title') }}" autofocus>
                                </div>

                                {{-- @if ($errors->has('title'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('title') }}</b></small>
                                    </span>
                                @endif --}}
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                <label for="tags">Article Tags</label><br>
                                <input data-role="tagsinput" type="text" name="tags" id="tags" class="form-control"           placeholder="Enter Tags" value="{{ old('tags') }}">
                                </div>

                                {{-- @if ($errors->has('title'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('title') }}</b></small>
                                    </span>
                                @endif --}}
                            </div>
                            
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="editor-description">Article Description</label>
                                    <textarea id='editor-description' name="description" class="form-control">
                                            {!! old('description') !!}
                                    </textarea>
                                </div>
    
                                {{-- @if ($errors->has('description'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('description') }}</b></small>
                                    </span>
                                @endif --}}
                            </div>
                           
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="articleImage">Article Image (Optional)</label>
                                    <input type="file" name="articleImage">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <label for="expiresOn">Expires On (Optional)</label>
                                    <input type="date" name="expiresOn" id="expiresOn" placeholder="Expires On" class="form-control" value="{{old('expiresOn')}}">
                                </div>

                                {{-- @if ($errors->has('expiresOn'))
                                    <span class="help-block" style="color:red;" role="alert">
                                        <small><b>{{ $errors->first('expiresOn') }}
                                    </span>
                                @endif --}}
                            </div>
                         
                            <button type="submit" class="btn btn-success waves-effect" id='submitBtn'>Add Article</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
    <script>
        let add_form = document.querySelector('#add-article');
        let submitBtn = document.querySelector('#submitBtn');
        add_form.addEventListener('submit', function() {
            submitBtn.disabled = true;
        });
    </script>
@endsection