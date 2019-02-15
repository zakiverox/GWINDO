<?php
namespace App\Transformers;

use App\User;
use App\profile;
use League\Fractal\TransformerAbstract;
use App\Product;
use Faker\Provider\Image;

class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $pro)
    {
        return [
            'Product_id'    => $pro->id,
            'Title'    => $pro->title,
            'deskripsi_Pribadi' => $pro->description,
            'category' => $pro->categorys,
            'foto' => $pro->images,
            'fasilitas' => $pro->fasilitas,
            
        ];
    }
    public static function originalAttribute($att) {
        $attributes =  [
            'Product_id'   => 'id',
            'title'        => 'name',
            'deskripsi_Pribadi'      => 'description',
           
           
        ];

        return isset($attributes[$att]) ? $attributes[$att] : null;
    }

    public static function transformedAttribute($att) {
        $attributes =  [
            'id'          => "identifier",
            'name'        => "title",
            'description' => "details",
         
        ];

        return isset($attributes[$att]) ? $attributes[$att] : null;
    }
}