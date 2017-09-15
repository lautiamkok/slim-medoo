# Slim + Medoo

> Using Medoo with Slim3.

## Setup

``` bash
# Installation
$ composer install

# Production
$ cd [my-app-name]
$ php -S 0.0.0.0:8080 -t public
```

Then, access the app at http://localhost:8080/

## Docs

* [Slim](https://www.slimframework.com/docs/) - A PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.
* [Monolog](https://github.com/Seldaek/monolog) - Sends your logs to files, sockets, inboxes, databases and various web services.
* [Medoo](https://medoo.in/doc) - The lightest PHP database framework to accelerate development.
* [The League Container (Dependency Injection)](https://github.com/thephpleague/container) - A simple but powerful dependency injection container.
* [ramsey/uuid](https://github.com/ramsey/uuid) - A PHP 5.4+ library for generating RFC 4122 version 1, 3, 4, and 5 universally unique identifiers (UUID).

## Notes

1. [Operation timed out (IPv6 issues)](https://getcomposer.org/doc/articles/troubleshooting.md#operation-timed-out-ipv6-issues-). On linux, it seems that running this command helps to make ipv4 traffic have a higher prio than ipv6, which is a better alternative than disabling ipv6 entirely:

`$ sudo sh -c "echo 'precedence ::ffff:0:0/96 100' >> /etc/gai.conf"`

2. Run `$ sudo composer self-update` regularly.
