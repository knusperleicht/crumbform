<?php


namespace Knusperleicht\CrumbForm\Mail\Control;


use Illuminate\Support\Facades\Mail;

class MailService implements MailServiceInterface
{

    public function __construct()
    {

    }

    public function send(string $configName, array $input): void
    {
        $from = config($configName . 'from');
        $cc = config($configName . 'cc');
        $subject = config($configName . 'subject');
        $copy = config($configName . 'copy');
        $view = config($configName . 'view');

        Mail::to($from)
            ->to($from)
            ->cc($cc)
            ->send(new MailSender($from, $subject, $input, $copy, $view)
            );
    }
}
