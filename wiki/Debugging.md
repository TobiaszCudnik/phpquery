## Enabling debugging
```
// enable debugging messages
phpQuery::$debug = 1;
// enable extensive debugging messages
// used to debug document loading errors from phpQuery::newDocument()
phpQuery::$debug = 2;
```
## Debugging methods
```
// debug inside chain
pq('.foo')->dump()->...;
pq('.foo')->dumpWhois()->...;
pq('.foo')->dumpTree()->...;
pq('.foo')->dumpDie()->...;
```