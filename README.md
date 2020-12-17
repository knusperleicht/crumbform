# Laravel Email Form Api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/knusperleicht/crumbform.svg?style=flat-square)](https://packagist.org/packages/knusperleicht/email-contact-form)
[![Build Status](https://img.shields.io/travis/knusperleicht/crumbform/master.svg?style=flat-square)](https://travis-ci.org/knusperleicht/email-contact-form)
[![Quality Score](https://img.shields.io/scrutinizer/g/knusperleicht/crumbform.svg?style=flat-square)](https://scrutinizer-ci.com/g/knusperleicht/email-contact-form)
[![Total Downloads](https://img.shields.io/packagist/dt/knusperleicht/crumbform.svg?style=flat-square)](https://packagist.org/packages/knusperleicht/email-contact-form)
[![license](https://img.shields.io/packagist/dt/knusperleicht/crumbform.svg?style=flat-square)](https://packagist.org/packages/knusperleicht/email-contact-form)
https://img.shields.io/packagist/l/knusperleicht/crumbform
CrumbForm is a laravel backend plugin that lets you handle your forms for JAMStack or API-driven static websites. It
provides a fluent api interface for adding a form within a few minutes.

It offers the following features:

- Multiple contact forms
- Validation rules
- Anti-bot image captcha system (optional)
- Logging: database or file (optional)

## Missing features
- Captcha

## Installation

You can install the package via composer:

```bash
composer require knusperleicht/crumbform
```

#### Export config & views

``` bash
php artisan vendor:publish --provider="Knusperleicht\CrumbForm\CrumbFormServiceProvider" --tag="config"
php artisan vendor:publish --provider="Knusperleicht\CrumbForm\CrumbFormServiceProvider" --tag="views"
php artisan vendor:publish --provider="Knusperleicht\CrumbForm\CrumbFormServiceProvider" --tag="migrations"
```

## Example:

HTML:

- Add your crumbform url into action attribute and the method to post
- Define your fields
- Add submit button

``` html
<form action="https://your.domain.com/forms/contact-form" method="POST">
    <input type="text" name="name">
    <input type="email" name="email">
    <button type="submit">Send</button>
</form>
```

CrumbForm config:

- Set the view which you want to use
- Define the rules for defined fields in html

``` php
    'contact-form' => [
        'view' => 'vendor.crumbform.emails.default',
        'subject' => 'This a subject',
        'from' => ['support@crumbform.at'],
        'rules' => [
            'name' => ['required', 'string', 'max:10'],
            'email' => 'required|email',
        ]
    ]
```

## All config parameters

| Property  |      Type     | Description|
|-----------|:-------------:|--------:|
| view      | string *      | View which should be used for emails | 
| subject   | string *      |  Email subject |
| from      | string *      |  Who send the mail |
| cc        | array         |  Carbon copy. With all recipients |
| bcc       | array         |  Blind carbon copy. Without recipients |
| copy      | array         |  field_send_copy: Can be name of the checkbox in the form or boolean (true/false |
|           |               |  field_email: Email field in the form |
| logging   | string        |  Can be db or file  |
| rules     | array *        | Validation rules for your input form ([Validation Rules](https://laravel.com/docs/8.x/validation#available-validation-rules)) |

* Required properties in the array

## Example with all parameters

``` php

return [

    'formname' => [
        'view' => 'vendor.crumbform.emails.test',
        'subject' => 'This a test',
        'from' => ['support@knusperleicht.at'],
        'bcc' => [''],
        'cc' => [''],
        'copy' => ['field_send_copy' => 'form_copy', 'field_email' => 'form_email'],
        'logging' => 'db',
        'rules' => [
            'name' => ['required', 'string', 'max:10'],
            'email' => 'required|email',
            'copy' => ''
        ]
    ]
];
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email christian.behon@knusperleicht.at instead of using the issue
tracker.

## Credits

- [Mathias](https://github.com/knusperleicht)
- [Christian](https://github.com/knusperleicht)
- [Sebastian](https://github.com/knusperleicht)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
