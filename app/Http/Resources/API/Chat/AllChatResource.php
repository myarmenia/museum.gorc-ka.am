<?php

namespace App\Http\Resources\API\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllChatResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        $translations = $this->museum? $this->museum->getCurrentTranslation[0] : null;
        $mainPhotoPath = $this->museum? $this->museum->images->where('main', 1)->first()->path : null;

        return [
            'chat_id' => $this->id,
            'title' => $this->title,
            'museum_id' => $this->museum? $this->museum->id : '',
            'museum_name' => $translations ? $translations->name : translateMessageApi('general-name'),
            'museum_photo'=> $mainPhotoPath ? route('get-file', ['path' => $mainPhotoPath]) : '',
            'education_program_type' => $this->education_program_type,
            'messages' => MessageResource::collection($this->messages),
        ];
    }
}
