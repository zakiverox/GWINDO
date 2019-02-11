<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;
class UserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['profile','role'];


    public function transform(User $user)
    {
        return [
            'User_id'    => $user->id,
            'User_name'    => $user->name,
            'User_email'    => $user->email,   
              
             
                  
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