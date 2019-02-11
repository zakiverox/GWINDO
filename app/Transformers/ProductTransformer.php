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
}