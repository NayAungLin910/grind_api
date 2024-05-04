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
            'type' => $this->type,
            'title' => $this->title,
            'video' => $this->video,
            'description' => $this->description,
            'readingContent' => $this->readingContent,
            'timeGiven' => $this->timeGiven,
            'section' => SectionResource::collection($this->whenLoaded('section')),
            'questions' => QuestionResource::collection($this->whenLoaded('questions')),
        ];
    }
}
