<?php
/**
 * Example of PhpQuery plugin.
 *
 * Load it like this:
 * PhpQuery::plugin('example')
 * PhpQuery::plugin('example', 'example.php')
 * pq('ul')->plugin('example')
 * pq('ul')->plugin('example', 'example.php')
 *
 * Plugin classes are never intialized, just method calls are forwarded
 * in static way from PhpQuery.
 *
 * Have fun writing plugins :)
 */

/**
 * PhpQuery plugin class extending PhpQuery object.
 * Methods from this class are callable on every PhpQuery object.
 *
 * Class name prefix '\PhpQuery\Plugin\' must be preserved.
 */
abstract class PhpQuery_Plugin_example {
	/**
	 * Limit binded methods.
	 *
	 * null means all public.
	 * array means only specified ones.
	 *
	 * @var array|null
	 */
	public static $PhpQueryMethods = null;
	/**
	 * Enter description here...
	 *
	 * @param \PhpQueryObject $self
	 */
	public static function example($self, $arg1) {
		// this method can be called on any PhpQuery object, like this:
		// pq('div')->example('$arg1 Value')

		// do something
		$self->append('Im just an example !');
		// change stack of result object
		return $self->find('div');
	}
	protected static function helperFunction() {
		// this method WONT be avaible as PhpQuery method,
		// because it isn't publicly callable
	}
}

/**
 * PhpQuery plugin class extending PhpQuery static namespace.
 * Methods from this class are callable as follows:
 * PhpQuery::$plugins->staticMethod()
 *
 * Class name prefix 'PhpQueryPlugin_' must be preserved.
 */
abstract class PhpQueryPlugin_example {
	/**
	 * Limit binded methods.
	 *
	 * null means all public.
	 * array means only specified ones.
	 *
	 * @var array|null
	 */
	public static $PhpQueryMethods = null;
	public static function staticMethod() {
		// this method can be called within PhpQuery class namespace, like this:
		// PhpQuery::$plugins->staticMethod()
	}
}