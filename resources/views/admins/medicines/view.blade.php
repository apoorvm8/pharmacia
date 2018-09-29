@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>View Medicine</h2>
    </div>

    <!-- Medicine top -->
    
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Medicine List</h2>
                    <small>List of all medicine present in record</small>
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
                                    <th>Medicine Name</th>
                                    <th>Manufacturer</th>
                                    <th>Type</th>
                                    <th>Remark</th>
                                    <th>Content</th>
                                    <th>Cost</th>
                                    <th>Stock</th>
                                    <th>Details</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>1</td>
                                    <td>Crocin</td>
                                    <td>xyz pharmaceuticals</td>
                                    <td>Tablet</td>
                                    <td>Remark</td>
                                    <td>Content</td>
                                    <td>14</td>
                                    <td>50</td>
                                    <td>
                                        <a class="btn btn-primary waves-effect btn-sm" href="#">Details</a>
                                    </td>
                                    <td>
                                    <a class="btn btn-success btn-sm" href="{{route('medicine.edit', ['admin' => 'admin'])}}">Edit</a>
                                    </td>
                                </tr> --}}
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
        const element = document.querySelectorAll('.custom-active');
        element.forEach(function(customActiveClass) {
            console.log(customActiveClass.firstElementChild.firstElementChild.nextElementSibling.textContent);
            if(customActiveClass.firstElementChild.firstElementChild.nextElementSibling.textContent === "Medicine Category"){
                customActiveClass.classList.add('active');
            } else {
                customActiveClass.classList.remove('active');
            }
        });
</script>
@endsection