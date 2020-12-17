<?php

namespace Knusperleicht\CrumbForm\Mail\Control;

use Knusperleicht\CrumbForm\Mail\Entity\MailModel;


class MailRepository implements MailRepositoryInterface
{
    public function store(string $id, string $body): void
    {
        MailModel::create([
            'hash_id' => $id,
            'body' => htmlspecialchars($body)
        ]);
    }


    public function update(string $id): void
    {
        MailModel::where('hash_id', $id)->update(['status' => 'SENT']);
    }
}
