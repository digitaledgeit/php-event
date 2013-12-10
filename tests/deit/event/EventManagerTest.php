<?php

namespace deit\event;

/**
 * Event manager test
 * @author James Newell <james@digitaledgeit.com.au>
 */
class EventManagerTest extends \PHPUnit_Framework_TestCase {

	public function test() {

		$em = new EventManager();

		$em
			->attach('my.test.event.1', function() {
				echo 'the 1st event has occurred'.PHP_EOL;
			})
			->attach('my.test.event.2', function() {
				echo 'the 2nd event has occurred'.PHP_EOL;
			})
		;

		$em->trigger('my.test.event.2');
		$em->trigger('my.test.event.1');


	}

}
