@extends('admin.layouts.default')


@section('content')

<section class="content-header">
    <h1>
        Attribute 
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.attributes.view') }}"><i class="fa fa-coffee"></i>Attribute</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>




<section class="content">   
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    {!! Form::model($attrs, ['method' => 'post', 'files'=> true, 'url' => $action , 'class' => 'form-horizontal' ]) !!}

                    {!! Form::hidden('id',null) !!}
                    <div class="form-group">
                        <?php $attr_Sets = $attrs->attributesets->toArray(); ?>
                        {!! Form::label('Attribute Sets', 'Attribute Sets',['class'=>'col-sm-2 control-label']) !!}

                        <div class="col-sm-10">
                            @foreach($attrSets as $attrS)
                            {!! Form::checkbox('attr_set[]',$attrS['id'] , App\Library\Helper::searchForKey("id",$attrS['id'],$attr_Sets)?$attrS['id']: "" ) !!}
                            {!! $attrS['attr_set'] !!}
                            @endforeach
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!! Form::label('Attribute type', 'Attribute Type',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            @foreach($attr_types as $attr_type)

                            <input type="radio"  name="attr_type" value=" {!! $attr_type->id !!}"  {!! isset($attrs->attr_type)?"checked":"" !!} /> {!! $attr_type->attr_type !!}

                        </div>
                        @endforeach
                    </div>


                    <div class="form-group">

                        {!! Form::label('is_filterable', 'Is Filterable',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('is_filterable',["0" => "No", "1" => "Yes"],null,["class"=>'form-control'],"required") !!}
                        </div>
                    </div>


                    <div class="form-group">
                        {!! Form::label('Attribute Name', 'Attribute Name',['class'=>'col-sm-2 control-label']) !!}

                        <div class="col-sm-10">
                            {!! Form::text('attr',null, ["class"=>'form-control' ,"placeholder"=>'Enter Attribute Name', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!! Form::label('Attribute Options', 'Attribute Options',['class'=>'col-sm-2 control-label']) !!}

                        <div class="col-sm-9 col-md-9  attrOptn">

                            @if($attrs->attributeoptions()->count() > 0 )
                            @foreach($attrs->attributeoptions as $opt)

                            <div class="row form-group">
                                <div class="col-sm-3">
                                    {!! Form::text('option_name[]',$opt->option_name, ["class"=>'form-control' ,"placeholder"=>'Enter Option Name', "required"]) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::text('option_value[]',$opt->option_value, ["class"=>'form-control' ,"placeholder"=>'Enter Option Value', "required"]) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::select('is_active[]',["0" => "No", "1" => "Yes"],$opt->is_active,["class"=>'form-control'],"required") !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::text('sort_order[]',$opt->sort_order, ["class"=>'form-control' ,"placeholder"=>'Enter Sort Order', "required"]) !!}
                                </div>

                                {!! Form::hidden('idd[]',$opt->id) !!}

                            </div>
                            @endforeach
                            @else
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    {!! Form::text('option_name[]',null, ["class"=>'form-control' ,"placeholder"=>'Enter Option Name', "required"]) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::text('option_value[]',null, ["class"=>'form-control' ,"placeholder"=>'Enter Option Value', "required"]) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::select('is_active[]',["0" => "No", "1" => "Yes"],null,["class"=>'form-control'],"required") !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::text('sort_order[]',null, ["class"=>'form-control' ,"placeholder"=>'Enter Sort Order', "required"]) !!}
                                </div>

                            </div>
                            @endif
                        </div>

                        <div class="col-sm-1">
                            {!! Form::hidden('idd[]',null) !!}
                            <a href="javascript:void()" class="label label-success active addMore">Add More</a> 
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            {!! Form::submit('Submit',["class" => "btn btn-primary pull-right"]) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="toClone" style="display: none;">
    <div class="row form-group">
        <div class="col-sm-3">
            {!! Form::text('option_name[]',null, ["class"=>'form-control' ,"placeholder"=>'Enter Option Name', "required"]) !!}
        </div>
        <div class="col-sm-3">
            {!! Form::text('option_value[]',null, ["class"=>'form-control' ,"placeholder"=>'Enter Option Value', "required"]) !!}
        </div>
        <div class="col-sm-3">
            {!! Form::select('is_active[]',["0" => "No", "1" => "Yes"],null,["class"=>'form-control'],"required") !!}
        </div>
        <div class="col-sm-2">
            {!! Form::text('sort_order[]',null, ["class"=>'form-control' ,"placeholder"=>'Enter Sort Order', "required"]) !!}
        </div>
        <div class="col-sm-1">
            {!! Form::hidden('idd[]',null) !!}
            <a href="javascript:void();" class="label label-danger active deleteOpt" >Delete</a> 
        </div>
    </div>
</div>

@stop

@section('myscripts')

<script>

    $(".addMore").click(function() {


        $(".attrOptn").append($("#toClone").html());
    });


    $("body").on("click", ".deleteOpt", function() {
        $(this).parent().parent().remove();
    });

//    $(document).ready(function() {
//        //console.log("sdf");
//        
//        alert("asdf");
//
//
//    });
</script>
@stop