<?php
namespace Tests\Misz;

use Misz\Object;
use PHPUnit_Framework_TestCase;

class ObjectTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	public function canReturnClassName() {
		self::assertEquals("Misz\Object", Object::getClass());
	}

}
