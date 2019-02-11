<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\ProductTransformer;

class Product extends Model
{
    public $transformer = ProductTransformer::class;
    protected $fillable = [
        'title', 'description', 'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];


    public function categorys()
    {
        return $this->belongsToMany('App\category');
    }

    public function images()
    {
        return $this->hasMany('App\image');
    }

    public function fasilitas()
    {
        return $this->hasMany('App\fasilitas');
    }

    public function user()
    {
        return $this->belongsTo('App\category');
    }
   
}


