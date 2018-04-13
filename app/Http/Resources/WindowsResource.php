<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WindowsResource extends JsonResource
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
            'title' => $this->title,
            'wtypes' => $this->title,
            'table' => $this->table,
            'range' => $this->range,
        ];
    }

}