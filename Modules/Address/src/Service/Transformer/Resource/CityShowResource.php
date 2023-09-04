<?php

namespace Address\Service\Transformer\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class CityShowResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'hash' => $this->id,
            'name' => $this->name,
        ];
    }

}
