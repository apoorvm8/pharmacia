@extends('layouts.appAdmin')

@section('content')
<style>
    .custom-img {
        overflow:hidden;
        width: 40%;
        height: auto;
        /* object-fit: scale-down; */
        text-align: center;
    }

    .custom-img img {
        height: auto;
        width: 50%;
        min-width: 250px;
    }

    @media screen and (max-width: 778px) {
        .custom-img {
            overflow:hidden;
            width: 100%;
            height: auto;
            /* object-fit: scale-down; */
            text-align: center;
        }

        .custom-img img {
            height: auto;
            width: 50%;
            min-width: 250px;
        }
        
        .edit-button {
            padding-left: 8% !important;
            padding-right: 8% !important;
        }
    }
</style>
<div class="container-fluid">
    <div class="block-header">
        <h2>Article Details</h2>
    </div>


    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>{{ ucwords($article->title)}}</h2>
                    <small>Created On <b>{{date('d/m/y', strtotime($article->created_at))}}</b></small><br>
                    <label for="tags">Tags</label>
                    <input data-role="tagsinput" type="text" name="tags" id="tags" class="form-control" value="{{ $articleTagsString }}" disabled>
    
                    @include('inc.messages')
                    <form id='disable-form' action="{{route('article.disable.submit', ['admin' => 'admin', 'id' => $article->id])}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="switch">
                            Disable This Article
                            <label for="disable">
                                <input type="checkbox" name="disable" id="disable" 
                                @if(!$article->isDisabled) value="1" @else value="0" checked @endif>
                                <span class="lever"></span>
                            </label>
                        </div>
                    </form>
                    @if($article->expiresOn != null)
                    <p class="right text-danger m-r-10"><b>Expires On: {{date('d/m/y', strtotime($article->expiresOn))}}</b></p>
                    @endif
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
                    <div class="header">
                        <div class="custom-img">
                            <img src="/storage/article_images/{{$article->articleImage}}">
                        </div>
                    </div>
                    
                    <p>{!! $article->description !!}</p>
                    <hr>
                    <div class="text-center">
                    <a href="{{route('article.edit', ['admin' => 'admin', 'id' => $article->id])}}" class="edit-button btn btn-success m-r-10" style="padding-left:2%; padding-right:2%;">Edit</a> 
                    <form action="{{route('article.delete.submit', ['admin' => 'admin', 'id' => $article->id])}}" class="form m-l-10" style="display:inline;" method="POST">
                        @csrf 
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
    </div>
</div>
<script>
    let disable = document.querySelector('#disable');
    disable.addEventListener('change', function() {
        let form = document.querySelector('#disable-form');
        form.submit();
    });

    let customMsgSuccess = document.querySelector('#custom-message-success');
    if(customMsgSuccess != null) {
        setTimeout(() => {
            customMsgSuccess.remove();
        }, 3000);
    }
</script>
@endsection