<?php
require_once('../PhpQuery/PhpQuery.php');
PhpQuery::$debug = true;

$testName = 'ReplaceWith';
PhpQuery::newDocumentFile('test.html')
	->find('p:eq(1)')
		->replaceWith("<p class='newTitle'>
                        this is example title
                    </p>");
$result = pq('p:eq(1)');
if ( $result->hasClass('newTitle') )
	print "Test '{$testName}' PASSED :)";
else
	print "Test '{$testName}' <strong>FAILED</strong> !!! ";
$result->dump();
print "\n";



$testName = 'ReplaceAll';
$testResult = 3;
PhpQuery::newDocumentFile('test.html');
pq('<div class="replacer">')
	->replaceAll('li:first p');
$result = pq('.replacer');
if ( $result->size() == $testResult )
	print "Test '{$testName}' PASSED :)";
else
	print "Test '{$testName}' <strong>FAILED</strong> !!! ";
$result->dump();
print "\n";