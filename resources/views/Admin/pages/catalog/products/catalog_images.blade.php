@extends('admin.layouts.default')
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
        {!! view('admin.includes.productHeader',['id' => $prod->id, 'prod_type' => $prod->prod_type]) !!}
      <div class="tab-content">
        <div class="tab-pan-active" id="activity">

            <div class="panel-body">
                {!! Form::model($images, ['method' => 'post', 'files' => true, 'url' => $action ,'id'=>'CataLogImg' ,'class' => 'form-horizontal','files'=>true ]) !!}
                {!! Form::hidden('id',null) !!}
                {!! Form::hidden('prod_id',$prod->id) !!}

                <p class="successDel" style="color:green;"></p>

                <div class="form-group">



                    <?php
                    $prodImages = $prod->catalogimgs()->where("image_type", "=", 1)->get();
                    //dd($prodImages);
                    ?>
                    <div class="col-sm-11 existingImg">
                        @if($prodImages->count()>0)
                        <?php $mode = 0; ?>
                        @foreach($prodImages as $prodimg)

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <img src="{{asset('public/admin/uploads/catalog/products/')."/".$prodimg->filename}}" class="img-responsive thumbnail"   >
                            </div>
                            <div class="col-sm-2">
                                <input  name="images[]" type="file" class="form-control filestyle" data-input="false" >
                            </div>

                            <div class="col-sm-2">
                                 {!! Form::select('image_mode[]',[""=>"Please Select","1" => "Product", "2" => "Layout","3"=>"Technical"],$prodimg->image_mode,["class"=>'form-control']) !!}
                             </div> 

                            <div class="col-sm-2">
                                {!! Form::text('sort_order[]',$prodimg->sort_order, ["class"=>'form-control' ,"placeholder"=>'Sort Order', "required"=>"true"]) !!}
                            </div>
                            <div class="col-sm-3">
                                {!! Form::text('alt_text[]',$prodimg->alt_text,["class"=>'form-control' ,"placeholder"=>'Alt Text', "required"=>"true"]) !!}
                            </div>
                            <div class="col-sm-1" style=" text-align: right;">
                                <a  data-value="{!! $prodimg->id !!}" href="javascript:void();" class="label label-danger active  DelImg" >Delete</a> 
                            </div>
                            {!! Form::hidden('id_img[]',$prodimg->id) !!}
                        </div>
                        <?php $mode++; ?>
                        @endforeach
                        @else

                        <div class="row form-group">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-2">
                                <input  name="images[]" type="file" class="form-control filestyle"  data-input="false">
                                 <!-- <input  name="images[]" type="file" class="form-control"  > -->
                            </div>
                           
                       

                          
                                                      <div class="col-sm-2">
                                                            {!! Form::select('image_mode[]',[""=>"Please Select","1" => "Product", "2" => "Layout","3"=>"Technical"],null,["class"=>'form-control']) !!}
                                                        </div>
                            <div class="col-sm-2">
                                {!! Form::text('sort_order[]',null, ["class"=>'form-control' ,"placeholder"=>'Sort Order', "required"=>"true"]) !!}
                            </div>
                               <div class="col-sm-3">
                                {!! Form::text('alt_text[]',null, ["class"=>'form-control' ,"placeholder"=>'Alt Text', "required"=>"true"]) !!}
                            </div>


                        </div>
                        @endif
                    </div>
                    <div class="col-sm-1">
                        {!! Form::hidden('id_img[]',null) !!}
                        <a href="javascript:void();" class="label label-success active addMoreImg" >Add More</a> 
                    </div>

                </div>
                <div class="form-group">
                    {!! Form::hidden('return_url',null,['class'=>'rtUrl']) !!}
                    <div class="form-group col-sm-12 ">
                        {!! Form::button('Save & Exit',["class" => "btn btn-primary pull-right saveImgExit"]) !!}
                        {!! Form::button('Save & Continue',["class" => "btn btn-primary pull-right saveImgContine"]) !!}
                        {!! Form::submit('Save & Next',["class" => "btn btn-primary pull-right"]) !!}
                    </div>


                    <div class="col-sm-4 col-sm-offset-2">

                        {!! Form::close() !!}     
                    </div>
                </div>

            </div>
        
            <div class="addNew" style="display: none;">
              
                <div class="row form-group">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-2">
                        <input  name="images[]" type="file" class="form-control filestyle" data-input="false">

                    </div>

                    <div class="col-sm-2">
                         {!! Form::select('image_mode[]',[""=>"Please Select","1" => "Product", "2" => "Layout","3"=>"Technical"],null,["class"=>'form-control']) !!}
                     </div>
              

                    <div class="col-sm-2">
                        {!! Form::text('sort_order[]',null, ["class"=>'form-control' ,"placeholder"=>'Sort Order', "required"=>"true"]) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::text('alt_text[]',null, ["class"=>'form-control' ,"placeholder"=>'Alt Text', "required"=>"true"]) !!}
                    </div><label>
                        <div class="col-sm-1">
                            {!! Form::hidden('id_img[]',null) !!}
                            <a href="javascript:void();" class="label label-danger active deleteImg">Delete</a> 
                        </div>
                </div> 
            </div>
            
            
            
        </div>
    </div>
</div>
@stop 

@section('myscripts')

<script>

        $(".saveImgExit").click(function() {

            $(".rtUrl").val("{!!route('admin.products.view')!!}");
            $("#CataLogImg").submit();

        });

        $(".saveImgContine").click(function() {
            $(".rtUrl").val("{!!route('admin.products.images',['id'=>Input::get('id')])!!}");
            $("#CataLogImg").submit();

        });

        $(".addMoreImg").click(function() {
   
       
            
            $(".existingImg").append($(".addNew").html());
            
            
        });

        $("body").on("click", ".deleteImg", function() {
            
         //   alert("sdfsdf");
            $(this).parent().parent().parent().remove();
        });

        $("body").on("click", ".DelImg", function() {
            var imgId = $(this).attr("data-value");
            var chk = confirm("Are you sure want to delete this image?");
            if (chk == true) {
                // alert($(this).attr("data-value"));
                $.ajax({
                    type: "POST",
                    url: "{!! route('admin.products.images.delete') !!}",
                    catch : false,
                    data: {imgId: imgId},
                    success: function(data) {
                        $(".successDel").text(data);
                        location.reload();

                    }
                });
            }


        });




</script>
@stop