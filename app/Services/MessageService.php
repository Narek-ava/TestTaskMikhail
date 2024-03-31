<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageService
{
    public function send(
        int    $userId,
        string $theme,
        string $text,
        string $status = 'unread',
    )
    {
        DB::beginTransaction();
        try {
            $message = new Message();
            $message->user_id = $userId;
            $message->theme = $theme;
            $message->text = $text;
            $message->status = $status;
            $message->save();
            DB::commit();
            return "Message sended successfully";

        } catch (\Exception $exception) {
            DB::rollBack();

            return "Something went wrong: $exception";
        }
    }
}
