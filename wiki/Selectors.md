Selectors are the heart of jQuery-like interface. Most of [CSS Level 3](http://www.w3.org/TR/2005/WD-css3-selectors-20051215/) syntax is implemented (in state same as in jQuery).
## Example
```
pq(".class ul > li[rel='foo']:first:has(a)")->appendTo('.append-target-wrapper div')->...
```
# Table of Contents
  * [Basics](#Basics.md)
  * [Hierarchy](#Hierarchy.md)
  * [Basic Filters](#Basic_Filters.md)
  * [Content Filters](#Content_Filters.md)
  * [Visibility Filters](#Visibility_Filters.md)
  * [Attribute Filters](#Attribute_Filters.md)
  * [Child Filters](#Child_Filters.md)
  * [Forms](#Forms.md)
  * [Form Filters](#Form_Filters.md)
## Basics
  * **[#id](http://docs.jquery.com/Selectors/id)** Matches a single element with the given id attribute.
  * **[element](http://docs.jquery.com/Selectors/element)** Matches all elements with the given name.
  * **[.class](http://docs.jquery.com/Selectors/class)** Matches all elements with the given class.
  * **[\*](http://docs.jquery.com/Selectors/all)** Matches all elements.
  * **[selector1, selector2, selectorN](http://docs.jquery.com/Selectors/multiple)** Matches the combined results of all the specified selectors.
## Hierarchy
  * **[ancestor descendant](http://docs.jquery.com/Selectors/descendant)** Matches all descendant elements specified by "descendant" of elements specified by "ancestor".
  * **[parent > child](http://docs.jquery.com/Selectors/child)** Matches all child elements specified by "child" of elements specified by "parent".
  * **[prev + next](http://docs.jquery.com/Selectors/next)** Matches all next elements specified by "next" that are next to elements specified by "prev".
  * **[prev ~ siblings](http://docs.jquery.com/Selectors/siblings)** Matches all sibling elements after the "prev" element that match the filtering "siblings" selector.
## Basic Filters
  * **[:first](http://docs.jquery.com/Selectors/first)** Matches the first selected element.
  * **[:last](http://docs.jquery.com/Selectors/last)** Matches the last selected element.
  * **[:not(selector)](http://docs.jquery.com/Selectors/not)** Filters out all elements matching the given selector.
  * **[:even](http://docs.jquery.com/Selectors/even)** Matches even elements, zero-indexed.
  * **[:odd](http://docs.jquery.com/Selectors/odd)** Matches odd elements, zero-indexed.
  * **[:eq(index)](http://docs.jquery.com/Selectors/eq)** Matches a single element by its index.
  * **[:gt(index)](http://docs.jquery.com/Selectors/gt)** Matches all elements with an index above the given one.
  * **[:lt(index)](http://docs.jquery.com/Selectors/lt)** Matches all elements with an index below the given one.
  * **[:header](http://docs.jquery.com/Selectors/header)** Matches all elements that are headers, like h1, h2, h3 and so on.
  * **[:animated](http://docs.jquery.com/Selectors/animated)** Matches all elements that are currently being animated.
## Content Filters
  * **[:contains(text)](http://docs.jquery.com/Selectors/contains)** Matches elements which contain the given text.
  * **[:empty](http://docs.jquery.com/Selectors/empty)** Matches all elements that have no children (including text nodes).
  * **[:has(selector)](http://docs.jquery.com/Selectors/has)** Matches elements which contain at least one element that matches the specified selector.
  * **[:parent](http://docs.jquery.com/Selectors/parent)** Matches all elements that are parents - they have child elements, including text.
## Visibility Filters
_none_
## Attribute Filters
  * **[[attribute](http://docs.jquery.com/Selectors/attributeHas)]** Matches elements that have the specified attribute.
  * **[[attribute=value](http://docs.jquery.com/Selectors/attributeEquals)]** Matches elements that have the specified attribute with a certain value.
  * **[[attribute!=value](http://docs.jquery.com/Selectors/attributeNotEqual)]** Matches elements that don't have the specified attribute with a certain value.
  * **[[attribute^=value](http://docs.jquery.com/Selectors/attributeStartsWith)]** Matches elements that have the specified attribute and it starts with a certain value.
  * **[[attribute$=value](http://docs.jquery.com/Selectors/attributeEndsWith)]** Matches elements that have the specified attribute and it ends with a certain value.
  * **[[attribute\*=value](http://docs.jquery.com/Selectors/attributeContains)]** Matches elements that have the specified attribute and it contains a certain value.
  * **[[selector1](http://docs.jquery.com/Selectors/attributeMultiple)[selector2](selector2.md)[selectorN](selectorN.md)]** Matches elements that have the specified attribute and it contains a certain value.
## Child Filters
  * **[:nth-child(index/even/odd/equation)](http://docs.jquery.com/Selectors/nthChild)** Matches all elements that are the nth-child of their parent or that are the parent's even or odd children.
  * **[:first-child](http://docs.jquery.com/Selectors/firstChild)** Matches all elements that are the first child of their parent.
  * **[:last-child](http://docs.jquery.com/Selectors/lastChild)** Matches all elements that are the last child of their parent.
  * **[:only-child](http://docs.jquery.com/Selectors/onlyChild)** Matches all elements that are the only child of their parent.
## Forms
  * **[:input](http://docs.jquery.com/Selectors/input)** Matches all input, textarea, select and button elements.
  * **[:text](http://docs.jquery.com/Selectors/text)** Matches all input elements of type text.
  * **[:password](http://docs.jquery.com/Selectors/password)** Matches all input elements of type password.
  * **[:radio](http://docs.jquery.com/Selectors/radio)** Matches all input elements of type radio.
  * **[:checkbox](http://docs.jquery.com/Selectors/checkbox)** Matches all input elements of type checkbox.
  * **[:submit](http://docs.jquery.com/Selectors/submit)** Matches all input elements of type submit.
  * **[:image](http://docs.jquery.com/Selectors/image)** Matches all input elements of type image.
  * **[:reset](http://docs.jquery.com/Selectors/reset)** Matches all input elements of type reset.
  * **[:button](http://docs.jquery.com/Selectors/button)** Matches all button elements and input elements of type button.
  * **[:file](http://docs.jquery.com/Selectors/file)** Matches all input elements of type file.
  * **[:hidden](http://docs.jquery.com/Selectors/hidden)** Matches all elements that are hidden, or input elements of type "hidden".
## Form Filters
  * **[:enabled](http://docs.jquery.com/Selectors/enabled)** Matches all elements that are enabled.
  * **[:disabled](http://docs.jquery.com/Selectors/disabled)** Matches all elements that are disabled.
  * **[:checked](http://docs.jquery.com/Selectors/checked)** Matches all elements that are checked.
  * **[:selected](http://docs.jquery.com/Selectors/selected)** Matches all elements that are selected.

Read more at [Selectors](http://docs.jquery.com/Selectors) section on [jQuery Documentation Site](http://docs.jquery.com/).