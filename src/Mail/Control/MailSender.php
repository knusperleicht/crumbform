<?php

namespace Knusperleicht\CrumbForm\Mail\Control;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

//use Illuminate\Support\HtmlString;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;

    private $mailFrom;
    private $mailInput;
    private $mailIsCopy;
    private $mailSubject;
    private $mailView;


    public function __construct(array $from, string $subject, array $input, bool $copy, string $view)
    {
        $this->mailInput = $input;
        $this->mailIsCopy = $copy;
        $this->mailFrom = $from;
        $this->mailSubject = $subject;
        $this->mailView = $view;
    }

    /**
     * Creates form messages which will be send
     * @return Mailable
     */
    public function build(): Mailable
    {
        $mail = $this->view($this->mailView)
            ->subject($this->mailSubject)
            ->with($this->mailInput);

        if ($this->mailIsCopy) {
            $mail = $mail->cc($this->mailFrom);
        }
        //if (file_exists($this->file) && !is_null($this->filename)) {
        //$mail = $mail->attach($this->file, ['as' => $this->filename]);
        //}
        return $mail;
    }
}
