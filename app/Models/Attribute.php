<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
//use App\Models\AttributeSet;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Attribute extends \Eloquent implements SluggableInterface {

    use SluggableTrait;

    protected $table = 'attributes';
    protected $sluggable = array(
        'build_from' => 'attr',
        'save_to' => 'slug',
    );
    
    public function attributesets(){
       return $this->belongsToMany('App\Models\AttributeSet', 'has_attributes', 'attr_id', 'attr_set');
        
    }
    
      public function attributeoptions(){
       return $this->hasMany('App\Models\AttributeValue', 'attr_id');
        
    }

}
