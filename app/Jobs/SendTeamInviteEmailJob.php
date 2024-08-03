<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\UserInvite;
use App\Notifications\TeamInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;

class SendTeamInviteEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function __construct(
        public User $user,
        public UserInvite $invite
    ) {}

    public function handle()
    {
        $params = [
            'id' => $this->user->id,
            'inviteRef' => $this->invite->id,
        ];

        $verificationLink = config('app.url') . '/admin/invite/accept?';

        $messageSubject = "MyVault: Team Member Invitation";
        foreach ($params as $key => $param) {
            $verificationLink .= "{$key}={$param}&";
        }
        $htmlContent = View::make('mails.team-invite', [
            'businessName' => optional($this->user->business)->business_name ?? "Onepipe Admin",
            'email' => $this->user->email,
            'role' => $this->user->role->name,
        ])->render();
    }
}
