<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['permissions'] = $this->whenLoaded('permissions')->pluck('id');

        return $data;
    }
}
