<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'profileImage' => $this->profileImage,
            'role' => $this->role,
            'courses' => CourseResource::collection($this->whenLoaded('courses')),
            'enrolledCourses' => CourseResource::collection($this->whenLoaded('enrolledCourses')),
            'certificates' => CertificateResource::collection($this->whenLoaded('certificates')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
