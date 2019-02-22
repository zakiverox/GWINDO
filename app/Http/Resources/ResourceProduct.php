<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResourceProduct extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        [
            'Product_id'    => $this->id,
            'title'    => $this->title,
            'deskripsi_Pribadi' => $this->description,
            'questions' => [
               'assdsadsadas']
            
            
        ];
    }
}
