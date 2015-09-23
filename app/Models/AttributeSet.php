<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model {

    protected $table = 'attribute_sets';
    protected $fillable = ['attr_set'];

    public function attributes() {
        return $this->belongsToMany('App\Models\Attribute', 'has_attributes', 'attr_set', 'attr_id');
    }

}
