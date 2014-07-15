<?php
/**
 * Automated google account login.
 * Uses __config.php to keep login data.
 *
 * @package PhpQuery.Plugins.Scripts
 * @author Tobiasz Cudnik <tobiasz.cudnik/gmail.com>
 */
use PhpQuery\PhpQuery;

PhpQuery::ajaxAllowHost(
	'code.google.com',
	'google.com', 'www.google.com',
	'mail.google.com',
	'docs.google.com',
	'reader.google.com'
);
if (! function_exists('ndfasui8923')) {
	function ndfasui8923($browser, $scope) {
		extract($scope);
		$browser
			->WebBrowser()
			->find('#Email')
				->val($config['google_login'][0])->end()
			->find('#Passwd')
				->val($config['google_login'][1])
				->parents('form')
					->submit();
	}
	$ndfasui8923 = new Callback('ndfasui8923', new CallbackParam, compact(
		'config', 'self', 'return', 'params'
	));
}
PhpQuery::plugin('WebBrowser');
$self->document->xhr = PhpQuery::$plugins->browserGet(
	'https://www.google.com/accounts/Login',
	$ndfasui8923
);
//$self->document->xhr = PhpQuery::$plugins->browserGet('https://www.google.com/accounts/Login', create_function('$browser', "
//	\$browser
//		->WebBrowser()
//		->find('#Email')
//			->val('{$config['google_login'][0]}')->end()
//		->find('#Passwd')
//			->val('".str_replace("'", "\\'", $config['google_login'][1])."')
//			->parents('form')
//				->submit();"
//));