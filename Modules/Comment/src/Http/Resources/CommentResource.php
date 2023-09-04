<?php

namespace Comment\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->name,
            'message' => $this->slug,
            'type' => $this->mobile,
            'status' => $this->address->phone,
            'user' => $this->user,
            'ticket_number' => $this->ticket_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
