<?php

namespace App\Jobs\Loan;

use App\Models\Loan;
use App\Models\User;

use App\DTO\EmailRequestDTO;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use App\DTO\EmailRecipientDTO;
use App\Services\EmailService;
use Illuminate\Support\Facades\View;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendLoanApprovalRequestEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public Loan $loan
    ){}

    public function handle()
    {
    }
}
