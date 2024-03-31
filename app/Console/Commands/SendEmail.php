<?php

namespace App\Console\Commands;

use App\Models\Message;
use App\Services\MessageService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class SendEmail extends Command
{

    public MessageService $messageService;

    public function __construct(
        MessageService $messageService
    )
    {
        parent::__construct();

        $this->messageService = $messageService;
    }

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
        $user = \App\Models\User::query()->where('email',$email)->first();


        $message = $this->messageService->send($user->id, $theme, $text);

            return $this->info($message);



    }
}
