<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Baum\Node;

class Category extends Node implements SluggableInterface {

    protected $table = 'categories';

    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'category',
        'save_to' => 'url_key',
    );

       public function products() {
        return $this->belongsToMany('App\Models\Product', 'has_categories', 'cat_id', 'prod_id');
    }
    
     protected $orderColumn = "sort_order";
    
}
