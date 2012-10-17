Ration
======

What is Ration
--------------

Ration is a very simple PHP library for interacting with Redis servers.

Why build another library?
--------------------------

The current PHP libraries are overly complicated for something that should be very quick and simple.
There are some great PHP extensions for communicating with Redis, however these need to be compiled and enabled on your machine
which isn't always practical. This library is simple, lightweight and portable.

Requirements
------------

* PHP 5.3.3+

Installation
------------

We recommend using Composer to add ration to your project. Simply add this to your composer config:

```yaml
{
    "require": {
        "versionable/ration": "1.0.0"
    }
}
```

Usage
-----

Pinging a remote server

```php
    $address = new TCP('10.0.0.1', 6379);
    $connection = new Connection($address);
    $client = new Client($connection);

    $request = new Request(new PingCommand());
    $response = $client->send($request);
```

Set then get a key

```php
    $address = new TCP('10.0.0.1', 6379);
    $connection = new Connection($address);
    $client = new Client($connection);

    $request = new Request(new SetCommand('key', 'value'));
    $client->send($request);

    $request = new Request(new GetCommand('key'));
    $response = $client->send($response);
```

TODO
----

* Complete documentation of current API
* Implement remaining commands
