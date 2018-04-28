<?php
namespace PhpQuery;

use PhpQuery\Dom\DOMEvent;

/**
 * Event handling class.
 *
 * @author  Tobiasz Cudnik
 * @package PhpQuery
 * @static
 */
abstract class PhpQueryEvents
{
    /**
     * Trigger a type of event on every matched element.
     *
     *
     * @TODO exclusive events (with !)
     * @TODO global events (test)
     * @TODO support more than event in $type (space-separated)
     * @param       $document
     * @param       $type
     * @param array $data
     * @param null  $node
     */
    public static function trigger($document, $type, $data = array(), $node = null)
    {
        // trigger: function(type, data, elem, donative, extra) {
        $documentID = PhpQuery::getDocumentID($document);
        $namespace  = null;
        if (strpos($type, '.') !== false) {
            list($name, $namespace) = explode('.', $type);
        } else {
            $name = $type;
        }
        if (!$node) {
            if (self::issetGlobal($documentID, $type)) {
                $pq = PhpQuery::getDocument($documentID);
                // TODO check add($pq->document)
                $pq->find('*')->add($pq->document)->trigger($type, $data);
            }
        } else {
            if (isset($data[0]) && $data[0] instanceof DOMEvent) {
                $event                = $data[0];
                $event->relatedTarget = $event->target;
                $event->target        = $node;
                $data                 = array_slice($data, 1);
            } else {
                $event = new DOMEvent(array(
                                          'type'      => $type,
                                          'target'    => $node,
                                          'timeStamp' => time(),
                                      ));
            }
            $i = 0;
            while ($node) {
                // TODO whois
                PhpQuery::debug(
                    "Triggering " . ($i ? "bubbled " : '')
                    . "event '{$type}' on " . "node \n"
                );
                //.PhpQueryObject::whois($node)."\n");
                $event->currentTarget = $node;
                $eventNode            = self::getNode($documentID, $node);
                if (isset($eventNode->eventHandlers)) {
                    foreach ($eventNode->eventHandlers as $eventType => $handlers) {
                        $eventNamespace = null;
                        if (strpos($type, '.') !== false) {
                            list($eventName, $eventNamespace) = explode('.', $eventType);
                        } else {
                            $eventName = $eventType;
                        }
                        if ($name != $eventName) {
                            continue;
                        }
                        if ($namespace && $eventNamespace && $namespace != $eventNamespace) {
                            continue;
                        }
                        foreach ($handlers as $handler) {
                            PhpQuery::debug("Calling event handler\n");
                            $event->data = $handler['data'] ? $handler['data'] : null;
                            $params      = array_merge(
                                array(
                                    $event
                                ),
                                $data
                            );
                            $return      = PhpQuery::callbackRun($handler['callback'], $params);
                            if ($return === false) {
                                $event->bubbles = false;
                            }
                        }
                    }
                }
                // to bubble or not to bubble...
                if (!$event->bubbles) {
                    break;
                }
                $node = $node->parentNode;
                $i++;
            }
        }
    }

    /**
     * Binds a handler to one or more events (like click) for each matched element.
     * Can also bind custom events.
     *
     * @param \DOMNode|PhpQueryObject|string $document
     * @param                                $node
     * @param string                         $type
     * @param string                         $data Optional
     * @param                                $callback
     *
     * @TODO support '!' (exclusive) events
     * @TODO support more than event in $type (space-separated)
     * @TODO support binding to global events
     */
    public static function add($document, $node, $type, $data, $callback = null)
    {
        PhpQuery::debug("Binding '$type' event");
        $documentID = PhpQuery::getDocumentID($document);
        //		if (is_null($callback) && is_callable($data)) {
        //			$callback = $data;
        //			$data = null;
        //		}
        $eventNode = self::getNode($documentID, $node);
        if (!$eventNode) {
            $eventNode = self::setNode($documentID, $node);
        }
        if (!isset($eventNode->eventHandlers[$type])) {
            $eventNode->eventHandlers[$type] = array();
        }
        $eventNode->eventHandlers[$type][] = array(
            'callback' => $callback,
            'data'     => $data,
        );
    }

    /**
     * Enter description here...
     *
     * @param \DOMNode|PhpQueryObject|string $document
     * @param                                $node
     * @param string                         $type
     * @param                                $callback
     *
     * @TODO namespace events
     * @TODO support more than event in $type (space-separated)
     */
    public static function remove($document, $node, $type = null, $callback = null)
    {
        $documentID = PhpQuery::getDocumentID($document);
        $eventNode  = self::getNode($documentID, $node);
        if (is_object($eventNode) && isset($eventNode->eventHandlers[$type])) {
            if ($callback) {
                foreach ($eventNode->eventHandlers[$type] as $k => $handler) {
                    if ($handler['callback'] == $callback) {
                        unset($eventNode->eventHandlers[$type][$k]);
                    }
                }
            } else {
                unset($eventNode->eventHandlers[$type]);
            }
        }
    }

    protected static function getNode($documentID, $node)
    {
        foreach (PhpQuery::$documents[$documentID]->eventsNodes as $eventNode) {
            if ($node->isSameNode($eventNode)) {
                return $eventNode;
            }
        }
    }

    protected static function setNode($documentID, $node)
    {
        PhpQuery::$documents[$documentID]->eventsNodes[] = $node;
        return PhpQuery::$documents[$documentID]->eventsNodes[count(PhpQuery::$documents[$documentID]->eventsNodes)
        - 1];
    }

    protected static function issetGlobal($documentID, $type)
    {
        return isset(PhpQuery::$documents[$documentID]) ? in_array(
            $type,
            PhpQuery::$documents[$documentID]->eventsGlobal
        )
            : false;
    }
}
