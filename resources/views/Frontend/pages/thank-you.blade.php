@extends('Frontend.layouts.default')

@section('content')

<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">
            <div class="row clearfix">

                <h3>Billing Details</h3>


                <div class="postcontent nobottommargin col_last">

                    <div class="table-responsive clearfix">
                        <h4 style="border: 1px solid #ccc; background: #F3F3F3; padding: 8px 8px 8px 15px;;">Your Orders</h4>

                        <table class="table cart">
                            <thead>
                                <tr>
                                    <!--<th class="cart-product-thumbnail">&nbsp;</th>-->

                                    <th class="cart-product-quantity">Order ID</th>

                                    <th class="cart-product-subtotal">Date</th>
                                    <th class="cart-product-subtotal">Quantity</th>
                                    <th class="cart-product-subtotal">Total</th>

                                    <th class="cart-product-subtotal">&nbsp;</th>
                                </tr>
                            </thead>
                            @foreach($orders as $order)
                            <tbody>
                                <tr class="cart_item">
                                    <td class="cart-product-subtotal">
                                        <span class="amount">{{ $order->id }}</span>
                                    </td>

                                    <td class="cart-product-subtotal">
                                        <span class="amount">{{ date('d-M-Y',strtotime($order->created_at)) }}</span>
                                    </td>
                                    <td class="cart-product-subtotal">
                                        <span class="amount">Rs. {{$order->order_amt}}</span>
                                    </td>
                                    <td class="cart-product-subtotal">
                                        <a href="{{ URL::route('order_details') }}?id={{$order->id}}" style="text-decoration: none;"><button class="button button-3d button-black nomargin" id="register-form-submit" name="" value="">View Details</button></a>
                                    </td>

                                </tr>

                            </tbody>
                            @endforeach
                        </table>

                    </div>

                </div><!-- .postcontent end -->

            </div>
        </div>
    </div>

</section>
@stop