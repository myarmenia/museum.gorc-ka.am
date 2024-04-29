<?php

namespace App\Http\Resources\API\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListActiveQRResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
          'id' => $this->id,
          'museum_id' => $this->museum_id ?? null,
          'path' => route('get-file', ['path' => $this->path]),
          'type' => $this->type,
          'price' => $this->price,
          'color' => ticketColors()[$this->type]
        ];



        if ($this->type == 'united') {
            $translations = $this->purchased_item->purchase_united_tickets->pluck('museum')->pluck('translations')->flatten();
            $names = $translations->where('lang', session("languages"))->pluck('name');
        }
        else{
            if ($this->type == 'subscription') {
                $data['date'] = date('d-m-Y', strtotime($this->created_at));
            }
            if ($this->type == 'event') {
                $data['date'] = date('d-m', strtotime($this->event_config->day)) . '|' . date('H:i', strtotime($this->event_config->start_time)) . '-' . date('H:i', strtotime($this->event_config->end_time));
            }

            $data['museum_address'] = $this->museum->getCurrentTranslation[0]->address;
            $names = [$this->museum->translation(session("languages"))->name];

        }

        $data['museum_name'] = $names;

        return $data;
    }
}
