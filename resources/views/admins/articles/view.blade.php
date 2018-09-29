@extends('layouts.appAdmin')

@section('content')
<style>
    .custom-img {
       overflow:hidden;
       /* width: 100%; */
       max-height: 200px;
       /* object-fit: scale-down; */
       padding-top: 2%;
    }

    .custom-img img {
        height: auto;
        width: 100%;
    }
</style>
<div class="container-fluid">
    <div class="block-header">
        <h2>View Articles</h2>
    </div>

    <!-- Content top -->
   
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Latest Articles</h2>
                    <small>Articles present in record</small>
                    <p></p>
                    <form id="articleType-form" action="{{route('article.type.submit', ['admin' => 'admin'])}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <span>Select Type of Article:-</span>
                            <select class="form-control" name="articleType" id="articleType">
                                <option value="active" @if($articleType == 'active') selected @endif>Active</option>
                                <option value="disabled" @if($articleType == 'disabled') selected @endif>Disabled</option>
                                <option value="expired" @if($articleType == 'expired') selected @endif>Expired</option>
                            </select>
                        </div>  
                    </form>
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
                    @if($articlesCount == 0) 
                    <p class="lead text-center">No Articles To Show</p>
                    @endif
                    @if($articles->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos display" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Created On</th>
                                        <th>Description</th>
                                        <th>Detail</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($articles as $article)
                                            <tr>
                                                <td>{{$article->id}}</td>
                                                <td><img src="/storage/article_images/{{$article->articleImage}}" height="80" width="80"></td>
                                                <td>{{$article->title}}</td>
                                                <td>{{date('d/m/y', strtotime($article->created_at))}}</td>
                                                <td> {!! str_limit($article->description, 50, '...') !!} </td>
                                                <td> <a href="{{route('article.detail', ['admin' => 'admin', 'id' => $article->id])}}" class="btn btn-primary btn-sm">Detail</a></td>
                                                <td> <a href="{{route('article.edit', ['admin' => 'admin', 'id' => $article->id])}}" class="btn btn-success btn-sm">Edit</a></td>
                                                <td> <form action="{{route('article.delete.submit', ['admin' => 'admin', 'id' => $article->id])}}" class="form" method="POST">
                                                        @csrf 
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let articleType = document.querySelector('#articleType');
    articleType.addEventListener('change', function() {
        articleTypeForm = document.querySelector('#articleType-form');
        articleTypeForm.submit();
    });

    let customMsgSuccess = document.querySelector('#custom-message-success');
    if(customMsgSuccess != null) {
        setTimeout(() => {
            customMsgSuccess.remove();
        }, 3000);
    }
</script>
@endsection