# Revisiting PhpQuery

[![Build Status](https://travis-ci.org/c-harris/phpquery.svg?branch=master)](https://travis-ci.org/c-harris/phpquery)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/c-harris/phpquery/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/c-harris/phpquery/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/c-harris/phpquery/badge.svg?branch=master)](https://coveralls.io/github/c-harris/phpquery?branch=master)

## Basic usage of this fork

```` php
// This gives you the phpQuery object as normally used.
use PhpQuery\PhpQuery as phpQuery;

// This creates the pq() function in your namespace.
PhpQuery::use_function(__NAMESPACE__);

// This creates the pq() function in the global namespace.
PhpQuery::use_function();
````

## About this fork

This fork includes several modernizations:

* https://github.com/ralph-tice/phpquery (one commit: added WebBrowser->browserDownload)
* https://github.com/aptivate/phpquery (three commits)
* https://github.com/panrafal/phpquery (remove zend)

### github repos i've looked at:

* https://github.com/denis-isaev/phpquery
* https://github.com/r-sal/phpquery
* https://github.com/damien-list/phpquery-1
* https://github.com/nev3rm0re/phpquery
* https://github.com/Aurielle/phpquery
* https://github.com/kevee/phpquery (include php-css-parser)
* https://github.com/lucassouza1/phpquery

## Manual

* [Manual](wiki/README.md) imported from http://code.google.com/p/phpquery/wiki

## Extracts from fmorrow README.md:

### Whats phpQuery?
To quote the phpQuery *(orignally concieved and developed by Tobiasz Cudnik, available on Google Code and Github)* project documentation:

>phpQuery is a server-side, chainable, CSS3 selector driven Document Object Model (DOM) API based on jQuery JavaScript Library.
>
>Library is written in PHP5 and provides additional Command Line Interface (CLI).

### Example usage

(copied from http://code.google.com/p/phpquery/wiki/Basics)

Complete working example:

```php
<?php
include 'phpQuery-onefile.php';

$file = 'test.html'; // see below for source

// loads the file
// basically think of your php script as a regular HTML page running client side with jQuery.  This loads whatever file you want to be the current page
phpQuery::newDocumentFileHTML($file);

// Once the page is loaded, you can then make queries on whatever DOM is loaded.
// This example grabs the title of the currently loaded page.
$titleElement = pq('title'); // in jQuery, this would return a jQuery object.  I'm guessing something similar is happening here with pq.

// You can then use any of the functionality available to that pq object.  Such as getting the innerHTML like I do here.
$title = $titleElement->html();

// And output the result
echo '<h2>Title:</h2>';
echo '<p>' . htmlentities( $title) . '</p>';

?>
```

====

Source for test.html:

```html
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Hello World!</title>
</head>
<body>
</body>
</html>
```
=======
1. Merged https://github.com/kevee/phpquery/tree/phpquery-css with https://github.com/electrolinux/phpquery
2. Removed CSSParser from this repository and included it via composer
3. Added PhpQuery\ namespace
4. Adjusted the folder structure to reflect usage of PSR-4
5. Corrected the unit tests and integrated with travis-ci
>>>>>>> Updated README with project status.

Beyond these adjustments, this project will be minimally maintained. For more phpQuery usage information and fork history, I highly recommend you review the https://github.com/electrolinux/phpquery README.

## Very Similar Project

See [QueryPath](https://github.com/technosophos/querypath) for a more active project that also works
to replicate the jQuery syntax for PHP.

## My Preferred Alternative

There are several alternatives to phpQuery out there. While several have a healthy adoption rate, I was
looking for a library that leveraged SimpleXML and focused on the PHP use case rather than building all
of the functionality from scratch and adding unnecessarily methods and selectors simply for jQuery
semantic completeness. In the end, I selected to launch a project that attempts to a be a PHP-centric 
lightweight wrapper for SimpleXML. [Learn more about QuipXml.](https://github.com/wittiws/quipxml)
