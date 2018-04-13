<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WtypesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sash' => $this->sash,
            'image' =>\Storage::disk('uploads')->url($this->image)
        ];
    }
}