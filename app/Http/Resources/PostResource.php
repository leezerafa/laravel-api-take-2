<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PostResource extends Resource
{
    /**
     * Transform the resource into an array for the post json response
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'user_id'    => $this->user_id,
            'title'      => $this->title,
            'body'       => $this->body,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
