<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\UserInterface;


class Address extends Model {

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'has_addresses';
   
    public $timestamps = false;
    
     public function users() {
        return $this->belongsTo('User');
    }
    
     

}
