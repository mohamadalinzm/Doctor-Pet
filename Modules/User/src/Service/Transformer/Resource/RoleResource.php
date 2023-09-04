<?php

namespace User\Service\Transformer\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'role_id' => $this->id,
            'role_name' => $this->name,
        ];
    }

}
