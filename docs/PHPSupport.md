**Labels:**Featured,Phase-Implementation Although **phpQuery** is a
[jQuery port](jQueryPortingState.md), there is extensive PHP-specific
support.

Table of Contents
=================

[Class Interfaces](#Class_Interfaces)

-   [Iterator Interface](#Iterator)
-   [ArrayAccess](#Array_Access)
-   [Countable Interface](#Countable)

[Callbacks](Callbacks.md)

[PHP Code Support](#PHP_Code_Support)

-   [Opening PHP files as DOM](#Opening_PHP_files_as_DOM)
-   [Inputting PHP code](#Inputting_PHP_code)
-   [Outputting PHP code](#Outputting_PHP_code)

Class Interfaces
----------------

phpQuery implements some of [Standard PHP Library
(SPL)](http://pl.php.net/spl) interfaces.

#### Iterator

Iterator interface allows looping objects thou native PHP **foreach
loop**. Example:

``` php
// get all direct LI elements from UL list of class 'im-the-list'
$LIs = pq('ul.im-the-list > li');
foreach($LIs as $li) {
  pq($li)->addClass('foreached');
}
```

Now there is a catch above. Foreach loop **doesn't return phpQuery
object**. Instead it returns pure DOMNode. That's how jQuery does,
because not always you need **phpQuery** when you found interesting
nodes.

#### Array Access

If you like writing arrays, with phpQuery you can still do it, thanks to
the ArrayAccess interface.

``` php
$pq = phpQuery::newDocumentFile('somefile.html');
// print first list outer HTML
print $pq['ul:first'];
// change INNER HTML of second LI directly in first UL
$pq['ul:first > li:eq(1)'] = 'new inner html of second LI directly in first UL';
// now look at the difference (outer vs inner)
print $pq['ul:first > li:eq(1)'];
// will print <li>new inner html of second LI directly in first UL</li>
```

#### Countable

If used to do `count($something)` you can still do this that way,
instead of eg `pq('p')->size()`.

``` php
// count all direct LIs in first list
print count(pq('ul:first > li'));
```

Callbacks
---------

There is a special [Callbacks](Callbacks.md) wiki section, to which you
should refer to.

PHP Code Support
----------------

#### Opening PHP files as DOM

PHP files can be opened using **phpQuery::newDocumentPHP($markup)** or
**phpQuery::newDocumentFilePHP($file)**. Such files are visible as DOM,
where:

-   PHP tags beetween DOM elements are available (queryable) as
    `<php> ...code... </php>`
-   PHP tags inside attributes are HTML entities
-   PHP tags between DOM element's attributes are **not yet supported**

#### Inputting PHP code

Additional methods allows placing PHP code inside DOM. Below each method
visible is it's logic equivalent.

**attrPHP**($attr, $code)

-   [attr](http://docs.jquery.com/Attributes/attr)($attr, "\<?php
    $code ?\>")

**addClassPHP**($code)

-   [addClass](http://docs.jquery.com/Attributes/addClass)("\<?php
    $code ?\>")

**beforePHP**($code)

-   [before](http://docs.jquery.com/Manipulation/before)("\<?php $code
    ?\>")

**afterPHP**($code)

-   [after](http://docs.jquery.com/Manipulation/after)("\<?php $code
    ?\>")

**prependPHP**($code)

-   [prepend](http://docs.jquery.com/Manipulation/prepend)("\<?php
    $code ?\>")

**appendPHP**($code)

-   [append](http://docs.jquery.com/Manipulation/append)("\<?php $code
    ?\>")

**php**($code)

-   [html](http://docs.jquery.com/Manipulation/html)("\<?php $code
    ?\>")

**wrapAllPHP**($codeBefore, $codeAfter)

-   [wrapAll](http://docs.jquery.com/Manipulation/wrapAll)("\<?php
    $codeBefore?\>\<?php $codeAfter ?\>")

**wrapPHP**($codeBefore, $codeAfter)

-   [wrap](http://docs.jquery.com/Manipulation/wrap)("\<?php
    $codeBefore?\>\<?php $codeAfter ?\>")

**wrapInnerPHP**($codeBefore, $codeAfter)

-   [wrapInner](http://docs.jquery.com/Manipulation/wrapInner)("\<?php
    $codeBefore?\>\<?php $codeAfter ?\>")

**replaceWithPHP**($code)

-   [replaceWith](http://docs.jquery.com/Manipulation/replaceWith)("\<?php
    $code ?\>")

#### Outputting PHP code

Code inserted with methods above won't be returned as valid (runnable)
using classic output methods such as **html()**. To make it work,
**php()** method without parameter have to be used. Optionaly
**phpQuery::markupToPHP($markup)** can activate tags in string outputed
before. **REMEMBER** Outputing runnable code and placing it on webserver
is always dangerous !
