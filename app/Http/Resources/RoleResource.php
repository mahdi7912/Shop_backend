<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            $this->collection->map(function ($role)
               {
                   return[
                       'name' => $role->name,
                       'description' => $role->description,
                       'status' => $role->status,
                       'premissions' => $role->premissions
                   ];
               }),
           ];
       }

}



