# Table of Contents
  * [Example](#Example.md)
  * [Server Side Events](#Server_Side_Events.md)
  * [Page Load](#Page_Load.md)
  * [Event Handling](#Event_Handling.md)
  * [Interaction Helpers](#Interaction_Helpers.md)
  * [Event Helpers](#Event_Helpers.md)

## Example
```
pq('form')->bind('submit', 'submitHandler')->trigger('submit')->...
function submitHandler($e) {
  print 'Target: '.$e->target->tagName;
  print 'Bubbling ? '.$e->currentTarget->tagName;
}
```

## Server Side Events
phpQuery support **server-side** events, same as jQuery handle client-side ones. On server there isn't, of course, events such as _mouseover_ (but they can be triggered).

By default, phpQuery automatically fires up only **change** event for form elements. If you load WebBrowser plugin, **submit** and **click** will be handled properly - eg submitting form with inputs' data to action URL via new [Ajax](Ajax.md) request.

$this (`this` in JS) context for handler scope **isn't available**. You have to use one of following manually:
  * $event->**target**
  * $event->**currentTarget**
  * $event->**relatedTarget**

## Page Load
_none_

## Event Handling
  * **[bind](http://docs.jquery.com/Events/bind)**[($type, $data, $fn)](http://docs.jquery.com/Events/bind) Binds a handler to one or more events (like click) for each matched element. Can also bind custom events.
  * **[one](http://docs.jquery.com/Events/one)**[($type, $data, $fn)](http://docs.jquery.com/Events/one) Binds a handler to one or more events to be executed once for each matched element.
  * **[trigger](http://docs.jquery.com/Events/trigger)**[($type , $data )](http://docs.jquery.com/Events/trigger) Trigger a type of event on every matched element.
  * **[triggerHandler](http://docs.jquery.com/Events/triggerHandler)**[($type , $data )](http://docs.jquery.com/Events/triggerHandler) This particular method triggers all bound event handlers on an element (for a specific event type) WITHOUT executing the browsers default actions.
  * **[unbind](http://docs.jquery.com/Events/unbind)**[($type , $data )](http://docs.jquery.com/Events/unbind) This does the opposite of bind, it removes bound events from each of the matched elements.

## Interaction Helpers
_none_

## Event Helpers
  * **[change](http://docs.jquery.com/Events/change)**[()](http://docs.jquery.com/Events/change) Triggers the change event of each matched element.
  * **[change](http://docs.jquery.com/Events/change)**[($fn)](http://docs.jquery.com/Events/change) Binds a function to the change event of each matched element.
  * **[submit](http://docs.jquery.com/Events/submit)**[()](http://docs.jquery.com/Events/submit) Trigger the submit event of each matched element.
  * **[submit](http://docs.jquery.com/Events/submit)**[($fn)](http://docs.jquery.com/Events/submit) Bind a function to the submit event of each matched element.

Read more at [Events](http://docs.jquery.com/Events) section on [jQuery Documentation Site](http://docs.jquery.com/).