<?php

namespace App\Http\Controllers\Admin;

use Route;
use Input;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller {

    public function index() {
        $categories = Category::orderBy("id", "asc");
        $categories = $categories->paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminCategoryView') . '.index', compact('categories'));
    }

    public function add() {
        $category = new Category();
        $action = route("admin.category.save");
        return view(Config('constants.adminCategoryView') . '.addEdit', compact('category', 'action'));
    }

    public function edit() {
        $category = Category::find(Input::get('id'));
        $action = route("admin.category.save");
        return view(Config('constants.adminCategoryView') . '.addEdit', compact('category', 'action'));
    }

    public function save() {
        $category = Category::findOrNew(Input::get('id'));
        $category->category = Input::get('category');
        $category->folder = Input::get('folder');
        $category->base_price = Input::get('base_price');
        $category->sort_order = Input::get('sort_order');


        $catImgs = json_decode(empty(Input::get('imgs')) ? "[]" : Input::get('imgs'), true);

        $destinationPath = public_path() . '/admin/uploads/catalog/category/';

        if (Input::hasFile('images')) {
            $i = 1;
            foreach (Input::file("images") as $file) {
                $fileName = date("YmdHis") . "-$i" . "." . $file->getClientOriginalExtension();
                $upload_success = $file->move($destinationPath, $fileName);
                if ($upload_success) {
                    array_push($catImgs, $fileName);
                    $i++;
                }
            }
        }
        $category->images = json_encode($catImgs);
        $category->save();
        if (!empty(Input::get("parent_id")))
            $category->makeChildOf(Input::get("parent_id"));
//dd(Input::get("new_prod_cat"));
        if (!empty(Input::get("new_prod_cat"))) {
            return redirect()->route('admin.products.edit.category', ['id' => Input::get("new_prod_cat")]);
        } else {

            return redirect()->route('admin.category.view');
        }
    }

    public function delete() {
        $getId = Input::get('id');
        $cat = Category::find($getId);

        $has_cats = Category::find($getId)->products;
        // dd($has_cats);

        if (!empty($has_cats)) {
            $cats = Category::find($getId)->products()->detach();
        }
        $cat->delete();
        return redirect()->back()->with("messege", "Category deleted successfully!");
    }

}
