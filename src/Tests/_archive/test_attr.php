<?php
require_once('../PhpQuery/PhpQuery.php');
PhpQuery::$debug = true;

$testName = 'Attribute change';
$expected = 'new attr value';
$result = PhpQuery::newDocumentFile('test.html')
	->find('p[rel]:first')
		->attr('rel', $expected);
if ($result->attr('rel') == $expected)
	print "Test '{$testName}' passed :)";
else
	print "Test '{$testName}' <strong>FAILED</strong> !!!";
print "\n";


$testName = 'Attribute change in iteration';
$expected = 'new attr value';
$doc = PhpQuery::newDocumentFile('test.html');
foreach($doc['p[rel]:first'] as $p)
	pq($p)->attr('rel', $expected);
if ($doc['p[rel]:first']->attr('rel') == $expected)
	print "Test '{$testName}' passed :)";
else
	print "Test '{$testName}' <strong>FAILED</strong> !!!";
print "\n";