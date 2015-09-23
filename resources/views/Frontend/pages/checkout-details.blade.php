@extends('Frontend.layouts.default')
@section('content')
<!-- Page Title
============================================= -->
<section id="page-title" class="page-title-mini">

    <div class="container clearfix">
        <h1>Cart</h1>

        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Checkout</li>
        </ol>
    </div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

 <form id="details-form" name="details-form" class="nobottommargin" action="{{route('frontend.thank-you')}}" method="post">
            <div class="col_two_third" style="margin-bottom: 0px;">
                <div class="table-responsive">
                    @if(Session::get('user')->id)

                    <table class="table table-bordered nobottommargin">
                        <tbody>
                            <tr>
                                <td>First Name:</td>
                                <td>{{$add1->firstname}}</td>
                            </tr>
                            <tr>
                                <td>Last Name:</td>
                                <td>{{$add1->lastname}}</td>
                            </tr>
                            <tr>
                                <td>Shipping Address 1:</td>
                                <td>{{$add1->address1}}</td>
                            </tr>
                            <tr>
                                <td>Shipping Address 2:</td>
                                <td>{{$add1->address2}}</td>
                            </tr>
                            <tr>
                                <td>Shipping Address 3:</td>
                                <td>{{$add1->address3}}</td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td>{{$add1->city}}</td>
                            </tr>
                            <tr>
                                <td>Pincode:</td>
                                <td>{{$add1->pincode}}</td>
                            </tr>
                            <tr>
                                <td>Country:</td>
                                <td>{{$add1->country}}</td>
                            </tr>
                            <tr>
                                <td>Mobile No:</td>
                                <td>{{$add1->phone}}</td>
                            </tr>
                        </tbody>
                    </table>

                    @endif
                    <div class="clearfix"></div>

                </div>

            </div>

            <div class="col_full">
                <button class="button button-3d fright">Submit</button>
            </div>

        </div>


    </div>

</section><!-- #content end -->


@stop