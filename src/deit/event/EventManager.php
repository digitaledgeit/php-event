<?php

namespace deit\event;

/**
 * Event manager
 * @author James Newell <james@digitaledgeit.com.au>
 */
class EventManager {

	/**
	 * The event listeners
	 * @var     callable[string][]|EventListenerInterface[string][]
	 */
	private $listeners = array();

	/**
	 * Gets the event listeners
	 * @param   string      $event      The event name
	 * @param   int         $priority   The event priority (higher numbers == higher priority)
	 * @return  array
	 */
	public function getListeners($event = null, $priority = null) {
		if (is_null($event)) {
			return $this->listeners;
		} else {
			if (isset($this->listeners[$event])) {
				if (is_null($priority)) {
					if (isset($this->listeners[$priority])) {
						return $this->listeners[$event][$priority];
					} else {
						return array();
					}
				} else {
					return $this->listeners[$event];
				}
			} else {
				return array();
			}
		}
	}

	/**
	 * Adds an event listener
	 * @param   string      $event      The event name
	 * @param   callable    $callback   The event callback
	 * @param   int         $priority   The event priority (higher numbers == higher priority)
	 * @return  $this
	 */
	public function attach($event, $callback, $priority = 0) {

		if (!isset($this->listeners[$event])) {
			$this->listeners[$event] = array();
		}

		if (!isset($this->listeners[$event][$priority])) {
			$this->listeners[$event][$priority] = array();
			krsort($this->listeners[$event], SORT_NUMERIC);
		}

		if (in_array($callback, $this->listeners[$event][$priority])) {
			return $this;
		}

		$this->listeners[$event][$priority][] = $callback;

		return $this;
	}

	/**
	 * Adds a listener
	 * @param   string      $event      The event name
	 * @param   callable    $callback   The event callback
	 * @param   int         $priority   The event priority (higher numbers == higher priority)
	 * @return  $this
	 */
	public function detach($event, $callback, $priority = 0) {

		if (!isset($this->listeners[$event][$priority])) {
			return $this;
		}

		if (($i = array_search($callback, $this->listeners[$event][$priority])) === false) {
			return $this;
		}

		unset($this->listeners[$event][$priority][$i]);

		return $this;
	}

	/**
	 * Triggers a new event
	 * @param   Event|string        $event      The event or event name
	 * @return  $this
	 */
	public function trigger($event) {

		//create the event
		if (!$event instanceof $event) {
			$event = new Event($event);
		}

		//get the event
		$name = $event->getName();

		//notify the listeners
		if (isset($this->listeners[$name])) {
			foreach ($this->listeners[$name] as $priority) {
				foreach ($priority as $listener) {
					$listener($event);
				}
			}
		}

		return $this;
	}

}
 