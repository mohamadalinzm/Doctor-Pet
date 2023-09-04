<?php

namespace MedicalCenter\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicalCenterTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
        ];
    }
}
