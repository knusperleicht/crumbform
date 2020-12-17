# Laravel Email Contact Api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/knusperleicht/email-contact-form.svg?style=flat-square)](https://packagist.org/packages/knusperleicht/email-contact-form)
[![Build Status](https://img.shields.io/travis/knusperleicht/email-contact-form/master.svg?style=flat-square)](https://travis-ci.org/knusperleicht/email-contact-form)
[![Quality Score](https://img.shields.io/scrutinizer/g/knusperleicht/email-contact-form.svg?style=flat-square)](https://scrutinizer-ci.com/g/knusperleicht/email-contact-form)
[![Total Downloads](https://img.shields.io/packagist/dt/knusperleicht/email-contact-form.svg?style=flat-square)](https://packagist.org/packages/knusperleicht/email-contact-form)

CrumbForm is a laravel backend plugin that lets you handle your forms for JAMStack or API-driven static websites. It
provides a fluent api interface for adding a form within a few minutes.

It offers the following features:

- Multiple contact forms
- Validation rules
- Anti-bot image captcha system (optional)
- Log emails in database (optional)

## Installation

You can install the package via composer:

```bash
composer require knusperleicht/crumbform
```

#### Export config & views

``` bash
php artisan vendor:publish --provider="Knusperleicht\CrumbForm\CrumbFormServiceProvider" --tag="config"
php artisan vendor:publish --provider="Knusperleicht\CrumbForm\CrumbFormServiceProvider" --tag="views"
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

``` php
    'contact-form' => [
        'view' => 'vendor.crumbform.emails.default',
        'subject' => 'This a subject',
        'from' => ['support@crumbform.at'],
        'cc' => [], // CC receipients (Default: [])
        'bcc' => [], // BCC receipients (Default: [])
        'copy' => false, // Send copy to from (Default: false)
        'rules' => [
            'field1' => 'required|string|max:10',
            'field2' => 'required|email',
        ]
    ]
```

``` php
// Usage description here
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
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
