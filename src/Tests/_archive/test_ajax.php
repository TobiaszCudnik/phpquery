<?php
//error_reporting(E_ALL);
set_include_path(
	get_include_path().PATH_SEPARATOR
	.'zend-framework/'
);

require_once('../PhpQuery/PhpQuery.php');
PhpQuery::$debug = true;
PhpQuery::$ajaxAllowedHosts[] = 'wikipedia.org';
PhpQuery::$ajaxAllowedHosts[] = 'google.com';
PhpQuery::$ajaxAllowedHosts[] = 'code.google.com';
PhpQuery::$ajaxAllowedHosts[] = 'www.google.com';

//$pq = PhpQuery::ajax(array(
//	'url' => 'http://wikipedia.org/',
//	'success' => 'v87shs79d8fhs9d'
//));
//function v87shs79d8fhs9d($html) {
//	$title = PhpQuery::newDocument($html)->find('title');
//	$testName = 'Simple AJAX';
//	if ( strpos(strtolower($title->html()), 'wikipedia') !== false )
//		print "Test '$testName' PASSED :)";
//	else {
//		print "Test '$testName' <strong>FAILED</strong> !!! ";
//		print "<pre>";
//		print_r($title->whois());
//		print "</pre>\n";
//	}
//	print "\n";
//}


$testName = 'Load';
$test = PhpQuery::newDocumentFile('test.html')
	->find('div:first')
	->load('http://wikipedia.org/ div[lang]');
if (pq('div[lang]')->size())
	print "Test '$testName' PASSED :)";
else {
	print "Test '$testName' <strong>FAILED</strong> !!! ";
	print "<pre>";
	print "</pre>\n";
}
print "\n";


// http://code.google.com/p/phpquery/issues/detail?id=130
$pq = PhpQuery::ajax(array(
	'url' => 'http://'.$_SERVER['SERVER_NAME'].preg_replace('@/[^/]+$@', '/test_ajax_data_1', $_SERVER['REQUEST_URI']),
	'success' => 'a789fhasdui3124',
	'error' => 'jhdbg786213u8dsfg7y'
));
function a789fhasdui3124($html) {
	$testName = 'AJAX request text node';
	if ( $html == 'hello world' )
		print "Test '$testName' PASSED :)";
	else {
		print "Test '$testName' <strong>FAILED</strong> !!! ";
	}
	print "\n";
}

function jhdbg786213u8dsfg7y() {
	$testName = 'AJAX request text node';
	print "Test '$testName' <strong>FAILED</strong> !!! ";
}


//$testName = 'gdata plugin';
//PhpQuery::extend('gdata');
//$xhr = PhpQuery::$plugins->gdata('tobiasz.cudnik@gmail.com', 'XXX');
//$url = 'http://code.google.com/p/phpquery/w/edit/Callbacks';
//PhpQuery::ajax(array('url' => $url, 'success' => 'ksjsdgh892jh23'), $xhr);
//function ksjsdgh892jh23($html) {
//	print $html;
//	print pq($html)->find('script')->remove()->end();
//	if (pq('div[lang]')->size())
//		print "Test '$testName' PASSED :)";
//	else {
//		print "Test '$testName' <strong>FAILED</strong> !!! ";
//		print "<pre>";
//		print "</pre>\n";
//	}
//	print "\n";
//}