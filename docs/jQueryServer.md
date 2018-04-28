**Labels:**Featured **jQueryServer** is a jQuery plugin giving
unobstrusive, client-side bindings to server-side implementation of
jQuery.

Example scenario
----------------

1.  Connect to server and make an [Ajax](Ajax.md) request to somewhere
    ([crossdomain allowed](CrossDomainAjax.md))
2.  Do some manipulations, you can even trigger a [server-side
    event](Events#Server_Side_Events.md)
3.  Get processed date back to the browser

Example code
------------

``` php
$.server({url: 'http://somesite.com'})
  .find('.my-class')
    .client(function(response){
      $('.destination').html(response);
});
```

Since version **0.5.1** (this is **not** phpQuery release version
number) there is a support for config file which **authorizes**
[Ajax](Ajax.md) hosts and referers.
