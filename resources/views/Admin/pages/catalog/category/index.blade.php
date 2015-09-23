@extends('admin.layouts.default')
@section('content')


<section class="content-header">
    <h1>
        Categories
        <small>Add/Edit/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Categories</li>
    </ol>
</section>

<section class="content">
    <div class="row">
               <div>
            <p style="color: red;text-align: center;">{{ Session::get('messege') }}</p>
        </div>
        
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">   <a href="{!! route('admin.category.add') !!}" class="btn btn-default pull-right" type="button">Add New Category</a> </h3>
                    <div class="box-tools">
                        <form method="get" action=" " id="searchForm">
                            <div class="input-group" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>

                            </div>   
                        </form>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Cat Id</th>
                                <th>Category</th>
                                <th>Short Desc</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr> 
                                <td>{{$category->id }}</td>
                                <td>{{$category->category }}</td>
                                <td>{{$category->short_desc }}</td>
                                <td>
                                    <a href="{!! route('admin.category.edit',['id'=>$category->id]) !!}" class="label label-success active" ui-toggle-class="">Edit</a>
                                </td>
                                
                                   <td>
                                    <a href="{!! route('admin.category.delete',['id'=>$category->id]) !!}"  onclick="return confirm('Are you sure you want to delete this category?')" class="label label-danger active" ui-toggle-class="">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php
                    $args = [];
                    !empty(Input::get("category_name")) ? $args["category_name"] = Input::get("category_name") : '';
                    echo
                    $categories->appends($args)->render();
                    ?>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>
@stop 