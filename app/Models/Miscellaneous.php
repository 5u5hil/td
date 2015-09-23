<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Miscellaneous extends Model implements SluggableInterface {

    use SluggableTrait;

    protected $table = 'settings';
    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'url_key',
    );
    protected $fillable = ['name', 'value', 'url_key'];

}
