<?php
require_once('../PhpQuery/PhpQuery.php');
PhpQuery::$debug = true;
PhpQuery::extend('WebBrowser');

PhpQuery::$ajaxAllowedHosts[] = 'gmail.com';
PhpQuery::$ajaxAllowedHosts[] = 'google.com';
PhpQuery::$ajaxAllowedHosts[] = 'www.google.com';
PhpQuery::$ajaxAllowedHosts[] = 'www.google.pl';
PhpQuery::$ajaxAllowedHosts[] = 'mail.google.com';

// Google search results
if (0) {
	PhpQuery::$plugins->browserGet('http://google.com/', 'success1');
	/**
	*
	* @param $pq PhpQueryObject
	* @return unknown_type
	*/
	function success1($pq) {
		print 'success1 callback';
		$pq
			->WebBrowser('success2')
				->find('input[name=q]')
				->val('PhpQuery')
				->parents('form')
					->submit()
		;
	}
	/**
	*
	* @param $html PhpQueryObject
	* @return unknown_type
	*/
	function success2($pq) {
		print 'success2 callback';
		print $pq
			->find('script')->remove()->end();
	}
}

// Gmail login (not working...)
if (0) {
	PhpQuery::plugin("Scripts");
	PhpQuery::newDocument('<div/>')
		->script('google_login')
		->location('http://mail.google.com/')
		->toReference($pq);
	if ($pq) {
		print $pq->script('print_websafe');
	}
}

// Gmail login v2 (not working...)
if (0) {
	$browser = null;
	$browserCallback = new CallbackReference($browser);
	PhpQuery::browserGet('http://mail.google.com/', $browserCallback);
	if ($browser) {
		$browser
			->WebBrowser($browserCallback)
			->find('#Email')
				->val('XXX@gmail.com')->end()
			->find('#Passwd')
				->val('XXX')
				->parents('form')
					->submit();
		if ($browser) {
			print $browser->script('print_websafe');
		}
	}
}

//	if ( $result->whois() == $testResult )
//		print "Test '$testName' PASSED :)";
//	else {
//		print "Test '$testName' <strong>FAILED</strong> !!! ";
//		print "<pre>";
//		print_r($result->whois());
//		print "</pre>\n";
//	}
//	print "\n";
?>