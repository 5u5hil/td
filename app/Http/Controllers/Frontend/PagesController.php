<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Session;
use App\Models\Category;

class PagesController extends Controller {

    public function index() {
        $shoes = $this->getShoes();
        return view(Config('constants.frontView') . '.index', compact('shoes'));
    }

    public function getShoes() {
        $categories = Category::where("is_home", 1)->orderBy("sort_order", "asc")->get();
        foreach ($categories as $cat) {
            $cat->image = asset("public/admin/uploads/catalog/category/" . json_decode($cat->images, true)[0]);
        }
        return $categories;
    }

}
