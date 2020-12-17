<?php


namespace Knusperleicht\CrumbForm\Mail\Control;


interface MailServiceInterface
{
    public function send(string $configName, array $input): void;
}
