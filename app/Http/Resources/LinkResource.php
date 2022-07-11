<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'is_protected' => $this->is_protected,
            'is_expired' => $this->is_expired,
            'hash' => $this->hash,
            'full_url' => $this->full_url,
            'url' => $this->is_expired ? null : $this->url,
        ];
    }
}
