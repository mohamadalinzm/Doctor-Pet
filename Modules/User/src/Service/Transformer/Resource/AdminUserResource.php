<?php

namespace User\Service\Transformer\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fullName' => $this->fullName,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'birthDate' => $this->birthDate,
            'role' => new RoleResource($this->whenLoaded('role')),
        ];
    }

}
