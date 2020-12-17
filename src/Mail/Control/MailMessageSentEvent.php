<?php

namespace Knusperleicht\CrumbForm\Mail\Control;

use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Log;

class MailMessageSentEvent
{

    private $repository;

    public function __construct(MailRepositoryInterface $mailRepository)
    {
        $this->repository = $mailRepository;
    }

    public function handle(MessageSent $messageSent): void
    {
        $logging = config($messageSent->data['configName'] . 'logging');
        $id = hash('sha256', $messageSent->message->getBody());
        if ($logging === 'db') {
            $this->repository->update($id);
        } else if ($logging === 'file') {
            Log::info('Mail message sent: ', ['id' => $id]);
        }
    }
}
