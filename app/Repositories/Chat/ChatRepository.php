<?php
namespace App\Repositories\Chat;

use App\Interfaces\Chat\ChatInterface;
use App\Models\Chat;
use App\Models\Message;



class ChatRepository implements ChatInterface
{
     public function getSuperAdminRooms()
     {
          return Chat::with([
               'visitor',
               'messages' => function ($query) {
                    $query->orderBy('id', 'DESC')->first();
               }
          ])->whereNull('museum_id')->orderBy('id', 'DESC')->paginate(5);
     }

     public function getMuseumRooms($museumId)
     {
          return Chat::where('museum_id', $museumId)->orderBy('id', 'DESC')->paginate(5);
     }

     public function getRoomMessage($id)
     {
          return Chat::with([
               'visitor',
               'messages' => function ($query) {
                    $query->orderBy('id', 'ASC')->get();
               }
          ])->find($id);
     }

     public function addAdminMessage($data)
     {
          $message = [
               'chat_id' => $data['chat_id'],
               'text' => $data['text'],
               'type' => Message::TYPE_MUSEUM,
          ];

          return Message::create($message);
     }

     public function addMessage($data)
     {
          return Message::create($data);
     }

     public function createChat($data)
     {
          return Chat::create($data);
     }

}