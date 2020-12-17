<?php

namespace Knusperleicht\CrumbForm\Mail\Entity;

use Illuminate\Database\Eloquent\Model;

class MailModel extends Model
{
    protected $table = 'mails';
    protected $fillable = ['hash_id', 'body'];
}
