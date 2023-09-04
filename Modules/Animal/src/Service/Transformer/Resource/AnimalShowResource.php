<?php

namespace Animal\Service\Transformer\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Pet\Service\Transformer\Base\PetUserShowResource;

class AnimalShowResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'image' => asset($this->image),
        ];
    }

}
