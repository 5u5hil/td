@extends('admin.layouts.default')




@section('content')

<section class="content-header">
    <h1>
        Attribute Set
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.attribute.set.view') }}"><i class="fa fa-coffee"></i>Attribute Set</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    {!! Form::model($attrSets, ['method' => 'post', 'files'=> true, 'url' => $action , 'class' => 'form-horizontal' ]) !!}

                    <div class="form-group">
                        {!! Form::label('Attribute Set Name', 'Attribute Set Name',['class'=>'col-sm-2 control-label']) !!}
                        {!! Form::hidden('id',null) !!}
                        <div class="col-sm-10">
                            {!! Form::text('attr_set',null, ["class"=>'form-control' ,"placeholder"=>'Enter Attribute Set Name', "required"]) !!}
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


@stop

