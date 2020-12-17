<?php

namespace Knusperleicht\CrumbForm\Mail\Control;


interface MailRepositoryInterface
{
    public function store(string $id, string $body) : void;

    public function update(string $id) : void;
}
