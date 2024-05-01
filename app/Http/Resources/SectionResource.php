<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'courseId' => $this->courseId,
            'title'=> $this->title,
            'description' => $this->description,
            'course' => CourseResource::collection($this->whenLoaded('course')),
            'steps' => StepResource::collection($this->whenLoaded('steps'))
        ];
    }
}
