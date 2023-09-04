<?php

namespace Address\Service\Transformer\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressListResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'address1' => $this->address1,
            'is_active' => $this->is_active,
            'is_default' => $this->is_default,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'postal_code' => $this->postal_code,
            'province' => new StateShowResource($this?->province),
            'city' => new CityShowResource($this?->city),
        ];
    }

}
