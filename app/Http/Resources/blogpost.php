<?php

namespace CodeHead\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class blogpost extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        // formatting the way you want
        return[
            'id'=>$this->id,
            'title'=>$this->title,
            'body'=>$this->body,
            'tag'=>$this->tag
        ];
    }
    public function with($request){
        return[
            'author'=>'damilare emmanuel',
            'author_url'=>url('http://damilareemmanuel.com'),
            'version'=>'1.0',
        ];
    }
}
