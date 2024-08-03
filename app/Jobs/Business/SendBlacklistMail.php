<?php

namespace App\Jobs\Business;

use App\Models\Business;

use App\DTO\EmailRequestDTO;
use Illuminate\Bus\Queueable;
use App\DTO\EmailRecipientDTO;
use App\Services\EmailService;
use Illuminate\Support\Facades\View;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendBlacklistMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Business $business
    ){}

    public function handle()
    {

    }
}
