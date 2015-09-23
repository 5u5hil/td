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



                <div class="search-box-header">

                    <div class="row">

                        <div class="col-sm-12" style="border-right:1px solid #ccc;">

                            <form method="get" action=" " id="searchForm">

                                <div class="btn-group pull-left col-md-12">

                                    <input type="hidden" name="productsRel">

                                    <div class="form-group col-md-4">

                                        <input type="text" value="{{ !empty(Input::get('product_name'))?Input::get('product_name'):'' }}" name="product_name" aria-controls="editable-sample" class="form-control medium" placeholder="Product Name">

                                    </div>

                                    <div class="form-group col-md-4">

                                        <input type="text" value="{{ !empty(Input::get('product_code'))?Input::get('product_code'):'' }}" name="product_code" aria-controls="editable-sample" class="form-control medium" placeholder="Product Code">

                                    </div>


                                    <div class="form-group col-md-4">

                                        <input type="submit" name="search" class="btn sbtn btn-block" value="Search">

                                    </div>




                                </div>

                            </form>



                        </div>



                    </div>






                    <div class="table-responsive">
                        {!! Form::model($prod,['method' => 'post','id'=>'RelUpProd' ,'files' =>true , 'url' => $action , 'class' => 'bucket-form' ]) !!}

                        <?php
                        $related_prods = $prod->relatedproducts->toArray();
                        $upsell_prods = $prod->upsellproducts->toArray();
                        ?>
                        {!! Form::label('upsell_prods', 'Related Products') !!}
                        <table class="table relatedProds table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Product</th>
                                    <th>Product Code</th>
                                    <th>Short Description</th>
    <!--                                <th>Product Type</th>-->
    <!--                                <th>Categories</th>-->


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prods as $prd)

                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label class="i-checks i-checks-sm">
                                                <input type="checkbox" name="related_prods[]" value="{!! $prd->id !!}" {!! App\Library\Helper::searchForKey("id",$prd->id,$related_prods) ? "checked" : "" !!} />
                                                       <i></i></label></div>


                                    </td>


                                    <td>{!! $prd->product !!}</td>
                                    <td>{!! $prd->product_code !!}</td>
                                    <td>{!! $prd->short_desc !!}</td>
    <!--                                <td>
                                    <?php $prod_type = $prd->producttype->toArray(); ?>
                                        {!! $prod_type['type'] !!}
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($prd->categories as $cat)
                                            <li>
                                                <a href="{!! route('admin.category.edit',['id'=>$cat->id]) !!}" class="edit"> {!! $cat->category  !!}</a>
    
                                            </li>
                                            @endforeach  
    
                                        </ul>                                
                                    </td>-->


                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {!! Form::label('upsell_prods', 'Select Upsell Products') !!}
                        <table class="table upsellProds table-striped b-t b-light">
                            <thead>
                                <tr>

                                    <th>Select</th>
                                    <th>Product</th>
                                    <th>Product Code</th>
                                    <th>Short Description</th>
    <!--                                <th>Select</th>
                                    <th>Product</th>
                                    <th>Short Description</th>
                                    <th>Product Type</th>
                                    <th>Categories</th>
                                    <th>Availability</th>
                                    <th>Stock</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prods as $prd)

                                <tr>
                                    <td> <div class="checkbox">
                                            <label class="i-checks i-checks-sm">
                                                <input type="checkbox" name="upsell_prods[]" value="{!! $prd->id !!}" {!! App\Library\Helper::searchForKey("id",$prd->id,$upsell_prods) ? "checked" : "" !!}  />
                                                       <i></i></label></div>
                                    </td>
                                    <td>{!! $prd->product !!}</td>
                                    <td>{!! $prd->product_code !!}</td>
                                    <td>{!! $prd->short_desc !!}</td>
    <!--                                <td>
                                    <?php $prod_type = $prd->producttype->toArray(); ?>
                                        {!! $prod_type['type'] !!}
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($prd->categories as $cat)
                                            <li>
                                                <a href="{!! route('admin.category.edit',['id'=>$cat->id]) !!}" class="edit"> {!! $cat->category  !!}</a>
    
                                            </li>
                                            @endforeach  
    
                                        </ul>                                
                                    </td>
                                    <td>{!! $prd->is_avail == 0 ? "Out of Stock" : "In Stock" !!}</td>
                                    <td>{!! $prd->stock !!}</td>-->
                                </tr>
                                @endforeach

                            </tbody>
                        </table>


                    </div>

                    <footer class="panel-footer">

                        <div class="row">

                            <div class=" text-right text-center-xs pull-right">   

                                <?php
                                $args = [];

                                !empty(Input::get("product_name")) ? $args["product_name"] = Input::get("product_name") : '';

                                echo

                                $prods->appends($args)->render();
                                ?>


                            </div>

                        </div>

                    </footer> 




                    {!! Form::hidden('prod_id',$prod->id) !!}

                    {!! Form::hidden('return_url',null,['class'=>'rtUrl']) !!}
                    <div class="form-group col-sm-12 ">
                        {!! Form::button('Save & Exit',["class" => "btn btn-primary pull-right saveRelUpExit"]) !!}
                        {!! Form::button('Save & Continue',["class" => "btn btn-primary pull-right saveRelUpContine"]) !!}
                        {!! Form::submit('Save & Next',["class" => "btn btn-primary pull-right"]) !!}
                    </div>


                    {!! Form::close() !!}





                </div>




            </div>

        </div>
    </div>
</div>


@stop
@section('myscripts')
<script>
    


        $(".saveRelUpExit").click(function() {

            $(".rtUrl").val("{!! route('admin.products.view')!!}");
            $("#RelUpProd").submit();

        });

        $(".saveRelUpContine").click(function() {
            $(".rtUrl").val("{!! route('admin.products.upsell.related',['id'=>$prod->id])!!}");
            $("#RelUpProd").submit();

        });


        $(".relatedProds input[type='checkbox']").click(function() {
            if ($(this).prop("checked")) {
              //  alert($(this).val());
                sync("{{ $prod->id }}", $(this).val(), "{{ URL::route('admin.products.related.attach') }}");
            } else {
                sync("{{ $prod->id }}", $(this).val(), "{{ URL::route('admin.products.related.detach') }}");
            }
        });

        $(".upsellProds input[type='checkbox']").click(function() {
            if ($(this).prop("checked")) {
                sync("{{ $prod->id }}", $(this).val(), "{{ URL::route('admin.products.upsell.attach') }}");
            } else {
                sync("{{ $prod->id }}", $(this).val(), "{{ URL::route('admin.products.upsell.detach') }}");
            }
        });

  

    function sync(id, prod_id, action) {
        $("input[type='submit']").prop("diabled", true);
        $.ajax({
            url: action,
            type: "POST",
            data: {id: id, prod_id: prod_id},
            sucess: function(data) {
                console.log(data);
                $("input[type='submit']").prop("diabled", false);
            }
        });
    }

</script>
@stop
