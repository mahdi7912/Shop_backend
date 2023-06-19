<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            $this->collection->map(function ($post)
               {
                   return[
                        'id' => $post->id,
                        'name' => $post->name,
                        'description' => $post->description,
                        'status' => $post->status,
                        'summary' => $post->summary,
                        'user_id' => $post->user_id,
                        'category_id' => $post->category_id,
                        'tags' => $post->tags
                   ];
               }),
           ];
    }
}
