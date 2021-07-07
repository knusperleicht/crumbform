<?php

return [
    'defaultform' => [
        'view' => 'vendor.crumbform.emails.default',
        'subject' => 'Crumbform default template',
        'from' => ['test@test.com'],
        'cc' => [],
        'bcc' => [],
        'redirect' => '',
        'copy' => [],
        'logging' => 'file',
        'rules' => [
            'name' => ['required', 'string', 'max:10'],
            'email' => 'required|email'
        ]
    ]
];
