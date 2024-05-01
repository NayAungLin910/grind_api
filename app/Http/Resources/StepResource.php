<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StepResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sectionId' => $this->sectionId,
            'section' => SectionResource::collection($this->whenLoaded('section')),
            'type' => $this->type,
            'title' => $this->title,
            'video' => $this->video,
            'description' => $this->description,
            'readingContent' => $this->readingContent,
            'status' => $this->status,
            'timeGiven' => $this->timeGiven,
        ];
    }
}
