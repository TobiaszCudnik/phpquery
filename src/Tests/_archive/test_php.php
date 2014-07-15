<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<?php
require_once('../PhpQuery/PhpQuery.php');
PhpQuery::$debug = true;

$testName = 'PHP Code output';
$expected = <<<EOF
<?php  print \$r  ?><a href="<?php print \$array['key']; if ("abc'd'") {}; ?>"></a>
EOF;
$result = PhpQuery::newDocumentPHP(null, 'text/html;charset=utf-8')
	->appendPHP('print $r')
	->append('<a/>')
		->find('a')
			->attrPHP('href', 'print $array[\'key\']; if ("abc\'d\'") {};')
		->end();
if (trim($result->php()) == $expected)
	print "Test '{$testName}' passed :)";
else
	print "Test '{$testName}' <strong>FAILED</strong> !!!";
print "\n";

$testName = 'PHP file open';
$result = PhpQuery::newDocumentFilePHP('document-types/document-utf8.php');
var_dump($result->php());
/*
	->appendPHP('print $r')
	->append('<a/>')
		->find('a')
			->attrPHP('href', 'print $array[\'key\']; if ("abc\'d\'") {};')
		->end();
if (trim($result->php()) == $expected)
	print "Test '{$testName}' passed :)";
else
	print "Test '{$testName}' <strong>FAILED</strong> !!!";
print "\n";
*/