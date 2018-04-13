<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewsResource extends JsonResource
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
            'contract' => $this->contract,
            'phone' => $this->phone,
            'title' => $this->title,
            'desc' => $this->desc,
            'votes' => $this->votes,
            'images' => $this->images->map(function ($element) {
                return $element->path = \Storage::disk('uploads_images')->url($element->path);
            }),
            'created_at' => $this->created_at,
        ];
    }
}