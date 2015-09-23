@extends('Frontend.layouts.default')

@section('content')
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">
            <div class="row clearfix">

                <h3>Billing Details</h3>

                @if(Session::get('user')->id)

                <div class="col_one_third" style="margin-bottom: 0px;">
                    <div class="table-responsive">
                        @foreach($add as $ad1)
                        <div class="<?php echo $a = $ad1->id; ?>">  
                            <input type="hidden" name="addressId" value="{{ $ad1->id }}">
                            <a href="{{ URL::route("checkout_info") }}?id={{$ad1->id}}">
                                {{ $ad1->address1 }} , {{ $ad1->address2 }}<br>
                                {{ $ad1->address3 }} <br>
                                {{ $ad1->city }} - {{ $ad1->pincode }}<br>
                                {{ $ad1->country }}<br>
                                Contact : {{ $ad1->phone }}<br>
                                <br></a>
                            
                            
                            
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col_two_third col_last">
                    <div><h3>To add/change the address : </h3></div>
                    <form id="billing-form" name="billing-form" class="nobottommargin" action="{{route('frontend.add_address')}}" method="post">
                       
                        
                        <div class="col_half">
                            <label for="billing-form-name">First Name:</label>
                            <input type="text" id="billing-form-name" id="userFirstName" name="cname" value="" class="sm-form-control" />
                        </div>

                        <div class="col_half col_last">
                            <label for="billing-form-lname">Last Name:</label>
                            <input type="text" id="billing-form-lname" id="userLastName" name="lname" value="" class="sm-form-control" />
                        </div>

                        <div class="col_half col_last">
                            <label for="billing-form-phone">Phone:</label>
                            <input type="text" id="userPhone" name="phone" value="" class="sm-form-control" />
                        </div>

                        <div class="clear"></div>

                        <div class="col_full">
                            <label for="billing-form-companyname">Address Line 1:</label>
                            <input type="text" id="userAddress1" name="address1" value="" class="sm-form-control" />
                        </div>

                        <div class="col_full">
                            <label for="billing-form-address">Address Line 2:</label>
                            <input type="text" id="userAddress2" name="address2" value="" class="sm-form-control" />
                        </div>
                        <div class="col_full">
                            <label for="billing-form-address">Address Line 3:</label>
                            <input type="text" id="userAddress3" name="address3" value="" class="sm-form-control" />
                        </div>

                        <div class="col_half">
                            <label for="billing-form-city">City / Town</label>
                            <input type="text" id="userCity" name="city" value="" class="sm-form-control" />
                        </div>

                        <div class="col_half col_last">
                            <label for="billing-form-city">Pincode</label>
                            <input type="text" id="userPincode" name="pincode" value="" class="sm-form-control" />
                        </div>

                        <div class="col_half col_last">
                            <label for="billing-form-country">Country</label>
                            <input type="text" id="userCountry" name="country" value="" class="sm-form-control" />
                        </div>

                        <div class="col_full">
                            <button class="button button-3d fright">Add New Address</button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

</section>
@stop