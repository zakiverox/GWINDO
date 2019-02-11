<?php
namespace App\Transformers;

use App\Role;
use App\User;
use App\profile;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $pro)
    {
        return [
            'User_id'    => $pro->id,
            'Status'    => $pro->name,
            'Show'    => $pro->display_name,   
            'deskripsi' => $pro->description,
            
            
        ];
    }
}