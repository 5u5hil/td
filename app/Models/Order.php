<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Order extends Model {

//    use UserTrait,
//        RemindableTrait;

    protected $table = 'orders';
    protected $fillable = ["payment_status","del_boy", "payment_method", "transaction_id", "description", "order_comment", "order_payment_status", "order_status"];

    public function products() {
        return $this->belongsToMany('App\Models\Product', 'has_products', 'order_id', 'prod_id')->withPivot("id","uprice", "sub_prod_id", "qty","qty_returned","price_saved", "price", "created_at");
    }

    public function hasproduct() {
        return $this->belongsToMany('App\Models\Order', 'has_products', 'order_id', 'id');
    }

    public function users() {

        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function paymentmethod() {
        return $this->belongsTo('App\Models\PaymentMethod', 'payment_method');
    }

    public function paymentstatus() {
        return $this->belongsTo('App\Models\PaymentStatus', 'payment_status');
    }

    public function orderstatus() {
        return $this->belongsTo('App\Models\OrderStatus', 'order_status');
    }

//    public function coupon() {
//
//        return $this->belongsTo('App\Models\Coupon', 'coupon_used');
//    }
//
//    public function voucher() {
//
//        return $this->belongsTo('App\Models\Coupon', 'voucher_used');
//    }

}
