<?php

namespace Restaurant\Listeners;

use Illuminate\Mail\Mailer;
use Restaurant\Events\UserCreateEvent;
use Restaurant\Events\UserResetEvent;
use Log;

class UserEventListener
{
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
            'Restaurant\Events\UserResteEvent',
            'Restaurant\Listeners\UserEventListener@onUserReset'
        );
    }

    public function onUserCreate(UserCreateEvent $event)
    {
        $user = $event->user;
        $url = url(route('verify-new', ['token' => $user->createToken]));

        $this->mailer->send('emails.verify-create', ['verifyUrl' => $url], function ($mailer) use ($user) {
            $mailer->to('me@nickc.io', 'Test User')
                ->from('me@nickc.io', 'Nick C')
                ->subject('Verify Account');
        });
    }

    public function onUserReset(UserResetEvent $event)
    {
        Log::info('user reset event');
    }
}
