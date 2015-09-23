@extends('admin.layouts.default')

@section('mystyles')

<link rel="stylesheet" href="{{ asset('public/Admin/dist/css/jquery.tagit.css') }}">

<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">


@stop

@section('content')
<section class="content-header">
    <h1>
        Products

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.products.view') }}"><i class="fa fa-coffee"></i>Products</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>



<div class="nav-tabs-custom"> 
    <p style="color:red;text-align: center;"><b>{{ Session::get("ProductCode") }}</b></p>
    {!! view('admin.includes.productHeader',['id' => $prod->id, 'prod_type' => $prod->prod_type]) !!}


    <div class="tab-content">
        <div class="tab-pan-active" id="activity">
            <div class="panel-body">
                {!! Form::model($prod, ['method' => 'post', 'files'=> true, 'url' => $action ,'id'=>'EditGeneralInfo' ,'class' => 'form-horizontal' ]) !!}
                {!! Form::hidden('id',null) !!}
                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('product', 'Product Name',['class'=>'control-label']) !!}
                        {!! Form::text('product',null, ["class"=>'form-control' ,"placeholder"=>'Enter Product Name', "required"]) !!}
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('product code', 'Product Code',['class'=>'control-label']) !!}
                        {!! Form::text('product_code',null, ["class"=>'form-control ProdC' ,"placeholder"=>'Enter Product Code', "required"]) !!}

                        <p style="color: red;" class="errorPrdCode"></p>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('is_avail', 'Product Available?',['class'=>'control-label']) !!}
                        {!! Form::select('is_avail',["0" => "No", "1" => "Yes"],null,["class"=>'form-control']) !!}
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('Stock', 'Stock',['class'=>'control-label']) !!}
                        {!! Form::text('stock',null,["class"=>'form-control',"placeholder"=>"Stock","required"]) !!}
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('Price', 'Price',['class'=>'control-label']) !!}
                        {!! Form::text('price',null,["class"=>'form-control',"placeholder"=>"Max Price","required"]) !!}
                    </div>
                </div>



                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('Unit of Measure', 'Unit of Measure',['class'=>'control-label']) !!}
                        {!! Form::text('unit_measure',null,["class"=>'form-control',"placeholder"=>"UOM","required"]) !!}
                    </div>
                </div>





                <div class="line line-dashed b-b line-lg pull-in"></div>


                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('short_desc', 'Product Description',['class'=>'control-label']) !!}
                        {!! Form::textarea('short_desc',null,["class"=>'form-control',"placeholder"=>"Enter Description", "rows" => "4"]) !!}
                    </div>
                </div>


                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('long_desc', 'Other Details',['class'=>'control-label']) !!}
                        {!! Form::textarea('long_desc',null,["class"=>'form-control',"placeholder"=>"Enter Details", "rows" => "4"]) !!}
                    </div>
                </div>


                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('Additional Details', 'Remarks',['class'=>'control-label']) !!}
                        {!! Form::textarea('add_desc',null,["class"=>'form-control',"placeholder"=>"Remarks", "rows" => "4"]) !!}
                    </div>
                </div>
                <div class="line line-dashed b-b line-lg pull-in"></div>

                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('url_key', 'URL Key',['class'=>'control-label']) !!}
                        {!! Form::text('url_key',null,["class"=>'form-control',"placeholder"=>"Enter URL Key"]) !!}
                    </div>
                </div>


                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('Sort Order', 'Sort Order',['class'=>'control-label']) !!}
                        {!! Form::text('sort_order',null, ["class"=>'form-control' ,"placeholder"=>'Sort Order']) !!}
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('Currency', 'Currency',['class'=>'control-label']) !!}
                        {!! Form::text('cur',null,["class"=>'form-control']) !!}
                    </div>
                </div>


                <div class="line line-dashed b-b line-lg pull-in"></div>

                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('meta_title', 'Meta Title',['class'=>'control-label']) !!}
                        {!! Form::text('meta_title',null, ["class"=>'form-control' ,"placeholder"=>'Enter Meta Title']) !!}
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('meta_keys', 'Meta Keywords',['class'=>'control-label']) !!}
                        {!! Form::text('meta_keys',null,["class"=>'form-control',"placeholder"=>"Enter Meta Keywords"]) !!}
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <div class="col-md-12">
                        {!! Form::label('meta_desc', 'Meta Description',['class'=>'control-label']) !!}
                        {!! Form::text('meta_desc',null,["class"=>'form-control',"placeholder"=>"Enter Meta Keywords"]) !!}
                    </div>
                </div>
                <div class="line line-dashed b-b line-lg pull-in"></div>
                <div class="form-group col-md-12">  
                    <div class="col-md-12">
                        {!! Form::label('product_tags', 'Product Tags') !!}
                        <ul id="myTags">
                        @foreach($prod->tagNames() as $tag)
                        <li>{{ $tag }}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>

                {!! Form::hidden('return_url',null,['class'=>'rtUrl']) !!}

                <div class="line line-dashed b-b line-lg pull-in"></div>

                <div class="form-group col-sm-12 ">
                    {!! Form::button('Save & Exit',["class" => "btn btn-primary pull-right saveExit"]) !!}
                    {!! Form::button('Save & Continue',["class" => "btn btn-primary pull-right saveContine"]) !!}
                    {!! Form::submit('Save & Next',["class" => "btn btn-primary pull-right"]) !!}
                </div>
                {!! Form::close() !!}     
            </div>
        </div>
    </div>
</div>


@stop 

@section('myscripts')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('public/Admin/dist/js/tag-it.min.js') }}"></script>
<script>

    $(".saveContine").click(function() {
        //     alert($(".prodC").val());

        // if($(".prodC").val() !=""){
        $(".rtUrl").val("{!!route('admin.products.general.info',['id'=>Input::get('id')])!!}");
        $("#EditGeneralInfo").submit();
        //   }else{
        //   alert("szdf");
        //   $(".errorPrdCode").text("Please enter product code.");

        //  }

    });
    $(".saveExit").click(function() {
        $(".rtUrl").val("{!!route('admin.products.view')!!}");
        $("#EditGeneralInfo").submit();

    });

 

    $("#myTags").tagit({
        caseSensitive: false,
        singleField: true,
        singleFieldDelimiter: ","
    });

</script>
@stop