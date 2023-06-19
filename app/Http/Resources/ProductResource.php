<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResource extends ResourceCollection
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
        $this->collection->map(function ($product)
           {
               return[
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'status' => $product->status,
                    'remaining' => $product->summary,
                    'price' => $product->user_id,
                    'discount' => $product->discount,
                    'category_id' => $product->category_id,
                    'tags' => $product->tags
               ];
           }),
       ];
    }
}
