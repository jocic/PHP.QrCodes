# QR Codes

[![Build Status](https://travis-ci.org/jocic/PHP.QrCodes.svg?branch=master)](https://travis-ci.org/jocic/PHP.QrCodes) [![Coverage Status](https://coveralls.io/repos/github/jocic/PHP.QrCodes/badge.svg?branch=master)](https://coveralls.io/github/jocic/PHP.QrCodes?branch=master) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/7cfced1454964bd8a1cb0ef0134eec16)](https://www.codacy.com/app/jocic/PHP.QrCodes?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=jocic/PHP.GoogleAuthenticator&amp;utm_campaign=Badge_Grade) [![Latest Stable Version](https://poser.pugx.org/jocic/qr-codes/v/stable)](https://packagist.org/packages/jocic/qr-codes) [![License](https://poser.pugx.org/jocic/qr-codes/license)](https://packagist.org/packages/jocic/qr-codes)

QR Codes is a PHP library providing a simple API for generating QR codes both locally and remotely.

[![Buy Me Coffee](images/buy-me-coffee.png)](https://www.paypal.me/DjordjeJocic)

**Project is still under development...slow ride...take it easy...**

## Versioning Scheme

I use a 3-digit [Semantic Versioning](https://semver.org/spec/v2.0.0.html) identifier, for example 1.0.2. These digits have the following meaning:

*   The first digit (1) specifies the MAJOR version number.
*   The second digit (0) specifies the MINOR version number.
*   The third digit (2) specifies the PATCH version number.

Complete documentation can be found by following the link above.

## Requirements

You only need to have PHP >=7.0 available on your system to use **QR Codes** in your application. However, for running unit tests, you need to have the following extensions installed:

*   [Multibyte String](https://secure.php.net/manual/en/book.mbstring.php)
*   [DOM](https://secure.php.net/manual/en/dom.setup.php)

## Installation

There's two ways you can add **QR Codes** library to your project:

*   Copying files from the "source" directory to your project and requiring the "Autoload.php" script
*   Via Composer, by executing the command below

```bash
composer require jocic/qr-codes dev-master
```

## Tests

Following unit tests are available:

*   **Essentials** - Tests for library's essential elements.

You can execute them easily from the terminal like in the example below.

```bash
bash ./scripts/phpunit.sh --testsuite essentials
```

Please don’t forget to install necessary dependencies before attempting to do the God's work above. They may be important.

```bash
bash ./scripts/composer.sh install
```

## Contribution

Please review the following documents if you are planning to contribute to the project:

*   [Contributor Covenant Code of Conduct](code-of-conduct.md)
*   [Contribution Guidelines](contributing.md)
*   [Pull Request Template](pull-request-template.md)
*   [MIT License](license.md)

## Integration

My hourly rate is fairly reasonable so, if you need help with integrating **QR Codes** to your existing project, feel free to contact me via the email below.

Integration inquiries: [office@djordjejocic.com](mailto:office@djordjejocic.com)

## Support

Please don't hesitate to contact me if you have any questions, ideas, or concerns.

My Twitter account is: [@jocic_91](https://www.twitter.com/jocic_91)

My support E-Mail address is: [support@djordjejocic.com](mailto:support@djordjejocic.com)

## Copyright & License

Copyright (C) 2018 Đorđe Jocić

Licensed under the MIT license.
