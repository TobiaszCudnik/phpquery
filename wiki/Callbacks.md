# Table of Contents
  * [What are callbacks](#What_are_callbacks.md)
  * [phpQuery callback system](#phpQuery_callbacks.md)
    * [Callback class](#Callback.md)
    * [CallbackParam class](#CallbackParam.md)
    * [CallbackReference class](#CallbackReference.md)
  * [Scope Pseudo-Inheritance](#Scope_Pseudo_Inheritance.md)
## What are callbacks
Callbacks are functions _called back_ by other functions in proper moment (eg on [Ajax](Ajax.md) request error).

In **JavaScript** this pattern can be very flexible due to [Closures](http://en.wikipedia.org/wiki/Closure_(computer_science)) support, which can be inline (no code break) and inherits scope (no need to passing params).

**PHP** has only simple [support for callbacks](http://pl2.php.net/manual/en/function.call-user-func-array.php) so the case is more complicated. That's why phpQuery extends callback support by it's own.
## phpQuery callback system
phpQuery uses it's own approach to callbacks. This task is achieved thou **Callback**, **CallbackParam** and **CallbackReference** classes.
### Callback
Callback class is used for wrapping valid callbacks with params.
#### Example 1
```
function myCallback($param1, $param2) {
  var_dump($param1);
  var_dump($param2);
}
phpQuery::get($url, 
  new Callback('myCallback', 'myParam1', new CallbackParam)
);
// now $param1 in myCallback will have value 'myParam1'
// and $param2 will be parameter passed by function calling callback
// which in this example would be ajax request result
```
### CallbackParam
As we can see in [last example](#Example_1.md), new instance of CallbackParam class is used for defining places, where original callback parameter(s) will be placed. Such pattern can be used also without Callback class for some methods.
#### Example 2
```
phpQuery::each(
  // first param is array which will be iterated
  array(1,2,3),
  // second param is callback (string or array to call objects method)
  'myCallback',
  // rest of params are ParamStructure
  // CallbackParam objects will be changed to $i and $v by phpQuery::each method
  'param1', new CallbackParam, new CallbackParam, 'param4'
);
function myCallback($param1, $i, $v, $param4) {
  print "Index: $i; Value: $v";
}
```
Methods supporting CallbackParam **without** using Callback class:
  * `phpQuery::each()`
  * `phpQuery::map()`
  * `pq()->each()`
  * `pq()->map()`
### CallbackReference
Finally, CallbackReference can be used when we don't really want a callback, only parameter passed to it. CallbackReference takes first parameter's value and passes it to reference. Thanks to that, we can use **if statement** instead of **callback function**.
#### Example 3
```
$html;
phpQuery::get($url, new CallbackReference($html));
if ($html) {
  // callback triggered, value non-false
  phpQuery::get($url, new CallbackReference($html));
  if ($html) {
    // we just skipped 2 function declarations
  }
}
```
## Scope Pseudo Inheritance
There is an easy way to pseudo inherit scope in PHP. [Scope](http://en.wikipedia.org/wiki/Scope_(programming)) means _variables accessible in specified point of code_ (which in other words means _any variable you can use_). It's achieved using [compact()](http://php.net/compact) and [extract()](http://php.net/extract) functions.
#### Example 4
Look at this modified [example 2](#Example_2.md). Previous comments were removed.
```
$a = 'foo';
$b = 'bar';
phpQuery::each(
  array(1,2,3),
  'myCallback',
  // notice that 'param1' changed to compact('a', 'b')
  // where 'a' and 'b' are variable names accessible in actual scope
  compact('a', 'b'), new CallbackParam, new CallbackParam, 'param4'
);
function myCallback($scope, $i, $v, $param4) {
  // this is the place where variables from $scope array
  // are forwarded to actual function's scope
  extract($scope);
  print "Var a: $a";  // will print 'Var a: foo'
  print "Var b: $b";  // will print 'Var a: bar'
  print "Index: $i; Value: $v";
}
```
## Future
In the future this functionality will be extended and more methods will support it. Check [Issue Tracker entry #48](http://code.google.com/p/phpquery/issues/detail?id=48) if you're interested in any way.