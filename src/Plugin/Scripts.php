<?php
/**
 * phpQuery plugin class extending phpQuery object.
 * Methods from this class are callable on every phpQuery object.
 *
 * Class name prefix '\PhpQuery\Plugin\' must be preserved.
 */
abstract class \PhpQuery\Plugin\Scripts {
	/**
	 * Limit binded methods.
	 *
	 * null means all public.
	 * array means only specified ones.
	 *
	 * @var array|null
	 */
	public static $phpQueryMethods = null;
	public static $config = array();
	/**
	 * Enter description here...
	 *
	 * @param PhpQueryObject $self
	 */
	public static function script($self, $arg1) {
		$params = func_get_args();
		$params = array_slice($params, 2);
		$return = null;
		$config = self::$config;
		if (\PhpQuery\Plugin\UtilScripts::$scriptMethods[$arg1]) {
			phpQuery::callbackRun(
				\PhpQuery\Plugin\UtilScripts::$scriptMethods[$arg1],
				array($self, $params, &$return, $config)
			);
		} else if ($arg1 != '__config' && file_exists(dirname(__FILE__)."/Scripts/$arg1.php")) {
			phpQuery::debug("Loading script '$arg1'");
			require dirname(__FILE__)."/Scripts/$arg1.php";
		} else {
			phpQuery::debug("Requested script '$arg1' doesn't exist");
		}
		return $return
			? $return
			: $self;
	}
}
abstract class \PhpQuery\Plugin\UtilScripts {
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
	 * @return bool
	 */
	public static function script($name, $callback) {
		if (\PhpQuery\Plugin\UtilScripts::$scriptMethods[$name])
			throw new \Exception("Script name conflict - '$name'");
		\PhpQuery\Plugin\UtilScripts::$scriptMethods[$name] = $callback;
	}
}
?>