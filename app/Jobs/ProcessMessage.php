<?php

namespace App\Jobs;

use App\Services\MessageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $message;
    protected string $theme;
    protected int $userId;
    protected MessageService $messageService;

    /**
     * Create a new job instance.
     *
     * @param MessageService $messageService
     * @param string $message
     * @param string $theme
     * @param int $userId
     */
    public function __construct(
        MessageService $messageService,
        string $message,
        string $theme,
        int $userId
    )
    {
        $this->message = $message;
        $this->theme = $theme;
        $this->userId = $userId;
        $this->messageService = $messageService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Process the message here
        // For example, you can log the message

        $this->messageService->send($this->userId,$this->theme,$this->theme);
        logger('Processing message: ' . $this->message);
    }
}
