<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

class OptionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    static public function get_options()
    {
        return [
            'window_montage_price' => Config::get('settings.window_montage_price'),
            'window_sill' => Config::get('settings.window_sill'),
        ];
    }
}