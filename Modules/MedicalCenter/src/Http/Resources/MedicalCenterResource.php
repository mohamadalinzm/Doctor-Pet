<?php

namespace MedicalCenter\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicalCenterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'mobile' => $this->mobile,
            'phone' => $this->address->phone,
            'on_site_visit' => $this->on_site_visit,
            'owner' => $this->owner->name,
            'address' => $this->address,
            'date' => $this->created_at,
        ];
    }
}
