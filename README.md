# Omnipay: GoCoin

**GoCoin driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/omnipay/gocoin.png?branch=master)](https://travis-ci.org/omnipay/gocoin)
[![Latest Stable Version](https://poser.pugx.org/omnipay/gocoin/version.png)](https://packagist.org/packages/omnipay/gocoin)
[![Total Downloads](https://poser.pugx.org/omnipay/gocoin/d/total.png)](https://packagist.org/packages/omnipay/gocoin)

[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements GoCoin support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "omnipay/gocoin": "~1.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* GoCoin

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository.

## Examples

There is an example PHP script in examples/example.php to show how to authenticate
with GoCoin and retrieve a token, as well as $gateway -> status (get an invoice) and
$gateway -> purchse (create an invoice).  Additionally, there is some sample code
to show how to use GoCoin webhooks.

To use it, simply set your client id and secret (or set the token to avoid authentication).
Then, set the invoice id to look one up or remove the 'die' method call around line
~97 to make a purchase.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/omnipay/gocoin/issues),
or better yet, fork the library and submit a pull request.
