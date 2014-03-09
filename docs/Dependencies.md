**phpQuery** depends on following code parts:

-   [PHP5](#PHP5)
-   [PHP5 DOM extension](#DOM_extension)
-   [Zend Framework](#Zend_Framework)

PHP5
----

Required version of PHP is [PHP5](http://www.php.net/), **5.2**
recommended.

DOM extension
-------------

PHP5's build-in [DOM extension](http://php.net/manual/en/book.dom.php)
is required. Users of [windows
XAMPP](http://www.apachefriends.org/en/xampp-windows.html) (and maybe
other unofficial PHP distributions) need to disable depracated [DOM
XML](http://php.net/manual/en/ref.domxml.php) extension. More
information can be found in [this post on
mrclay.org](http://mrclay.org/index.php/2008/10/08/getting-phpquery-running-under-xampp-for-windows/)

Zend Framework
--------------

[Zend Framework](http://framework.zend.com/) is used as HTTP Client and
JSON encoder. Those who already have Zend Framework in their
applications, can remove directory **/phpQuery/Zend**. Only condition is
having proper include path set for own copy of the library.
