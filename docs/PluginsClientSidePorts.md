In [Issue Tracker](http://code.google.com/p/phpquery/issues/list) there
is a list of [plugins which are planned to be
ported](http://code.google.com/p/phpquery/issues/list?can=2&q=label%3APort).

JSON
----

Port of [JSON](http://jollytoad.googlepages.com/json.js) plugin.

``` php
$jsonString = phpQuery::toJSON( pq('form')->serializeArray() );
$array = phpQuery::parseJSON('{"foo": "bar"}');
```


