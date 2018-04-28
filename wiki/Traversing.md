## Example
```
pq('div > p')->add('div > ul')->filter(':has(a)')->find('p:first')->nextAll()->andSelf()->...
```
# Table of Contents
  * [Filtering](#Filtering.md)
  * [Finding](#Finding.md)
  * [Chaining](#Chaining.md)
## Filtering
  * **[eq](http://docs.jquery.com/Traversing/eq)**[($index)](http://docs.jquery.com/Traversing/eq) Reduce the set of matched elements to a single element.
  * **[hasClass](http://docs.jquery.com/Traversing/hasClass)**[($class)](http://docs.jquery.com/Traversing/hasClass) Checks the current selection against a class and returns true, if at least one element of the selection has the given class.
  * **[filter](http://docs.jquery.com/Traversing/filter)**[($expr)](http://docs.jquery.com/Traversing/filter) Removes all elements from the set of matched elements that do not match the specified expression(s).
  * **[filter](http://docs.jquery.com/Traversing/filter)**[($fn)](http://docs.jquery.com/Traversing/filter) Removes all elements from the set of matched elements that does not match the specified function.
  * **[is](http://docs.jquery.com/Traversing/is)**[($expr)](http://docs.jquery.com/Traversing/is) Checks the current selection against an expression and returns true, if at least one element of the selection fits the given expression.
  * **[map](http://docs.jquery.com/Traversing/map)**[($callback)](http://docs.jquery.com/Traversing/map) Translate a set of elements in the jQuery object into another set of values in an array (which may, or may not, be elements).
  * **[not](http://docs.jquery.com/Traversing/not)**[($expr)](http://docs.jquery.com/Traversing/not) Removes elements matching the specified expression from the set of matched elements.
  * **[slice](http://docs.jquery.com/Traversing/slice)**[($start, $end)](http://docs.jquery.com/Traversing/slice) Selects a subset of the matched elements.
## Finding
  * **[add](http://docs.jquery.com/Traversing/add)**[($expr)](http://docs.jquery.com/Traversing/add) Adds more elements, matched by the given expression, to the set of matched elements.
  * **[children](http://docs.jquery.com/Traversing/children)**[($expr)](http://docs.jquery.com/Traversing/children) Get a set of elements containing all of the unique immediate children of each of the matched set of elements.
  * **[contents](http://docs.jquery.com/Traversing/contents)**[()](http://docs.jquery.com/Traversing/contents) Find all the child nodes inside the matched elements (including text nodes), or the content document, if the element is an iframe.
  * **[find](http://docs.jquery.com/Traversing/find)**[($expr)](http://docs.jquery.com/Traversing/find) Searches for all elements that match the specified expression. This method is a good way to find additional descendant elements with which to process.
  * **[next](http://docs.jquery.com/Traversing/next)**[($expr)](http://docs.jquery.com/Traversing/next) Get a set of elements containing the unique next siblings of each of the given set of elements.
  * **[nextAll](http://docs.jquery.com/Traversing/nextAll)**[($expr)](http://docs.jquery.com/Traversing/nextAll) Find all sibling elements after the current element.
  * **[parent](http://docs.jquery.com/Traversing/parent)**[($expr)](http://docs.jquery.com/Traversing/parent) Get a set of elements containing the unique parents of the matched set of elements.
  * **[parents](http://docs.jquery.com/Traversing/parents)**[($expr)](http://docs.jquery.com/Traversing/parents) Get a set of elements containing the unique ancestors of the matched set of elements (except for the root element). The matched elements can be filtered with an optional expression.
  * **[prev](http://docs.jquery.com/Traversing/prev)**[($expr)](http://docs.jquery.com/Traversing/prev) Get a set of elements containing the unique previous siblings of each of the matched set of elements.
  * **[prevAll](http://docs.jquery.com/Traversing/prevAll)**[($expr)](http://docs.jquery.com/Traversing/prevAll) Find all sibling elements before the current element.
  * **[siblings](http://docs.jquery.com/Traversing/siblings)**[($expr)](http://docs.jquery.com/Traversing/siblings) Get a set of elements containing all of the unique siblings of each of the matched set of elements. Can be filtered with an optional expressions.
## Chaining
  * **[andSelf](http://docs.jquery.com/Traversing/andSelf)**[()](http://docs.jquery.com/Traversing/andSelf) Add the previous selection to the current selection.
  * **[end](http://docs.jquery.com/Traversing/end)**[()](http://docs.jquery.com/Traversing/end) Revert the most recent 'destructive' operation, changing the set of matched elements to its previous state (right before the destructive operation).

Read more at [Traversing](http://docs.jquery.com/Traversing) section on [jQuery Documentation Site](http://docs.jquery.com/).