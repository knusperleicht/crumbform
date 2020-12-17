<?php

namespace Knusperleicht\CrumbForm\Mail\Control;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;

    private $mailFrom;
    private $mailInput;
    private $mailSendCopy;
    private $mailSubject;
    private $mailView;
    private $mailCC;
    private $mailBCC;


    public function __construct(array $from, string $subject, string $view, ?array $bcc, ?array $cc, array $input)
    {
        $this->mailInput = $input;
        $this->mailFrom = $from;
        $this->mailSubject = $subject;
        $this->mailView = $view;
        $this->mailCC = $cc;
        $this->mailBCC = $bcc;
    }

    /**
     * Creates message which will be send
     * @return Mailable
     */
    public function build(): Mailable
    {
        $mail = $this->view($this->mailView)
            ->replyTo($this->mailFrom)
            ->subject($this->mailSubject)
            ->with($this->mailInput);

        if (!empty($this->mailBCC)) {
            $mail = $mail->bcc($this->mailBCC);
        }

        if (!empty($this->mailCC)) {
            $mail = $mail->cc($this->mailCC);
        }

        return $mail;
    }
}
