<?php

namespace Pet\Service\Transformer\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Pet\Service\Transformer\Base\AnimalUserShowResource;
use Pet\Service\Transformer\Base\PetUserShowResource;

class PetListResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'race' => $this->race,
            'age' => $this->age,
            'type' => $this->type,
            'kind' => $this->kind,
            'avatar' => $this->avatar,
            'birthDate' => $this->birthDate,
            'animal' => new AnimalUserShowResource($this?->animal),
            'user' => new PetUserShowResource($this?->user),
        ];
    }

}
