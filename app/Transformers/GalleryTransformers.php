<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;
use App\Image;
class GalleryTransformers extends TransformerAbstract
{
   


    public function transform(Image $img)
    {
        return [
            'id'    => $img->id,
            'name'    => $img->name,
            'link'    => $img->link,
           
            
              
             
                  
        ];
    }
    
}