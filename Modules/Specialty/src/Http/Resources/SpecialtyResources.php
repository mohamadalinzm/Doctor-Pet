<?php

namespace Specialty\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialtyResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->slug,
        ];
    }
}
