<?php
namespace App\Transformers;

use App\User;
use App\Product;
use App\profile;
use Faker\Provider\Image;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;
use App\Traits\NoDataArraySerializer;

class ProductTransformer extends TransformerAbstract
{
  
   
    protected $defaultIncludes = [];
    public function transform(Product $pro)
    {
        
        
        $name = $pro->images->first();
       return [
            'Product_id'    => $pro->id,
            'title'    => $pro->title,
            'deskripsi_Pribadi' => $pro->description,       
           'users'=> [ 'id' =>$pro->user->id,
                         'user' => $pro->user->name,
                        'detail'=>['name'=>$pro->user->profile->first_name.' '. $pro->user->profile->lastt_name,
                        'foto'=> $pro->user->profile->foto]                                    
                    ],
                    'category'=>$pro->categorys->map(function ($cat) {
                        return [
                            'cateory_id' => $cat->id,
                            'name' => $cat->name
                        ];
                    }),
                    'image'=>$name,
         'detail'=>$pro->fasilitas->map(function ($cat) {
            return [
                'fasilitas' => $cat->fasilitas,
                'exclude' => $cat->exclude,
                'acara' => $cat->acara,
                'transport' => $cat->transport,
            ];
        }),
          
           
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
            'id'          => "Product_id",
            'name'        => "title",
            'description' => "deskripsi_Pribadi",
         
        ];

        return isset($attributes[$att]) ? $attributes[$att] : null;
    }
}