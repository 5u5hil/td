<?php

namespace App\Http\Controllers\Admin;

use Route;
use Input;
use App\Models\Product;
use App\Models\HasProducts;
use App\Models\Finish;
use App\Models\Fabric;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\AttributeSet;
use App\Models\CatalogImage;
use App\Models\Attribute;
use App\Models\Conversion;
use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use DB;
use App\Models\User;
use Session;
use App\Library\Helper;

class ProductsController extends Controller {

    public function index() {

        $products = Product::where('is_individual', '=', '1');


        if (!empty(Input::get('product_name'))) {
            $products = $products->where('product', 'like', "%" . Input::get('product_name') . "%");
        }

        if (!empty(Input::get('product_code'))) {
            $products = $products->where('product_code', 'like', "%" . Input::get('product_code') . "%");
        }



        $products = $products->orderBy("product", "asc")->paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminProductView') . '.index', compact('products'));
    }

    public function add() {
        $prod_types = [];
        $prodTy = ProductType::get(['id', 'type'])->toArray();
        foreach ($prodTy as $prodT) {
            $prod_types[$prodT['id']] = $prodT['type'];
        }

        $attr_sets = [];
        $attrS = AttributeSet::get(['id', 'attr_set'])->toArray();
        foreach ($attrS as $attr) {
            $attr_sets[$attr['id']] = $attr['attr_set'];
        }
//
//        $brandCats = [];
//        $brands = Category::findBySlug("brand-name")->getDescendants(1, ['id', 'category'])->toHierarchy()->toArray();
//        foreach ($brands as $brand) {
//            $brandCats[$brand['id']] = $brand['category'];
//        }


        $action = route("admin.products.save");
        return view(Config('constants.adminProductView') . '.add', compact('prod_types', 'attr_sets', 'action'));
    }

    public function save() {
        // dd(Input::all());
        $prod = Product::create(Input::all());
        if ($prod->prod_type != 3) {
            $attributes = AttributeSet::find($prod->attributeset['id'])->attributes;
            if (!empty($attributes))
                $prod->attributes()->sync($attributes);
            else
                $prod->attributes()->detach();
        } else {
            $attributes = AttributeSet::find($prod->attributeset['id'])->attributes()->where('is_filterable', "=", "0")->get();
            if (!empty($attributes))
                $prod->attributes()->sync($attributes);
        }


        // $cats = Category::find(Input::get('brand'));
        //  $prod->categories()->sync([$cats->id, $cats->brandmake, $cats->premiumness]);

        return redirect()->route('admin.products.general.info', ['id' => $prod->id]);
    }

    public function edit() {
        $prod = Product::find(Input::get('id'));
        $action = route('admin.products.update');


        return view(Config('constants.adminProductView') . '.editInfo', compact('prod', 'action'));
    }

    public function update() {

        $retunUrl = Input::get('return_url');
        $prod = Product::find(Input::get('id'));
        $prod->fill(Input::except('category_id', 'tags'))->save();

        $tags = explode(",", Input::get("tags"));
        if (!empty($tags)) {
            try {
                @$prod->retag($tags);
            } catch (Exception $ex) {
                
            }
        } else {
            try {
                @$prod->untag();
            } catch (Exception $ex) {
                
            }
        }

        $prod->update();


        $view = !empty(Input::get('return_url')) ? redirect()->to($retunUrl) : redirect()->route("admin.products.edit.category", ['id' => $prod->id]);
        return $view;
    }

    public function edit_category() {
        $prod = Product::find(Input::get('id'));
        $action = route('admin.products.update.category');
        return view(Config('constants.adminProductView') . '.edit_category', compact('prod', 'action'));
    }

    public function update_edit_category() {
        $retunUrl = Input::get('return_url');
        $prod = Product::find(Input::get('id'));
        if (!empty(Input::get('category_id')))
            $prod->categories()->sync(Input::get('category_id'));
        else
            $prod->categories()->detach();

        $view = !empty(Input::get('return_url')) ? redirect()->to($retunUrl) : redirect()->route("admin.products.images", ['id' => $prod->id]);
        return $view;
    }

    //images Tab

    public function img() {
        $images = CatalogImage::paginate(Config('constants.paginateNo'));
        $prod = Product::find(Input::get('id'));
        $action = route('admin.products.images.save');
        return view(Config('constants.adminProductView') . '.catalog_images', compact('images', 'prod', 'action'));
    }

    public function delImg() {
        $id = Input::get('imgId');
        $del = CatalogImage::find($id);
        $del->delete();
        echo "Successfully deleted";
    }

    public function saveImg() {
        // dd(Product::find(Input::get('prod_id'))->catalogimgs()->where("image_type", "=", 1)->get());
        //dd(Input::all());
        foreach (Input::file('images') as $key => $value) {

            if ($value != null) {
                $destinationPath = public_path() . '/admin/uploads/catalog/products/';
                $fileName = "prod-" . $key . date("YmdHis") . "." . $value->getClientOriginalExtension();
                $upload_success = $value->move($destinationPath, $fileName);
            } else {
                $fileName = null;
            }
            $saveImgs = CatalogImage::findOrNew(Input::get('id_img')[$key]);
            $saveImgs->catalog_id = Input::get('prod_id');
            $saveImgs->filename = is_null($fileName) ? $saveImgs->filename : $fileName;
            $saveImgs->image_type = 1;
            $saveImgs->alt_text = Input::get('alt_text')[$key];
            $saveImgs->image_mode = Input::get('image_mode')[$key];
            $saveImgs->sort_order = Input::get('sort_order')[$key];
            $saveImgs->save();
        }

        $prod = Product::find(Input::get('prod_id'));
        $attrs = AttributeSet::find($prod->attributeset['id'])->attributes->toArray();

        if (!empty(Input::get('return_url'))) {
            $nextView = redirect()->to(Input::get('return_url'));
        } else {
//
            if ($prod->prod_type == 2) {
                $nextView = redirect()->route("admin.combo.products.view", ['id' => $prod->id]);
            }
//        elseif (!empty($attrs)) {
//           $nextView = redirect()->route("admin.products.updateProdAttr", ['id'=>$prod->id]);
//        } 
            elseif ($prod->prod_type == 3) {
                $nextView = redirect()->route("admin.products.configurable.attributes", ['id' => $prod->id]);
            } elseif ($prod->prod_type == 4) {
                $nextView = redirect()->route("admin.products.configurable.without.stock.attributes", ['id' => $prod->id]);
            } else {
                $nextView = redirect()->route("admin.products.upsell.related", ['id' => $prod->id]);
            }
        }
        return $nextView;
    }

    public function configProdAttrs($prodId) {
        $prod = Product::find($prodId);
        $attributes = AttributeSet::find($prod->attributeset['id'])->attributes()->get();

        $attrs = [];

        foreach ($attributes as $attr) {
            $attrs[$attr->id]['name'] = $attr->attr;
            $attrValues = $attr->attributeoptions()->get(['id', 'option_name']);
            foreach ($attrValues as $val) {
                $attrs[$attr->id]['options'][$val->id] = $val->option_name;
            }
        }


        $prodVariants = Product::where("parent_prod_id", "=", $prod->id)->get();
        $action = route('admin.products.configurable.update');

        return view(Config('constants.adminProductView') . '.editCProd', compact('prod', 'action', 'attrs', 'prodVariants'));
    }

    public function update4() {
        $prod = Product::find(Input::get("prod_id"));
        $attributes = AttributeSet::find($prod->attributeset['id'])->attributes()->where("is_filterable", "=", "1")->get()->toArray();
        $prods = [];

        // dd($attributes);
        foreach ($attributes as $value) {
            foreach (Input::get($value["id"]) as $key => $val) {
                !isset($prods[$key]) ? $prods[$key] = [] : '';
                $prods[$key]["options"][$value["id"]] = $val;
            }
        }

        foreach (Input::get("price") as $key => $val) {
            !isset($prods[$key]) ? $prods[$key] = [] : '';
            $prods[$key]["price"] = $val;
        }


        foreach (Input::get("stock") as $key => $val) {
            !isset($prods[$key]) ? $prods[$key] = [] : '';
            $prods[$key]['stock'] = $val;
        }

        foreach (Input::get("is_avail") as $key => $val) {
            !isset($prods[$key]) ? $prods[$key] = [] : '';
            $prods[$key]['is_avail'] = $val;
        }

        foreach ($prods as $key => $prd) {

            // dd($prd["options"]);
            $newConfigProduct = Product::create(['product' => $prod->product . ' - Variant - ' . ($key + 1), 'is_avail' => 1, 'parent_prod_id' => $prod->id, 'is_individual' => 0, 'prod_type' => 1, 'attr_set' => $prod->attr_set, 'price' => $prods[$key]['price'], 'stock' => $prods[$key]['stock'], 'is_avail' => $prods[$key]['is_avail']]);
            //*
            $attributes = AttributeSet::find($newConfigProduct->attributeset['id'])->attributes;
            $newConfigProduct->attributes()->sync($attributes);
            //
            $name = $prod->product . ' - Variant ( ';
            foreach ($prd["options"] as $op => $opt) {

                $opt = trim($opt);
                $optionName = AttributeValue::find($opt)->option_name;
                $name .= "$optionName, ";
                DB::update(DB::raw("update has_options set attr_val = '$opt' where attr_id = $op and prod_id = " . $newConfigProduct->id));
            }

            $name = rtrim($name, ", ");
            $name .= " )";

            $newConfigProduct->product = $name;
            $newConfigProduct->update();
        }
//dd($newConfigProduct);
        $view = !empty(Input::get('return_url')) ? redirect()->to(Input::get('return_url')) : redirect()->route("admin.products.upsell.related", ['id' => $prod->id]);

        return $view;
    }

    //update without stock conf

    public function updateWithoutStock() {




        $prod = Product::find(Input::get("prod_id"));
        $prods = [];

        foreach (Input::get("id") as $key => $val) {

            foreach ($val as $i => $v) {
                array_push($prods, ["attr_id" => $key, "attr_val" => $v, "price" => Input::get("price")[$key][$i], "is_avail" => Input::get("is_avail")[$key][$i]]);
            }
        }



        foreach ($prods as $key => $prd) {
            $args = ['product' => $prod->product . ' - Variant - ' . (AttributeValue::find($prd['attr_val'])->option_name), 'is_avail' => $prd['is_avail'], 'parent_prod_id' => $prod->id, 'is_individual' => 0, 'prod_type' => 1, 'attr_set' => $prod->attr_set, 'price' => $prd['price']];
          
            $newConfigProduct = Product::create($args);
            $newConfigProduct->attributes()->attach($prd['attr_id'], ["attr_val"=>$prd['attr_val']]);
        }

        $view = !empty(Input::get('return_url')) ? redirect()->to(Input::get('return_url')) : redirect()->route("admin.products.upsell.related", ['id' => $prod->id]);

        return $view;
    }

    public function updateProdVariant() {
        $prod = Product::find(Input::get("id"));
        $attributes = AttributeSet::find($prod->attributeset['id'])->attributes()->where("is_filterable", "=", "1")->get();
        $attrs = [];
        foreach ($attributes as $attr) {

            $attrs[$attr->id]['name'] = $attr->attr;
            $attrValues = $attr->attributeoptions()->get(['id', 'option_name']);
            foreach ($attrValues as $val) {
                $attrs[$attr->id]['options'][$val->id] = $val->option_name;
            }
        }
        //  dd($attrs);
        $action = route('admin.products.attributes.update');
        return view(Config('constants.adminProductView') . '.editProdVariant', compact('prod', 'action', 'attrs'));
    }

    public function getAllProds($prod_id = "") {
        $prods = Product::where('is_individual', '=', '1')
                ->where("id", "!=", $prod_id)
                ->orderBy("product", "asc")
                ->paginate(Config('constants.paginateNo'));
        return $prods;
    }

    public function update2() {

        foreach ($_POST as $key => $value) {
            if (is_int($key)) {
                DB::update(DB::raw("update has_options set attr_val = '$value' where attr_id = $key and prod_id = " . Input::get('id')));
            }
        }
        $prd = Product::find(Input::get('id'));
        $prd->fill(Input::all())->save();

        if ($prd->prod_type != 3) {
            $pId = !empty(Input::get('parent_prod_id')) ? Input::get('parent_prod_id') : Input::get('id');
            $prod = Product::find($pId);
            $prods = $this->getAllProds($pId);
            $action = route('admin.products.upsell.related');
            return !empty(Input::get('close')) ? view(Config('constants.adminProductView') . '.close', compact('prod', 'prods', 'action')) : redirect()->route("admin.products.upsell.related", $pId);
        } else {
            return redirect()->route("admin.products.configurable.attributes", ['id' => $prd->id]);
        }
    }

    public function updateRelatedUpsellProds($prodId) {
        $prod = Product::find($prodId);
        //    $search = !empty(Input::get("relSearch")) ? Input::get("relSearch") : !empty(Input::get("relSearch")) ? Input::get("relSearch") : '';
        //  $search_fields = ['product', 'short_desc', 'long_desc'];

        $prods = Product::where('is_individual', '=', '1')
                ->where("id", "!=", $prod->id)
                ->orderBy("product", "asc");
        //   $prods = $prods->where(function($query) use($search_fields, $search) {
        //       foreach ($search_fields as $field) {
        //           $query->orWhere($field, "like", "%$search%");
        //       }
        //     });


        if (!empty(Input::get('product_name'))) {
            $prods = $prods->where('product', 'like', "%" . Input::get('product_name') . "%");
        }

        if (!empty(Input::get('product_code'))) {
            $prods = $prods->where('product_code', 'like', "%" . Input::get('product_code') . "%");
        }


        $prods = $prods->paginate(Config('constants.paginateNo'));

        $action = route('admin.products.upsell');
        return view(Config('constants.adminProductView') . '.editRelUpsellProd', compact('prod', 'prods', 'action'));
    }

    public function relAttach() {
        $prod = Product::find(Input::get("id"));
        $prod->relatedproducts()->attach(Input::get("prod_id"));
    }

    public function relDetach() {
        $prod = Product::find(Input::get("id"));
        $prod->relatedproducts()->detach(Input::get("prod_id"));
    }

    public function upsellAttach() {
        $prod = Product::find(Input::get("id"));
        $prod->upsellproducts()->attach(Input::get("prod_id"));
    }

    public function upsellDetach() {
        $prod = Product::find(Input::get("id"));
        $prod->upsellproducts()->detach(Input::get("prod_id"));
    }

    public function update3() {
        $view = !empty(Input::get('return_url')) ? redirect()->to(Input::get('return_url')) : redirect()->route("admin.products.view");
        return $view;
    }

    //combo products

    public function comboProds($prodId) {


        $prod = Product::find($prodId);

        //   $search = !empty(Input::get("search")) ? Input::get("search") : '';
        //  $search_fields = ['product', 'short_desc', 'long_desc'];

        $prods = Product::where('is_individual', '=', '1')
                ->where("id", "!=", $prod->id)
                ->where("is_crowd_funded", "=", 0)
                ->orderBy("product", "asc");
//        $prods = $prods->where(function($query) use($search_fields, $search) {
//            foreach ($search_fields as $field) {
//                $query->orWhere($field, "like", "%$search%");
//            }
//        });

        $prods = $prods->paginate(Config('constants.paginateNo'));

        $action = route('admin.products.update.combo');
        return view(Config('constants.adminProductView') . '.edit4Prod', compact('prod', 'prods', 'action'));
    }

    public function update5() {
        $prod = Product::find(Input::get("id"));
        if (!empty(Input::get('combo_prods')))
            $prod->comboproducts()->sync(Input::get('combo_prods'));
        else
            $prod->comboproducts()->detach();

        $attrs = AttributeSet::find($prod->attributeset['id'])->attributes->toArray();

        if (!empty(Input::get('return_url'))) {
            $nextView = redirect()->to(Input::get('return_url'));
        } else {
            // if (empty($attrs)) {
            $nextView = redirect()->route("admin.products.upsell.related", $prod->id);
            //  } else {
            //     $nextView = redirect()->route("admin.products.updateProdAttr", $prod->id);
            // }
        }
        return $nextView;
    }

    public function comboAttach() {
        $prod = Product::find(Input::get("id"));
        $prod->comboproducts()->attach(Input::get("prod_id"));
    }

    public function comboDetach() {
        $prod = Product::find(Input::get("id"));
        $prod->comboproducts()->detach(Input::get("prod_id"));
    }

    //attr

    public function prodAttrs($prodId) {
        $prod = Product::find($prodId);
        $attrs = AttributeSet::find($prod->attributeset['id'])->attributes->toArray();
        $action = route('update2Prod');
        return view(Config('constants.adminProductView') . '.edit2Prod', compact('prod', 'action', 'attrs'));
    }

    public function duplicate_prod() {
        $prodId = Input::get('id');
        //save products basic fields
        $prods = Product::where('id', '=', $prodId)->get()->toArray();
        $cats = [];
        $cats_prod = Product::find($prods[0]['id'])->categories()->get();

        //   $catalogImages = [];

        $catalogImages = Product::find($prods[0]['id'])->catalogimgs()->get();

        //   dd($catalogImages);



        unset($prods[0]['id'], $prods[0]['created_at'], $prods[0]['updated_at']);
        $prods[0]['product'] = "duplicate-" . $prods[0]['product'];
        $prods[0]['url_key'] = "duplicate-" . $prods[0]['url_key'];

        $saveDupProd = Product::create($prods[0]);

        //sync categories

        $saveDupProd->categories()->sync($cats_prod);

        //sync images

        foreach ($catalogImages as $catImg) {
            $saveImg = new CatalogImage();
            $saveImg->filename = $catImg->filename;
            $saveImg->alt_text = $catImg->alt_text;
            $saveImg->image_mode = $catImg->image_mode;
            $saveImg->sort_order = $catImg->sort_order;
            $saveImg->catalog_id = $saveDupProd->id;
            $saveImg->save();
        }


        //  $saveDupProd->catalogimgs()->sync($catalogImages);
        //varients prods of products
        $chkProdVar = Product::where('parent_prod_id', '=', $prodId)->get()->toArray();
        $prods_varients = [];

        if (!empty($chkProdVar)) {
            foreach ($chkProdVar as $prodVar) {

                unset($prodVar['id'], $prodVar['created_at'], $prodVar['updated_at']);
                $prodVar['product'] = "duplicate-" . $prodVar['product'];
                $prodVar['parent_prod_id'] = $saveDupProd->id;
                array_push($prods_varients, $prodVar);
            }
        }
        foreach ($prods_varients as $prod_var) {
            $saveDupProdVar = Product::create($prod_var);
            $attributes = AttributeSet::find($saveDupProdVar->attributeset['id'])->attributes;
            $saveDupProdVar->attributes()->sync($attributes);
            //    DB::update(DB::raw("update has_options set attr_val = '$opt' where attr_id = $op and prod_id = " . $newConfigProduct->id));
        }


        Session::flash("successDupProd", "Duplicate Product created successfully");

        return redirect()->route("admin.products.view");
    }

    public function fabrics() {
        $prod = Product::find(Input::get('id'));
        $brand = \App\Library\Helper::getBrand($prod);
        // dd($brand);
        $finish = Finish::where('brand', $brand)->with('fabrics')->get();
        $action = 'admin.products.updatefabrics';
        return view(Config('constants.adminProductView') . '.fabrics', compact('finish', 'prod', 'action'));
    }

    public function updateFabrics() {
        $prod = Product::find(Input::get('id'));

        if (!empty(Input::get('fab'))) {
            $prod->fabrics()->sync(Input::get('fab'));
        } else {
            @$prod->fabrics()->detach();
        }

        if (!empty(Input::get('return_url'))) {
            $nextView = redirect()->to(Input::get('return_url'));
        } else {
            $nextView = redirect()->route("admin.products.ConfigProdAttrs", $prod->id);
        }
        return $nextView;
    }

    public function comm_prod_details() {
        $allProdDetails = HasProducts::where("has_products.id", "=", Input::get('prodid'))
                ->leftJoin("orders", "orders.id", "=", "has_products.order_id")
                ->leftJoin("prod_status", "prod_status.id", "=", "has_products.status")
                ->leftJoin("products", "products.id", "=", "has_products.prod_id")
                ->leftJoin("fabrics", "fabrics.id", "=", "has_products.finish_id")
                ->leftJoin("consignments", "consignments.id", "=", "has_products.consignment_id")
                ->leftJoin("proforma_invoices", "proforma_invoices.id", "=", "has_products.proforma_invoice_id")
                ->first(['has_products.*', 'orders.project_name', 'fabrics.fabric', 'products.product', 'prod_status.prod_status', 'products.product_code', 'proforma_invoices.invoice_no', 'consignments.consignment_no']);

        return $allProdDetails;
    }

    public function delete() {
        $count = HasProducts::where("prod_id", Input::get('id'))->count();

        if ($count <= 0) {
            $prod = Product::findOrFail(Input::get('id'));
            $prod->categories()->detach();
            $prod->attributes()->detach();
            $prod->relatedproducts()->detach();
            $prod->upsellproducts()->detach();
            $prod->comboproducts()->detach();
            $prod->catalogimgs()->detach();
            $prod->fabrics()->detach();
            $prod->savedlist()->detach();
            $prod->delete();
            return redirect()->back()->with('message', 'Product deleted successfully!');
        } else {
            return redirect()->back()->with('message', 'Sorry This Product is Part of a Project! Delete the Project First!');
        }
    }

    public function configProdAttrsWithoutStock($prodId) {
        $prod = Product::find($prodId);
        $attributes = AttributeSet::find($prod->attributeset['id'])->attributes()->get();

        $attrs = [];

        foreach ($attributes as $attr) {
            $attrs[$attr->id]['name'] = $attr->attr;
            $attrValues = $attr->attributeoptions()->get(['id', 'option_name']);
            foreach ($attrValues as $val) {
                $attrs[$attr->id]['options'][$val->id] = $val->option_name;
            }
        }


        $prodVariants = Product::where("parent_prod_id", "=", $prod->id)->get();
        $action = route('admin.products.configurable.update.without.stock');

        return view(Config('constants.adminProductView') . '.editCProdWithoutStock', compact('prod', 'action', 'attrs', 'prodVariants'));
    }

}
