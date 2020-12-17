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
        $id = hash('sha256', $messageSending->message->getBody());
        $body = $messageSending->message->getBody();
        if ($logging === 'db') {
            $this->repository->store($id, $body);
        } else if ($logging === 'file') {
            Log::info('Mail message sending: ', ['id' => $id, 'body' => htmlspecialchars($body)]);
        }
    }
}
