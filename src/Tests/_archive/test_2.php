<?php
require_once('../PhpQuery/PhpQuery.php');
PhpQuery::$debug = true;


$testName = 'Filter with pseudoclass';
$testResult = array(
	'p.body',
);
$result = PhpQuery::newDocumentFile('test.html');
$result = $result->find('p')
	->filter('.body:gt(1)');
if ( $result->whois() == $testResult )
	print "Test '{$testName}' PASSED :)";
else
	print "Test '{$testName}' <strong>FAILED</strong> !!! ";
print_r($result->whois());
print "\n";


$testName = 'Filter with multiplie selectors';
$testResult = array(
	'p.body',
);
$testDOM = PhpQuery::newDocumentFile('test.html');
$single = $testDOM->find('p')->filter('.body')
	->add(
		$testDOM->find('p')->filter('.title')
	)
;
$double = $testDOM->find('p')
	->filter('.body, .title');
if ($single->length == count($double))
	print "Test '{$testName}' PASSED :)";
else
	print "Test '{$testName}' <strong>FAILED</strong> !!! ";
print "\n";
print_r($single->whois());
print "\n";
print_r($double->whois());
print "\n";


$testName = 'Attributes in HTML element';
$validResult = 'testValue';
$result = PhpQuery::newDocumentFile('test.html')->find('html')
	->empty()
	->attr('test', $validResult);
$result = PhpQuery::newDocument($result->htmlOuter())->find('html')
	->attr('test');
//similar_text($result->htmlOuter(), $validResult, $similarity);
if ( $result == $validResult )
	print "Test '{$testName}' PASSED :)";
else {
	print "Test '{$testName}' <strong>FAILED</strong> !!! ";
	print "<pre>";
	print $result;
	print "</pre>\n";
}