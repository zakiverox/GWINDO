<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
 
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];


    
 
    public function products()
    {
        return $this->belongsToMany('App\product');
    }  
}
