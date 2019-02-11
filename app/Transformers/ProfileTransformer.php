<?php
namespace App\Transformers;

use App\User;
use App\profile;
use League\Fractal\TransformerAbstract;

class ProfileTransformer extends TransformerAbstract
{
    public function transform(profile $pro)
    {
        return [
            'User_id'    => $pro->id,
            'User_name'    => $pro->first_name . ', '. $pro->lastt_name,
            'phone'    => $pro->phone,   
             'alamat' => $pro->alamat,
             'deskripsi_Pribadi' => $pro->description,
            
        ];
    }
}