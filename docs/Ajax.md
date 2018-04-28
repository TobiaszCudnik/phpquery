Example
-------

``` php
pq('#element')->load('http://somesite.com/page .inline-selector')->...
```

Table of Contents
=================

-   [Server Side Ajax](#Server_Side_Ajax)
-   [Cross Domain Ajax](#Cross_Domain_Ajax)
-   [Ajax Requests](#Ajax_Requests)
-   [Ajax Events](#Ajax_Events)
-   [Misc](#Misc)

Server Side Ajax
----------------

Ajax, standing for *Asynchronous JavaScript and XML* is combination of
HTTP Client and XML parser which doesn't lock program's thread (doing
request in asynchronous way).

**phpQuery** also offers such functionality, making use of solid quality
[Zend\_Http\_Client](http://framework.zend.com/manual/en/zend.http.html).
Unfortunately requests aren't asynchronous, but nothing is impossible.
For today, instead of
[XMLHttpRequest](http://en.wikipedia.org/wiki/XMLHttpRequest) you always
get Zend\_Http\_Client instance. API unification is
[planned](http://code.google.com/p/phpquery/issues/detail?id=44).

Cross Domain Ajax
-----------------

For security reasons, by default **phpQuery** doesn't allow connections
to hosts other than actual `$_SERVER['HTTP_HOST']`. Developer needs to
grant rights to other hosts before making an [Ajax](Ajax.md) request.

There are 2 methods for allowing other hosts

-   phpQuery::**ajaxAllowURL**($url)
-   phpQuery::**ajaxAllowHost**($host)

``` php
// connect to google.com
phpQuery::ajaxAllowHost('google.com');
phpQuery::get('http://google.com/ig');
// or using same string
$url = 'http://google.com/ig';
phpQuery::ajaxAllowURL($url);
phpQuery::get($url);
```

Ajax Requests
-------------

-   **[phpQuery::ajax](http://docs.jquery.com/Ajax/jQuery.ajax)**[($options)](http://docs.jquery.com/Ajax/jQuery.ajax)
    Load a remote page using an HTTP request.
-   **[load](http://docs.jquery.com/Ajax/load)**[($url, $data,
    $callback)](http://docs.jquery.com/Ajax/load) Load HTML from a
    remote file and inject it into the DOM.
-   **[phpQuery::get](http://docs.jquery.com/Ajax/jQuery.get)**[($url,
    $data, $callback)](http://docs.jquery.com/Ajax/jQuery.get) Load a
    remote page using an HTTP GET request.
-   **[phpQuery::getJSON](http://docs.jquery.com/Ajax/jQuery.getJSON)**[($url,
    $data, $callback)](http://docs.jquery.com/Ajax/jQuery.getJSON)
    Load JSON data using an HTTP GET request.
-   **[phpQuery::getScript](http://docs.jquery.com/Ajax/jQuery.getScript)**[($url,
    $callback)](http://docs.jquery.com/Ajax/jQuery.getScript) Loads,
    and executes, a local JavaScript file using an HTTP GET request.
-   **[phpQuery::post](http://docs.jquery.com/Ajax/jQuery.post)**[($url,
    $data, $callback,
    $type)](http://docs.jquery.com/Ajax/jQuery.post) Load a remote page
    using an HTTP POST request.

Ajax Events
-----------

-   **[ajaxComplete](http://docs.jquery.com/Ajax/ajaxComplete)**[($callback)](http://docs.jquery.com/Ajax/ajaxComplete)
    Attach a function to be executed whenever an AJAX request completes.
    This is an Ajax Event.
-   **[ajaxError](http://docs.jquery.com/Ajax/ajaxError)**[($callback)](http://docs.jquery.com/Ajax/ajaxError)
    Attach a function to be executed whenever an AJAX request fails.
    This is an Ajax Event.
-   **[ajaxSend](http://docs.jquery.com/Ajax/ajaxSend)**[($callback)](http://docs.jquery.com/Ajax/ajaxSend)
    Attach a function to be executed before an AJAX request is sent.
    This is an Ajax Event.
-   **[ajaxStart](http://docs.jquery.com/Ajax/ajaxStart)**[($callback)](http://docs.jquery.com/Ajax/ajaxStart)
    Attach a function to be executed whenever an AJAX request begins and
    there is none already active. This is an Ajax Event.
-   **[ajaxStop](http://docs.jquery.com/Ajax/ajaxStop)**[($callback)](http://docs.jquery.com/Ajax/ajaxStop)
    Attach a function to be executed whenever all AJAX requests have
    ended. This is an Ajax Event.
-   **[ajaxSuccess](http://docs.jquery.com/Ajax/ajaxSuccess)**[($callback)](http://docs.jquery.com/Ajax/ajaxSuccess)
    Attach a function to be executed whenever an AJAX request completes
    successfully. This is an Ajax Event.

Misc
----

-   **[phpQuery::ajaxSetup](http://docs.jquery.com/Ajax/jQuery.ajaxSetup)**[($options)](http://docs.jquery.com/Ajax/jQuery.ajaxSetup)
    Setup global settings for AJAX requests.
-   **[serialize](http://docs.jquery.com/Ajax/serialize)**[()](http://docs.jquery.com/Ajax/serialize)
    Serializes a set of input elements into a string of data. This will
    serialize all given elements.
-   **[serializeArray](http://docs.jquery.com/Ajax/serializeArray)**[()](http://docs.jquery.com/Ajax/serializeArray)
    Serializes all forms and form elements (like the .serialize()
    method) but returns a JSON data structure for you to work with.

Options
-------

Detailed options description in available at [jQuery Documentation
Site](http://docs.jquery.com/Ajax/jQuery.ajax#toptions).

-   **`async`** `Boolean`
-   **`beforeSend`** `Function`
-   **`cache`** `Boolean`
-   **`complete`** `Function`
-   **`contentType`** `String`
-   **`data`** `Object, String`
-   **`dataType`** `String`
-   **`error`** `Function`
-   **`global`** `Boolean`
-   **`ifModified`** `Boolean`
-   **`jsonp`** `String`
-   **`password`** `String`
-   **`processData`** `Boolean`
-   **`success`** `Function`
-   **`timeout`** `Number`
-   **`type`** `String`
-   **`url`** `String`
-   **`username`** `String`

Read more at [Ajax](http://docs.jquery.com/Ajax) section on [jQuery
Documentation Site](http://docs.jquery.com/).
