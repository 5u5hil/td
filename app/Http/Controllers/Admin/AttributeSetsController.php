<?php

namespace App\Http\Controllers\Admin;

use Route;
use Input;
use App\Models\AttributeSet;
use App\Models\Product;
use App\Http\Controllers\Controller;

class AttributeSetsController extends Controller {

    public function index() {
        $attrSets = AttributeSet::orderBy("id", "asc");

        if (!empty(Input::get("attr_set_name"))) {
            $attrSets = $attrSets->where("attr_set", "like", "%" . Input::get("attr_set_name") . "%");
        }


        $attrSets = $attrSets->paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminAttrSetView') . '.index', compact('attrSets'));
    }

    public function add() {
        $attrSets = new AttributeSet();
        $action = route("admin.attribute.set.save");
        return view(Config('constants.adminAttrSetView') . '.addEdit', compact('attrSets', 'action'));
    }

    public function edit() {
        $attrSets = AttributeSet::find(Input::get('id'));
        $action = route("admin.attribute.set.save");
        return view(Config('constants.adminAttrSetView') . '.addEdit', compact('attrSets', 'action'));
    }

    public function save() {
        $attrSets = AttributeSet::findOrNew(Input::get('id'));
        $attrSets->attr_set = Input::get('attr_set');
        $attrSets->save();
        return redirect()->route('admin.attribute.set.view');
    }

    public function delete() {
        $id = Input::get('id');

        $getcount = Product::where("attr_set", "=", $id)->count();




        if ($getcount <= 0) {
            AttributeSet::find($id)->attributes()->detach();
            AttributeSet::find($id)->delete();

            return redirect()->back()->with('message', 'Attribute Set deleted successfully!');
        } else {

            return redirect()->back()->with('message', 'Sorry This Attribute Set is Part of a Product! Delete the Product First!');
        }
    }

}
