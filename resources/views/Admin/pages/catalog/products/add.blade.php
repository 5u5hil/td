@extends('admin.layouts.default')
@section('content')


<section class="content-header">
    <h1>
        Add New Product

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-coffee"></i>Add New Product</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    {!! Form::open(['method' => 'post', 'files'=> true, 'url' => $action , 'class' => 'form-horizontal' ]) !!}
                    {!! Form::hidden('id',null) !!}
                    {!! Form::hidden('is_individual','1')  !!}
                    {!! Form::hidden('is_avail', '1') !!}
                    <div class="form-group">
                        {!! Form::label('Product Name', 'Product Name',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('product',null, ["class"=>'form-control' ,"placeholder"=>'Enter Product Name', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!! Form::label('Product Type', 'Product Type',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('prod_type',$prod_types,null,["class"=>'form-control'],"required") !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>


                    <div class="form-group">
                        {!! Form::label('Attribute Set', 'Attribute Set',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('attr_set',$attr_sets,null,["class"=>'form-control'],"required") !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

              

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">

                          
                            {!! Form::submit('Submit',["class" => "btn btn-primary"]) !!}
                            {!! Form::close() !!}     


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>




@stop 

@section('myscripts')

<script>
    $(document).ready(function() {


    });
</script>
@stop