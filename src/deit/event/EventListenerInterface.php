<?php

namespace deit\event;

/**
 * Event listener
 * @author James Newell <james@digitaledgeit.com.au>
 */
interface EventListenerInterface {

	/**
	 * Attaches the event listener to the event manager
	 * @param   EventManager    $em     The event manager
	 * @return  $this
	 */
	public function attach(EventManager $em);

	/**
	 * Detaches the event listener from the event manager
	 * @param   EventManager    $em     The event manager
	 * @return  $this
	 */
	public function detach(EventManager $em);

}
 