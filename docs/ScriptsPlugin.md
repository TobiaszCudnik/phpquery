**Labels:**Plugin ScriptsPlugin simplifies writing short code scripts
which can be easily reused (chained). It removes plugin overhead
allowing script to be one-line command.

Using scripts
-------------

Before using any script, you need to load **Scripts** plugin, like so:

``` php
phpQuery::plugin('Scripts');
// or inside a chain
pq('li')->plugin('Scripts');
```

After that, any available script can be used thou **script** method.

``` php
print pq('div')->script('safe_print');
```

Writing scripts
---------------

Scripts are placed in **/phpQuery/plugins/Scripts**. Each script has
it's own file. Each file has access to 4 variables:

-   **$self** Represents $this
-   **$params** Represents parameters passed to script() method
    (without script name)
-   **$return** If not null, will be used as method result
-   **$config** Content of **config.php file

By default each script returns $self aka $this.

##### Example script

``` php
$return = $self->find($params[0]);
```


