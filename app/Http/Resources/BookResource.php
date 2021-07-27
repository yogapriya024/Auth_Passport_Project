<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'type' => 'books',
            'attributes'=>[
                'name'=>$this->name,
                'description'=>$this->description,
                'publication_year'=>$this->publication_year,
                'created_At'=> $this->created_at,
                'updated_At'=> $this->updated_at,
            ]
        ];
  
    }
}
