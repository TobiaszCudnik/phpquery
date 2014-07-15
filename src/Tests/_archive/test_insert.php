<?php
require_once('../PhpQuery/PhpQuery.php');
PhpQuery::$debug = 2;


$testName = 'HTML insertion';
$doc = PhpQuery::newDocumentFile('document-types/document-utf8.xhtml');
//$doc = PhpQuery::newDocumentFile('document-types/document-utf8.html');
//$doc = PhpQuery::newDocumentFile('document-types/document-utf8.xml');
//print $doc->find('step');
print $doc->find('p');
$markup = "test<br />test<p>test p</p>";
$doc['body > p:last']->append($markup);
if ($doc['body > p:last p']->length == 1)
	print "Test '{$testName}' PASSED :)";
else {
	print "Test '{$testName}' <strong>FAILED</strong> !!! ";
	print $doc->htmlOuter('htmlspecialchars');
}
print "\n";