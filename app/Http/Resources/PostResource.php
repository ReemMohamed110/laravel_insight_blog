<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        return [
            'post_title'=>$this->title,
            'post_content'=>$this->content,
            'post_image'=>$this->image,
            'user'=>$this->user->name,
            'created_at'=>$this->created_at->format('d-m-Y H:i:s')
        ];
    }
}
