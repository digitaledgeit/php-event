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
	 * @return  array
	 */
	public function getListeners($event = null) {
		if (is_null($event)) {
			return $this->listeners;
		} else {
			if (isset($this->listeners[$event])) {
				return $this->listeners[$event];
			} else {
				return array();
			}
		}
	}

	/**
	 * Adds an event listener
	 * @param   string      $event      The event name
	 * @param   callable    $callback   The event callback
	 * @return  $this
	 */
	public function attach($event, $callback) {

		if (!isset($this->listeners[$event])) {
			$this->listeners[$event] = array($callback);
			return $this;
		}

		if (in_array($callback, $this->listeners[$event])) {
			return $this;
		}

		$this->listeners[$event][] = $callback;

		return $this;
	}

	/**
	 * Adds a listener
	 * @param   string      $event      The event name
	 * @param   callable    $callback   The event callback
	 * @return  $this
	 */
	public function detach($event, $callback) {

		if (!isset($this->listeners[$event])) {
			return $this;
		}

		if (($i = array_search($callback, $this->listeners[$event])) === false) {
			return $this;
		}

		unset($this->listeners[$event][$i]);

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
			foreach ($this->listeners[$name] as $listener) {
				$listener($event);
			}
		}

		return $this;
	}

}
 