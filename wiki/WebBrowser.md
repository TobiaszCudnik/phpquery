**WebBrowser** is a phpQuery [plugin](PluginsServerSide.md) that mimics behaviors of web browser. Thanks to that developer can simulate user's behavior inside a PHP script.

## Supported
  * Link navigation (click event)
  * Form navigation (submit event)
  * Cookies (thought [Zend\_Http\_CookieJar](http://framework.zend.com/manual/en/zend.http.cookies.html))
  * Relative links
  * document.location (not an object, yet)

## Use cases
  * Fill forms and submit them easly
  * Login to secure pages and collect content
  * Write test cases reproducing browsing proccess

## Example 1
Adding web browser functionality to existing phpQuery object and submiting the form.
```
->WebBrowser('callback')->find('form')->submit()->...
```

## Example 2
Querying Google against "search phrase":
```
require_once('phpQuery/phpQuery.php');
phpQuery::browserGet('http://www.google.com/', 'success1');
function success1($browser) {
  $browser
    ->WebBrowser('success2')
    ->find('input[name=q]')
      ->val('search phrase')
      ->parents('form')
        ->submit();
}
function success2($browser) {
  print $browser;
}
```