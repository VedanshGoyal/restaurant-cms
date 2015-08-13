<?php

namespace Restaurant\Listeners;

use Illuminate\Mail\Mailer;
use Restaurant\Events\UserCreateEvent;
use Restaurant\Events\UserResetEvent;
use Log;

class UserEventListener
{
    /**
     * Intialize a new instance
     *
     * @param Illuminate\Mail\Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Subscribe to the events
     *
     * @param Illuminate\Events\Dispatcher $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            'Restaurant\Events\UserCreateEvent',
            'Restaurant\Listeners\UserEventListener@onUserCreate'
        );

        $events->listen(
            'Restaurant\Events\PasswordResetEvent',
            'Restaurant\Listeners\UserEventListener@onPasswordReset'
        );
    }

    public function onUserCreate(UserCreateEvent $event)
    {
        $user = $event->user;
        $url = url(route('verify-new', ['token' => $user->createToken]));

        $this->mailer->send('emails.verify-new', ['verifyUrl' => $url], function ($mailer) use ($user) {
            $mailer->subject('Verify New Account')
                ->from('me@nickc.io', 'Nick C')
                ->to('me@nickc.io', 'Nick C');
        });
    }

    public function onPasswordReset(UserResetEvent $event)
    {
        $user = $event->user;
        $url = url(route('verify-reset', ['token' => $user->resetToken]));

        $this->mailer->send('emails.verify-reset', ['verifyUrl' => $url], function ($mailer) use ($userS) {
            $mailer->subject('Password Reset')
                ->from('me@nickc.io', 'Nick C')
                ->to('me@nickc.io', 'Nick C');
        });
    }
}
