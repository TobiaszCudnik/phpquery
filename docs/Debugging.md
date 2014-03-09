Enabling debugging
------------------

``` {.prettyprint}
// enable debugging messages
phpQuery::$debug = 1;
// enable extensive debugging messages
// used to debug document loading errors from phpQuery::newDocument()
phpQuery::$debug = 2;
```

Debugging methods
-----------------

``` {.prettyprint}
// debug inside chain
pq('.foo')->dump()->...;
pq('.foo')->dumpWhois()->...;
pq('.foo')->dumpTree()->...;
pq('.foo')->dumpDie()->...;
```


