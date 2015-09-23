@extends('admin.layouts.default')
@section('content')


<section class="content-header">
    <h1>
        Attributes
        <small>Add/Edit/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attributes</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">   <a href="{!! route('admin.attributes.add') !!}" class="btn btn-default pull-right" type="button">Add New Attribute</a> </h3>
                    
                     <div>
                            <p style="color: red;text-align: center;">{{ Session::get('message') }}</p>
                        </div>
                    <div class="box-tools">

                        <form method="get" action=" " id="searchForm">
                            <input type="hidden" name="attrSetCatalog">
                            <div class="input-group" style="width: 150px;">
                                <input type="text" value="{{ !empty(Input::get('attr_name'))?Input::get('attr_name'):'' }}" name="attr_name" aria-controls="editable-sample" class="form-control medium" placeholder="Search">



                            </div>

                        </form>

                       

                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                <!--                <th>id</th>-->

                                <th>Attribute name</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attrs as $attr)
                            <tr> 
                <!--                <td>{{$attr->id }}</td>-->
                                <td>{{$attr->attr }}</td>

                                <td>{{ date("d-M-Y",strtotime($attr->created_at)) }}</td>
                                <td>
                                    <a href="{!! route('admin.attributes.edit',['id'=>$attr->id]) !!}" class="label label-success active" ui-toggle-class="">Edit</a>
                                </td>

                                <td>
                                    <a href="{!! route('admin.attributes.delete',['id'=>$attr->id]) !!}"  class="label label-danger active" ui-toggle-class=""  onclick="return confirm('Are you sure you want to delete this?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">

                    <?php
                    $args = [];
                    !empty(Input::get("attr_name")) ? $args["attr_name"] = Input::get("attr_name") : '';
                    echo
                    $attrs->appends($args)->render();
                    ?>

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>




@stop

@section('myscripts')
<script>
    $(document).ready(function () {
        $(".delete").click(function () {
            var r = confirm("Are You Sure You want to Delete this Attribute?");
            if (r == true) {
                $(this).parent().submit();
            } else {

            }
        });
    });
</script>

@stop