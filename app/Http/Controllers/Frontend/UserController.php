<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Session;
use App\Models\Category;
use App\Models\SavedList;
use Input;
use Request;
use App\AuthenticateUser;
use Auth;
use App\Models\Address;
use App\Models\User;
use App\Models\Order;

class UserController extends Controller {

    public function login(AuthenticateUser $authenticateUser, Request $request, $provider = null) {
        if (is_null($provider)) {
            return view(Config('constants.frontView') . '.login');
        } else {
            return $authenticateUser->execute(Request::all(), $this, $provider);
        }
    }

    public function userHasLoggedIn($user) {
        Session::put('user', $user);
        return redirect()->to(Session::get('redirect'));
    }

    public function saveLater() {
        //dd(Session::get('user')->id);
        $savedList = new SavedList();
        if(!empty(Session::get('product_spec')))
        {            
            $savedList->product_spec = Session::get('product_spec');
            $savedList->user_id = Session::get('user')->id;
            
        }
        else
        {
            $savedList->product_spec = Input::get('product_spec');
            $savedList->user_id = Session::get('user')->id;
        }
        $savedList->save();
        return redirect()->back();
    }
    
    public function savedList() {
        $savedList = User::find(Session::get('user')->id)->savedList;
        //dd($savedList);
        return view('Frontend.pages.saved-list', compact('savedList'));
    }
    
    public function add_address(){
        
        $address = new Address();
           //dd(Session::get("userId"));
            $address->user_id = Session::get('user')->id;
            $address->firstname = Input::get('cname');
            $address->lastname = Input::get('lname');
            $address->phone = Input::get('phone');
            $address->address1 = Input::get('address1');
            $address->address2 = Input::get('address2');
            $address->address3 = Input::get('address3');
            $address->pincode = Input::get('pincode');
            $address->city = Input::get('city');
            $address->country = Input::get('country');
            
            
            $address->save();
            $addid =$address->id;
           // dd($addid);
       return redirect()->back();
    }
    
     public function new_address() {
        return view('frontend.pages.checkout');
    }
    
    public function my_orders() {
        $userDetails = User::find(Session::get('user')->id);

        $orders = Order::where('user_id', '=', Session::get('user')->id)
                ->where('order_status', '!=', 0)
                ->orderBy('id', 'desc')
                ->paginate(10);

        return view('Frontend.pages.thank-you', compact('userDetails', 'orders'));
    }

//    public function my_saved_list() {
//        $userDetails = User::find(Session::get('userId'));
//
//        $orders = Order::where('user_id', '=', Session::get('userId'))
//                ->where('is_save', '=', 1)
//                ->where('order_status', '!=', 0)
//                ->orderBy('id', 'desc')
//               // ->get();
//               ->paginate(10);
//        return View::make('frontend.pages.users.my_saved_list', compact('userDetails', 'orders'));
//    }

    public function order_details() {

        $id = Input::get('id');
        $orders = Order::find($id);
        $userDetails = User::find(Session::get('user')->id);

        return view('Frontend.pages.order_details', compact('orders', 'userDetails'));
    }
    
}
