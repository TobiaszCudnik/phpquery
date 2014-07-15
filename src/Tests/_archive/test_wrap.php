<?php
require_once('../PhpQuery/PhpQuery.php');
PhpQuery::$debug = true;

$testName = 'Wrap';
$p = PhpQuery::newDocumentFile('test.html')
	->find('p')
		->slice(1, 3);
$p->wrap('<div class="wrapper">');
$result = true;
foreach($p as $node) {
	if (! pq($node)->parent()->is('.wrapper'))
		$result = false;
}
if ($result)
	print "Test '{$testName}' PASSED :)";
else
	print "Test '{$testName}' <strong>FAILED</strong> !!! ";
$p->dump();
print "\n";



$testName = 'WrapAll';
$testResult = 1;
PhpQuery::newDocumentFile('test.html')
	->find('p')
		->slice(1, 3)
			->wrapAll('<div class="wrapper">');
$result = pq('.wrapper');
if ( $result->size() == $testResult )
	print "Test '{$testName}' PASSED :)";
else
	print "Test '{$testName}' <strong>FAILED</strong> !!! ";
$result->dump();
print "\n";



$testName = 'WrapInner';
$testResult = 3;
PhpQuery::newDocumentFile('test.html')
	->find('li:first')
		->wrapInner('<div class="wrapper">');
$result = pq('.wrapper p');
if ( $result->size() == $testResult )
	print "Test '{$testName}' PASSED :)";
else
	print "Test '{$testName}' <strong>FAILED</strong> !!! ";
print $result->dump();
print "\n";


// TODO !
$testName = 'WrapAllTest';
/*
$doc = PhpQuery::newDocumentHTML('<div id="myDiv"></div>');
$doc['#myDiv']->append('hors paragraphe<p>Test</p>hors paragraphe')
	->contents()
		->not('[nodeType=1]')
			->wrap('<p/>');
var_dump((string)$doc);
*/
//$testResult = 3;
//PhpQuery::newDocumentFile('test.html')
//	->find('li:first')
//		->wrapInner('<div class="wrapper">');
//$result = pq('.wrapper p');
//if ( $result->size() == $testResult )
//	print "Test '{$testName}' PASSED :)";
//else
//	print "Test '{$testName}' <strong>FAILED</strong> !!! ";
//print $result->dump();
//print "\n";
?>