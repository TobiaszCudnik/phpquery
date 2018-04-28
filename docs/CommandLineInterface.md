**Labels:**Featured phpQuery features CommandLineInterface aka CLI.

``` php
Usage: phpquery URL --method1 arg1 arg2 argN --method2 arg1 arg2 argN ...
Example: phpquery 'http://localhost' --find 'div > p' --contents
Pipe: cat index.html | phpquery --find 'div > p' --contents
Docs: 
```

Example
-------

Fetch.md number of downloads of all release packages.

``` php
phpquery 'http://code.google.com/p/phpquery/downloads/list?can=1' \
  --find '.vt.col_4 a' --contents \
  --getString null array_sum
```


