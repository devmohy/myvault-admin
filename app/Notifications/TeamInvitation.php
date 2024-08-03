<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\UserInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TeamInvitation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public User $user,
        public UserInvite $invite
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $params = [
            'id' => $this->user->id,
            'inviteRef' => $this->invite->id,
        ];
        $verificationLink = config('app.url') . '/admin/invite/accept?';
        foreach ($params as $key => $param) {
            $verificationLink .= "{$key}={$param}&";
        }

        $appName = config('app.name');
        return (new MailMessage)
                    ->subject('MyVault: Team Member Invitation')
                    ->greeting('Team Member Invitation')
                    ->line("You've been invited to join {$appName} portal as {$this->user->role->name}")
                    ->line("Please click the button below to accept this invite and complete your profile.")
                    ->action('Accept Invite', $verificationLink)
                    ->line("This will only be valid for 30 minutes.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
