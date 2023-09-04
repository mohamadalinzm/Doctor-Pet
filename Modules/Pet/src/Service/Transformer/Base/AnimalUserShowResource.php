<?php

namespace Pet\Service\Transformer\Base;

use Illuminate\Http\Resources\Json\JsonResource;

class AnimalUserShowResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
        ];
    }

}
