<?php

namespace Knusperleicht\CrumbForm;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Knusperleicht\CrumbForm\Mail\Control\MailMessageSendingEvent;
use Knusperleicht\CrumbForm\Mail\Control\MailMessageSentEvent;

class CrumbFormEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Illuminate\Mail\Events\MessageSending' => [
            MailMessageSendingEvent::class,
        ],
        'Illuminate\Mail\Events\MessageSent' => [
            MailMessageSentEvent::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
