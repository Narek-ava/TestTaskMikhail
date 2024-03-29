<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email {--email=value} {--theme=value} {--text=value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $validator = Validator::make($this->options(), [
            'theme' => ['required', 'string'],
            'text' => ['required', 'string'],
            'email' => ['required','string','exists:users,email']
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            $this->error('The following errors occurred:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        $email = $this->option('email');
        $theme = $this->option('theme');
        $text = $this->option('text');
        $this->info("Option value: $theme");
        $this->info("Option value: $text");
        $user = \App\Models\User::query()->where('email',$email)->first();

        $message =  new Message();
        $message->user_id = $user->id;
        $message->theme = $theme;
        $message->text = $text;
        $message->status = 'unread';
        $message->save();

        return "message sended successfully";

    }
}
