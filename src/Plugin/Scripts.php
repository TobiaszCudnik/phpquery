<?php
namespace PhpQuery\Plugin;

use PhpQuery\PhpQuery;
/**
 * PhpQuery plugin class extending PhpQuery object.
 * Methods from this class are callable on every PhpQuery object.
 *
 * Class name prefix '\PhpQuery\Plugin\' must be preserved.
 */
abstract class Scripts {
	/**
	 * Limit binded methods.
	 *
	 * null means all public.
	 * array means only specified ones.
	 *
	 * @var array|null
	 */
	public static $PhpQueryMethods = null;
	public static $config = array();

    /**
     * Enter description here...
     *
     * @param \PhpQuery\PhpQueryObject $self
     * @param                          $arg1
     * @return null|\PhpQuery\PhpQueryObject
     */
	public static function script($self, $arg1) {
		$params = func_get_args();
		$params = array_slice($params, 2);
		$return = null;
		$config = self::$config;
		if (\PhpQuery\Plugin\UtilScripts::$scriptMethods[$arg1]) {
			PhpQuery::callbackRun(
				\PhpQuery\Plugin\UtilScripts::$scriptMethods[$arg1],
				array($self, $params, &$return, $config)
			);
		} else if ($arg1 != '__config' && file_exists(dirname(__FILE__)."/Scripts/$arg1.php")) {
			PhpQuery::debug("Loading script '$arg1'");
			require dirname(__FILE__)."/Scripts/$arg1.php";
		} else {
			PhpQuery::debug("Requested script '$arg1' doesn't exist");
		}
		return $return
			? $return
			: $self;
	}
}
abstract class UtilScripts {
	public static $scriptMethods = array();
	public static function __initialize() {
		if (file_exists(dirname(__FILE__)."/Scripts/__config.php")) {
			include dirname(__FILE__)."/Scripts/__config.php";
			\PhpQuery\Plugin\Scripts::$config = $config;
		}
	}

    /**
     * Extend scripts' namespace with $name related with $callback.
     *
     * Callback parameter order looks like this:
     * - $this
     * - $params
     * - &$return
     * - $config
     *
     * @param $name
     * @param $callback
     * @throws \Exception
     * @return bool
     */
	public static function script($name, $callback) {
		if (\PhpQuery\Plugin\UtilScripts::$scriptMethods[$name])
			throw new \Exception("Script name conflict - '$name'");
		\PhpQuery\Plugin\UtilScripts::$scriptMethods[$name] = $callback;
	}
}