<?php

namespace Knusperleicht\CrumbForm\Mail\Control;

use Illuminate\Mail\Events\MessageSending;
use Illuminate\Support\Facades\Log;

class MailMessageSendingEvent
{
    private $repository;

    public function __construct(MailRepositoryInterface $mailRepository)
    {
        $this->repository = $mailRepository;
    }

    public function handle(MessageSending $messageSending): void
    {
        $logging = config($messageSending->data['configName'] . 'logging');
        if ($logging === 'db') {
            $id = hash('sha256', $messageSending->message->getBody());
            $this->repository->store($id, $messageSending->message->getBody());
        } else if ($logging === 'file') {
            Log::debug('MailMessageSendingEvent');
        }
    }
}
