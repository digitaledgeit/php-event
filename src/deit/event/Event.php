<?php

namespace deit\event;

/**
 * Event
 * @author James Newell <james@digitaledgeit.com.au>
 */
class Event implements EventInterface {

	/**
	 * The event name
	 * @var     string
	 */
	private $name;

	/**
	 * The event params
	 * @var     mixed[string]
	 */
	private $params;

	/**
	 * Constructs the event
	 * @param   string          $name       The event name
	 * @param   mixed[string]   $params     The event params
	 */
	public function __construct($name, array $params = array()) {
		$this->name     = (string) $name;
		$this->params   = $params;
	}

	/**
	 * Gets the event name
	 * @return  string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Gets the params
	 * @return  mixed[string]
	 */
	public function getParams() {
		return $this->params;
	}

	/**
	 * Sets the params
	 * @param   mixed[string]   $params     The event params
	 * @return  $this
	 */
	public function setParams(array $params) {
		$this->params = $params;
		return $this;
	}

	/**
	 * Gets whether the param value has been set
	 * @param   string          $name       The param name
	 * @return  mixed
	 */
	public function hasParam($name) {
		if (isset($this->params[$name])) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Gets the param
	 * @param   string          $name       The param name
	 * @param   mixed           $default    The param value
	 * @return  mixed
	 */
	public function getParam($name, $default = null) {
		if (isset($this->params[$name])) {
			return $this->params[$name];
		} else {
			return $default;
		}
	}

	/**
	 * Sets the param
	 * @param   string      $name           The param name
	 * @param   mixed       $value          The param value
	 * @return  $this
	 */
	public function setParam($name, $value) {
		$this->params[$name] = $value;
		return $this;
	}

}
 