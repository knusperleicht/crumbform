<?php

namespace Knusperleicht\CrumbForm\Mail\Control;

use Illuminate\Support\Facades\Log;


class MailRepository implements MailRepositoryInterface
{
    public function store(string $id, string $body)
    {

        Log::debug('ID: ' . $id . ' Body: ' . $body);
//        $mails = new MailModel();
//        $mails->content = $content;
//        $mails->header = $header;
//        $mails->ip = $ip;
//        $mails->file = $file;
//        $mails->save();
//        return $mails;
    }


    public function update(string $id)
    {
        Log::debug('ID: ' . $id);
        // TODO: Implement update() method.
    }
}
