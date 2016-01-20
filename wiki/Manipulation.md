## Example
```
pq('div.old')->replaceWith( pq('div.new')->clone() )->appendTo('.trash')->prepend('Deleted')->...
```
# Table of Contents
  * [Changing Contents](#Changing_Contents.md)
  * [Inserting Inside](#Inserting_Inside.md)
  * [Inserting Outside](#Inserting_Outside.md)
  * [Inserting Around](#Inserting_Around.md)
  * [Replacing](#Replacing.md)
  * [Removing](#Removing.md)
  * [Copying](#Copying.md)
## Changing Contents
  * **[html](http://docs.jquery.com/Manipulation/html)**[()](http://docs.jquery.com/Manipulation/html) Get the html contents (innerHTML) of the first matched element. This property is not available on XML documents (although it will work for XHTML documents).
  * **[html](http://docs.jquery.com/Manipulation/html)**[($val)](http://docs.jquery.com/Manipulation/html) Set the html contents of every matched element. This property is not available on XML documents (although it will work for XHTML documents).
  * **[text](http://docs.jquery.com/Manipulation/text)**[()](http://docs.jquery.com/Manipulation/text) Get the combined text contents of all matched elements.
  * **[text](http://docs.jquery.com/Manipulation/text)**[($val)](http://docs.jquery.com/Manipulation/text) Set the text contents of all matched elements.
## Inserting Inside
  * **[append](http://docs.jquery.com/Manipulation/append)**[($content)](http://docs.jquery.com/Manipulation/append) Append content to the inside of every matched element.
  * **[appendTo](http://docs.jquery.com/Manipulation/appendTo)**[($content)](http://docs.jquery.com/Manipulation/appendTo) Append all of the matched elements to another, specified, set of elements.
  * **[prepend](http://docs.jquery.com/Manipulation/prepend)**[($content)](http://docs.jquery.com/Manipulation/prepend) Prepend content to the inside of every matched element.
  * **[prependTo](http://docs.jquery.com/Manipulation/prependTo)**[($content)](http://docs.jquery.com/Manipulation/prependTo) Prepend all of the matched elements to another, specified, set of elements.
## Inserting Outside
  * **[after](http://docs.jquery.com/Manipulation/after)**[($content)](http://docs.jquery.com/Manipulation/after) Insert content after each of the matched elements.
  * **[before](http://docs.jquery.com/Manipulation/before)**[($content)](http://docs.jquery.com/Manipulation/before) Insert content before each of the matched elements.
  * **[insertAfter](http://docs.jquery.com/Manipulation/insertAfter)**[($content)](http://docs.jquery.com/Manipulation/insertAfter) Insert all of the matched elements after another, specified, set of elements.
  * **[insertBefore](http://docs.jquery.com/Manipulation/insertBefore)**[($content)](http://docs.jquery.com/Manipulation/insertBefore) Insert all of the matched elements before another, specified, set of elements.
## Inserting Around
  * **[wrap](http://docs.jquery.com/Manipulation/wrap)**[($html)](http://docs.jquery.com/Manipulation/wrap) Wrap each matched element with the specified HTML content.
  * **[wrap](http://docs.jquery.com/Manipulation/wrap)**[($elem)](http://docs.jquery.com/Manipulation/wrap) Wrap each matched element with the specified element.
  * **[wrapAll](http://docs.jquery.com/Manipulation/wrapAll)**[($html)](http://docs.jquery.com/Manipulation/wrapAll) Wrap all the elements in the matched set into a single wrapper element.
  * **[wrapAll](http://docs.jquery.com/Manipulation/wrapAll)**[($elem)](http://docs.jquery.com/Manipulation/wrapAll) Wrap all the elements in the matched set into a single wrapper element.
  * **[wrapInner](http://docs.jquery.com/Manipulation/wrapInner)**[($html)](http://docs.jquery.com/Manipulation/wrapInner) Wrap the inner child contents of each matched element (including text nodes) with an HTML structure.
  * **[wrapInner](http://docs.jquery.com/Manipulation/wrapInner)**[($elem)](http://docs.jquery.com/Manipulation/wrapInner) Wrap the inner child contents of each matched element (including text nodes) with a DOM element.
## Replacing
  * **[replaceWith](http://docs.jquery.com/Manipulation/replaceWith)**[($content)](http://docs.jquery.com/Manipulation/replaceWith) Replaces all matched elements with the specified HTML or DOM elements.
  * **[replaceAll](http://docs.jquery.com/Manipulation/replaceAll)**[($selector)](http://docs.jquery.com/Manipulation/replaceAll) Replaces the elements matched by the specified selector with the matched elements.
## Removing
  * **[empty](http://docs.jquery.com/Manipulation/empty)**[()](http://docs.jquery.com/Manipulation/empty) Remove all child nodes from the set of matched elements.
  * **[remove](http://docs.jquery.com/Manipulation/remove)**[($expr)](http://docs.jquery.com/Manipulation/remove) Removes all matched elements from the DOM.
## Copying
  * **[clone](http://docs.jquery.com/Manipulation/clone)**[()](http://docs.jquery.com/Manipulation/clone) Clone matched DOM Elements and select the clones.
  * **[clone](http://docs.jquery.com/Manipulation/clone)**[($true)](http://docs.jquery.com/Manipulation/clone) Clone matched DOM Elements, and all their event handlers, and select the clones.

Read more at [Manipulation](http://docs.jquery.com/Manipulation) section on [jQuery Documentation Site](http://docs.jquery.com/).