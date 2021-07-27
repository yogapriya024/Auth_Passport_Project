<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => 'Authors',
            'attributes'=>[
                'name'=>$this->name,
                'created_At'=> $this->created_at,
                'updated_At'=> $this->updated_at,
            ]
        ];
  
    }
}
