@extends('admin.layouts.default')





@section('content')
<section class="content-header">
    <h1>
        Products
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Products</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">


                @if(!empty(Session::get('message')))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('message') }}
                </div>
                @endif

                <div class="box-header">
                    <h3 class="box-title">   <a href="{!! route('admin.products.add') !!}" class="btn btn-default pull-right" type="button">Add New Product</a> </h3>
                    <div class="box-tools">

                        <form method="get" action=" " id="searchForm">

                            <input type="hidden" name="productsCatalog">
                            <div class="form-group col-md-4">
                                <input type="text" value="{{ !empty(Input::get('product_name'))?Input::get('product_name'):'' }}" name="product_name" aria-controls="editable-sample" class="form-control medium" placeholder="Product Name">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" value="{{ !empty(Input::get('product_code'))?Input::get('product_code'):'' }}" name="product_code" aria-controls="editable-sample" class="form-control medium" placeholder="Product Code">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="submit" name="search" class="btn sbtn btn-block" value="Search">
                            </div>

                        </form>

                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Product</th>
                                <th>Product Code</th>
                                <th>Categories</th>
                                <th>Attribute Set</th>
                <!--                <th>Stock</th>-->
                                <th>Price range</th>
                                <th>Product Type</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr> <td>{{$product->id }}</td>
                                <td>{{$product->product }}</td>
                                <td>{{$product->product_code }}</td>
                                <td>
                                    <?php
                                    $cat = $product->categories;
                                    foreach ($cat as $category) {
                                        ?>
                            <li>  <a href="{!! route('admin.category.edit',['id'=>$category->id]) !!}" class="edit"> {!! $category->category  !!}</a> </li>

                            <?php
                        }
                        ?>



                        </td>
                        <td>{{ $product->attributeset['attr_set'] }}</td>
                <!--        <td>{{$product->stock }}</td>-->
                        <td>{{$product->price_range }}</td>
                        <td>{{ $product->producttype['type']  }}</td>
                        <td>
                            <a href="{!! route('admin.products.general.info',['id'=>$product->id]) !!}" target="_blank" class="label label-success active" ui-toggle-class="">Edit</a>
                            <a href="{!! route('admin.products.duplicate',['id'=>$product->id]) !!}" target="_blank" class="label label-info active" ui-toggle-class="" onclick="return confirm('Do you want to create duplicate product?')">Duplicate</a>
                            <a href="{!! route('admin.products.delete',['id'=>$product->id]) !!}" class="label label-danger active" ui-toggle-class="" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>

                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">

                    <?php
                    $args = [];
                    !empty(Input::get("product_name")) ? $args["product_name"] = Input::get("product_name") : '';

                    !empty(Input::get("product_code")) ? $args["product_code"] = Input::get("product_code") : '';
                    echo

                    $products->appends($args)->render();
                    ?>

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>



@stop



