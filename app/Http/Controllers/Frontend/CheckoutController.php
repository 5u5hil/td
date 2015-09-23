<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Session;
use App\Models\Category;
use App\Models\Attribute;
use Auth;
use Input;
use App\Models\User;
use App\Models\Address;

class CheckoutController extends Controller {

    public function index() {
        // echo Session::get('user')->id;

        $addressid = User::find(Session::get('user')->id)->addresses()->first();

        if ($addressid == null) {
            return view('Frontend.pages.new-address');
        } else {
            $address = Address::find($addressid->id);

            $add = Address::where("user_id", "=", Session::get('user')->id)->get();
            //  dd ($address);

            return view('Frontend.pages.checkout', compact('address', 'add'));
        }
    }
    
    public function checkout_details() {

        $addressid = User::find(Session::get('user')->id)->addresses()->first();

        $address = Address::find($addressid->id);

        //$addressId = Input::get($add->id);
        //dd($address);
        // $a = Session::push("addId", $address->id);
        // dd($a);
        $add1 = Address::where("id", "=", Input::get('id'))->first();
        //  dd($add1);
        Session::put("addressId", $add1->id);

        return view('frontend.pages.checkout-details', compact('add1'));
    }

    public function secure() {

        $user = User::find(Session::get('user')->id);
        $user->firstname = Input::get('cname');
        $user->lastname = Input::get('lname');
        $user->phone = Input::get('phone');


        if ($user->Update()) {

            $address = Address::find($user->addresses()->first()->id);

            $address->user_id = $user->id;
            $address->firstname = Input::get('cname');
            $address->lastname = Input::get('lname');
            $address->address1 = Input::get('address1');
            $address->address2 = Input::get('address2');
            $address->address3 = Input::get('address3');
            $address->pincode = Input::get('pincode');
            $address->city = Input::get('city');
            $address->country = Input::get('country');

            $address->Update();
            //  return view('frontend.pages.checkout-details', compact('address'));
        }

        return redirect()->route('checkout_info');
    }
    
     public function thank_you() {
          return view('frontend.pages.thank-you');
     }

}

?>