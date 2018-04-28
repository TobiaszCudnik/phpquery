<?php
namespace PhpQuery\Plugin;

use PhpQuery\PhpQuery;
/**
 * WebBrowser plugin.
 *
 */
class WebBrowser {
	/**
	 * Limit binded methods to specified ones.
	 *
	 * @var array
	 */
	public static $PhpQueryMethods = null;

    /**
     * Enter description here...
     *
     * @param \PhpQuery\PhpQueryObject $self
     * @param null                     $callback
     * @param null                     $location
     * @throws \Exception
     * @todo support 'reset' event
     */
	public static function WebBrowser($self, $callback = null, $location = null) {
		$self = $self->_clone()->toRoot();
		$location = $location
			? $location
			// TODO use document.location
			: $self->document->xhr->getUri(true);
		// FIXME tmp
		$self->document->WebBrowserCallback = $callback;
		if (! $location)
			throw new \Exception('Location needed to activate WebBrowser plugin !');
		else {
			$self->bind('click', array($location, $callback), array('\PhpQuery\Plugin\UtilWebBrowser', 'hadleClick'));
			$self->bind('submit', array($location, $callback), array('\PhpQuery\Plugin\UtilWebBrowser', 'handleSubmit'));
		}
	}
	public static function browser($self, $callback = null, $location = null) {
		return $self->WebBrowser($callback, $location);
	}
	public static function downloadTo($self, $dir = null, $filename = null) {
		$url = null;
		if ($self->is('a[href]'))
			$url = $self->attr('href');
		else if ($self->find('a')->length)
			$url = $self->find('a')->attr('href');
		if ($url) {
			$url = resolve_url($self->document->location, $url);
			if (! $dir)
				$dir = getcwd();
			// TODO resolv name from response headers
			if (! $filename) {
				$matches = null;
				preg_match('@/([^/]+)$@', $url, $matches);
				$filename = $matches[1];
			}
			//print $url;
			$path = rtrim($dir, '/').'/'.$filename;
			PhpQuery::debug("Requesting download of $url\n");
			// TODO use AJAX instead of file_get_contents
			file_put_contents($path, file_get_contents($url));
		}
		return $self;
	}

    /**
     * Method changing browser location.
     * Fires callback registered with WebBrowser(), if any.
     * @param $self
     * @param $url
     * @return bool
     */
	public static function location($self, $url = null) {
		// TODO if ! $url return actual location ???
		$xhr = isset($self->document->xhr)
			? $self->document->xhr
			: null;
		$xhr = PhpQuery::ajax(array(
			'url' => $url,
		), $xhr);
		$return = false;
		if ($xhr->getLastResponse()->isSuccessful()) {
			$return = \PhpQuery\Plugin\UtilWebBrowser::browserReceive($xhr);
			if (isset($self->document->WebBrowserCallback))
				PhpQuery::callbackRun(
					$self->document->WebBrowserCallback,
					array($return)
				);
		}
		return $return;
	}
        
        
        public static function download($self, $url = null) {
            $xhr = isset($self->document->xhr)
			? $self->document->xhr
			: null;
		$xhr = PhpQuery::ajax(array(
			'url' => $url,
		), $xhr);
		$return = false;
		if ($xhr->getLastResponse()->isSuccessful()) {
			$return = \PhpQuery\Plugin\UtilWebBrowser::browserDownload($xhr);
			if (isset($self->document->WebBrowserCallback))
				PhpQuery::callbackRun(
					$self->document->WebBrowserCallback,
					array($return)
				);
		}
		return $return;
        }
}
class UtilWebBrowser {
    /**
     *
     * @param $url
     * @param $callback
     * @param $param1
     * @param $param2
     * @param $param3
     * @throws \Exception
     * @return \Zend_Http_Client
     */
	public static function browserGet($url, $callback,
		$param1 = null, $param2 = null, $param3 = null) {
		PhpQuery::debug("[WebBrowser] GET: $url");
		self::authorizeHost($url);
		$xhr = PhpQuery::ajax(array(
			'type' => 'GET',
			'url' => $url,
			'dataType' => 'html',
		));
		$paramStructure = null;
		if (func_num_args() > 2) {
			$paramStructure = func_get_args();
			$paramStructure = array_slice($paramStructure, 2);
		}
		if ($xhr->getLastResponse()->isSuccessful()) {
			PhpQuery::callbackRun($callback,
				array(self::browserReceive($xhr)->WebBrowser()),
				$paramStructure
			);
//			PhpQuery::callbackRun($callback, array(
//				self::browserReceive($xhr)//->WebBrowser($callback)
//			));
			return $xhr;
		} else {
			throw new \Exception("[WebBrowser] GET request failed; url: $url");
		}
	}
	/**
	 *
	 * @param $url
	 * @param $data
	 * @param $callback
	 * @param $param1
	 * @param $param2
	 * @param $param3
	 * @return \Zend_Http_Client
	 */
	public static function browserPost($url, $data, $callback,
		$param1 = null, $param2 = null, $param3 = null) {
		self::authorizeHost($url);
		$xhr = PhpQuery::ajax(array(
			'type' => 'POST',
			'url' => $url,
			'dataType' => 'html',
			'data' => $data,
		));
		$paramStructure = null;
		if (func_num_args() > 3) {
			$paramStructure = func_get_args();
			$paramStructure = array_slice($paramStructure, 3);
		}
		if ($xhr->getLastResponse()->isSuccessful()) {
			PhpQuery::callbackRun($callback,
				array(self::browserReceive($xhr)->WebBrowser()),
				$paramStructure
			);
//			PhpQuery::callbackRun($callback, array(
//				self::browserReceive($xhr)//->WebBrowser($callback)
//			));
			return $xhr;
		} else
			return false;
	}
	/**
	 *
	 * @param $ajaxSettings
	 * @param $callback
	 * @param $param1
	 * @param $param2
	 * @param $param3
	 * @return Zend_Http_Client
	 */
	public static function browser($ajaxSettings, $callback,
		$param1 = null, $param2 = null, $param3 = null) {
		self::authorizeHost($ajaxSettings['url']);
		$xhr = PhpQuery::ajax(
			self::ajaxSettingsPrepare($ajaxSettings)
		);
		$paramStructure = null;
		if (func_num_args() > 2) {
			$paramStructure = func_get_args();
			$paramStructure = array_slice($paramStructure, 2);
		}
		if ($xhr->getLastResponse()->isSuccessful()) {
			PhpQuery::callbackRun($callback,
				array(self::browserReceive($xhr)->WebBrowser()),
				$paramStructure
			);
//			PhpQuery::callbackRun($callback, array(
//				self::browserReceive($xhr)//->WebBrowser($callback)
//			));
			return $xhr;
		} else
			return false;
	}
	protected static function authorizeHost($url) {
		$host = parse_url($url, PHP_URL_HOST);
		if ($host)
			PhpQuery::ajaxAllowHost($host);
	}
	protected static function ajaxSettingsPrepare($settings) {
		unset($settings['success']);
		unset($settings['error']);
		return $settings;
	}
	/**
	 * @param \Zend_Http_Client $xhr
	 */
	public static function browserReceive($xhr) {
		PhpQuery::debug("[WebBrowser] Received from ".$xhr->getUri(true));
		// TODO handle meta redirects
		$body = $xhr->getLastResponse()->getBody();

		// XXX error ???
		if (strpos($body, '<!doctype html>') !== false) {
			$body = '<html>'
				.str_replace('<!doctype html>', '', $body)
				.'</html>';
		}
		$pq = PhpQuery::newDocument($body);
		$pq->document->xhr = $xhr;
		$pq->document->location = $xhr->getUri(true);
		$refresh = $pq->find('meta[http-equiv=refresh]')
			->add('meta[http-equiv=Refresh]');
		if ($refresh->size()) {
//			print htmlspecialchars(var_export($xhr->getCookieJar()->getAllCookies(), true));
//			print htmlspecialchars(var_export($xhr->getLastResponse()->getHeader('Set-Cookie'), true));
			PhpQuery::debug("Meta redirect... '{$refresh->attr('content')}'\n");
			// there is a refresh, so get the new url
			$content = $refresh->attr('content');
			$urlRefresh = substr($content, strpos($content, '=')+1);
			$urlRefresh = trim($urlRefresh, '\'"');
			// XXX not secure ?!
			PhpQuery::ajaxAllowURL($urlRefresh);
//			$urlRefresh = urldecode($urlRefresh);
			// make ajax call, passing last $xhr object to preserve important stuff
			$xhr = PhpQuery::ajax(array(
				'type' => 'GET',
				'url' => $urlRefresh,
				'dataType' => 'html',
			), $xhr);
			if ($xhr->getLastResponse()->isSuccessful()) {
				// if all is ok, repeat this method...
				return call_user_func_array(
					array('\PhpQuery\Plugin\UtilWebBrowser', 'browserReceive'), array($xhr)
				);
			}
		} else
			return $pq;
	}
        
        /**
	 * @param Zend_Http_Client $xhr
	 */
	public static function browserDownload($xhr) {
		PhpQuery::debug("[WebBrowser] Received from ".$xhr->getUri(true));
		// TODO handle meta redirects
		$body = $xhr->getLastResponse()->getBody();

		return $body;
	}

    /**
     * @param      $e
     * @param null $callback
     */
    public static function hadleClick($e, $callback = null) {
		$node = PhpQuery::pq($e->target);
		$type = null;
		if ($node->is('a[href]')) {
			// TODO document.location
			$xhr = isset($node->document->xhr)
				? $node->document->xhr
				: null;
			$xhr = PhpQuery::ajax(array(
				'url' => resolve_url($e->data[0], $node->attr('href')),
				'referer' => $node->document->location,
			), $xhr);
			if ((! $callback || !($callback instanceof \Callback)) && $e->data[1])
				$callback = $e->data[1];
			if ($xhr->getLastResponse()->isSuccessful() && $callback)
				PhpQuery::callbackRun($callback, array(
					self::browserReceive($xhr)
				));
		} else if ($node->is(':submit') && $node->parents('form')->size())
			$node->parents('form')->trigger('submit', array($e));
	}

    /**
     * Enter description here...
     *
     * @TODO trigger submit for form after form's  submit button has a click event
     * @param      $e
     * @param null $callback
     */
	public static function handleSubmit($e, $callback = null) {
		$node = PhpQuery::pq($e->target);
		if (!$node->is('form') || !$node->is('[action]'))
			return;
		// TODO document.location
		$xhr = isset($node->document->xhr)
			? $node->document->xhr
			: null;
		$submit = pq($e->relatedTarget)->is(':submit')
			? $e->relatedTarget
				// will this work ?
//			: $node->find(':submit:first')->get(0);
			: $node->find('*:submit:first')->get(0);
		$data = array();
		foreach($node->serializeArray($submit) as $r)
		// XXXt.c maybe $node->not(':submit')->add($sumit) would be better ?
//		foreach($node->serializeArray($submit) as $r)
			$data[ $r['name'] ] = $r['value'];
		$options = array(
			'type' => $node->attr('method')
				? $node->attr('method')
				: 'GET',
			'url' => resolve_url($e->data[0], $node->attr('action')),
			'data' => $data,
			'referer' => $node->document->location,
//			'success' => $e->data[1],
		);
		if ($node->attr('enctype'))
			$options['contentType'] = $node->attr('enctype');
		$xhr = PhpQuery::ajax($options, $xhr);
		if ((! $callback || !($callback instanceof Callback)) && $e->data[1])
			$callback = $e->data[1];
		if ($xhr->getLastResponse()->isSuccessful() && $callback)
			PhpQuery::callbackRun($callback, array(
				self::browserReceive($xhr)
			));
	}
}
/**
 *
 * @link http://www.php.net/manual/en/function.parse-url.php
 * @author stevenlewis at hotmail dot com
 */
function glue_url($parsed)
    {
    if (! is_array($parsed)) return false;
    $uri = isset($parsed['scheme']) ? $parsed['scheme'].':'.((strtolower($parsed['scheme']) == 'mailto') ? '':'//'): '';
    $uri .= isset($parsed['user']) ? $parsed['user'].($parsed['pass']? ':'.$parsed['pass']:'').'@':'';
    $uri .= isset($parsed['host']) ? $parsed['host'] : '';
    $uri .= isset($parsed['port']) ? ':'.$parsed['port'] : '';
    if(isset($parsed['path']))
        {
        $uri .= (substr($parsed['path'],0,1) == '/')?$parsed['path']:'/'.$parsed['path'];
        }
    $uri .= isset($parsed['query']) ? '?'.$parsed['query'] : '';
    $uri .= isset($parsed['fragment']) ? '#'.$parsed['fragment'] : '';
    return $uri;
    }
/**
 * Enter description here...
 *
 * @author adrian-php at sixfingeredman dot net
 */
function resolve_url($base, $url) {
        if (!strlen($base)) return $url;
        // Step 2
        if (!strlen($url)) return $base;
        // Step 3
        if (preg_match('!^[a-z]+:!i', $url)) return $url;
        $base = parse_url($base);
        if ($url{0} == "#") {
                // Step 2 (fragment)
                $base['fragment'] = substr($url, 1);
                return unparse_url($base);
        }
        unset($base['fragment']);
        unset($base['query']);
        if (substr($url, 0, 2) == "//") {
                // Step 4
                return unparse_url(array(
                        'scheme'=>$base['scheme'],
                        'path'=>substr($url,2),
                ));
        } else if ($url{0} == "/") {
                // Step 5
                $base['path'] = $url;
        } else {
                // Step 6
                $path = explode('/', $base['path']);
                $url_path = explode('/', $url);
                // Step 6a: drop file from base
                array_pop($path);
                // Step 6b, 6c, 6e: append url while removing "." and ".." from
                // the directory portion
                $end = array_pop($url_path);
                foreach ($url_path as $segment) {
                        if ($segment == '.') {
                                // skip
                        } else if ($segment == '..' && $path && $path[sizeof($path)-1] != '..') {
                                array_pop($path);
                        } else {
                                $path[] = $segment;
                        }
                }
                // Step 6d, 6f: remove "." and ".." from file portion
                if ($end == '.') {
                        $path[] = '';
                } else if ($end == '..' && $path && $path[sizeof($path)-1] != '..') {
                        $path[sizeof($path)-1] = '';
                } else {
                        $path[] = $end;
                }
                // Step 6h
                $base['path'] = join('/', $path);

        }
        // Step 7
        return glue_url($base);
}

function unparse_url($parsed_url) {
    $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
    $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
    $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
    $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
    $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
    $pass     = ($user || $pass) ? "$pass@" : '';
    $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
    $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
    $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
    return "$scheme$user$pass$host$port$path$query$fragment";
}