<?php

namespace App\Jobs;

use App\Models\User;

use App\DTO\EmailRequestDTO;
use Illuminate\Bus\Queueable;
use App\DTO\EmailRecipientDTO;
use App\Services\EmailService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\View as FacadesView;

class SendVerificationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(
        public User $user
    ){}

    public function handle()
    {

    }
}
