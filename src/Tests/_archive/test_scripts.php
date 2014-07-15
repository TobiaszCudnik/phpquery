<?php
//error_reporting(E_ALL);
require_once('../PhpQuery/PhpQuery.php');
PhpQuery::$debug = true;
PhpQuery::plugin('Scripts');


$testName = 'Scripts/example';
$doc = PhpQuery::newDocumentFile('test.html');
$testResult = 10;
if ($doc->script('example', 'p')->length == $testResult)
	print "Test '$testName' PASSED :)";
else {
	print "Test '$testName' <strong>FAILED</strong> !!! ";
	print "<pre>";
	var_dump($doc->whois());
	print "</pre>\n";
}
print "\n";


$testName = 'Scripts/gmail_login';
$testResult = 1;
$url = 'http://code.google.com/p/phpquery/w/edit/MultiDocumentSupport';
//PhpQuery::ajaxAllowURL($url);
$editor = PhpQuery::newDocument('<div/>')
	->script('google_login')
	->location($url);
if ($editor->find('textarea#content')->length == $testResult)
	print "Test '$testName' PASSED :)";
else {
	print "Test '$testName' <strong>FAILED</strong> !!! ";
	print "<pre>";
	var_dump($doc->whois());
	print "</pre>\n";
}
print "\n";
?>