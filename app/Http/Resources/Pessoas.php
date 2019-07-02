<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pessoas extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
			'name' => $this->name,
			'age' => $this->age,
			'movieTitle' => '',
			'year' => '',
			'rrate' => '',
		];
    }
}
