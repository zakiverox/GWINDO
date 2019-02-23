<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;
class UserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];


    public function transform(User $user)
    {
        return [
            'User_id'    => $user->id,
            'User_name'    => $user->name,
            'User_email'    => $user->email,   
            'profile'=> [
                        'nama_lengkap'=>$user->profile->first_name .' '. $user->profile->lastt_name ,
                        'telepon'=>$user->profile->phone,
                        'jk'=>$user->profile->jk,
                        'alamat'=>$user->profile->alamat],
            
            
              
             
                  
        ];
    }
    public function includeprofile(User $user)
    {
        $profile = $user->profile->first();

        return $this->item($profile, new ProfileTransformer);
    }

    public function includerole(User $user)
    {
        $role = $user->roles;

        return $this->collection($role, new RoleTransformer);
    }
}