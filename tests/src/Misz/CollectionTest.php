<?php
namespace Tests\Misz;
use Misz\Collection;
use PHPUnit_Framework_TestCase;

class CollectionTest extends PHPUnit_Framework_TestCase {

	const FIRST_KEY = "foo";
	const SECOND_KEY = "bar";
	const FIRST_VALUE = "baz";
	const SECOND_VALUE = "qux";
	const DUMMY_KEY = "dummyKey";

	/**
	 *
	 * @var Collection
	 */
	private $systemUnderTest;

	/**
	 * Array for collection creation
	 * @var array
	 */
	private $dummyArray;

	public function setUp() {
		$this->dummyArray = array(self::FIRST_KEY => self::FIRST_VALUE);

		$this->systemUnderTest = new Collection($this->dummyArray);
	}

	/**
	 * @test
	 */
	public function emptyCollectionFactoryMethod() {
		$systemUnderTest = Collection::createEmptyCollection();
		self::assertEquals(array(), $systemUnderTest->getAll());
	}

	/**
	 * @test
	 */
	public function canReadAll() {
		self::assertEquals($this->dummyArray, $this->systemUnderTest->getAll());
	}

	/**
	 * @test
	 */
	public function canGetItemFromCollection() {
		self::assertFalse($this->systemUnderTest->has(self::DUMMY_KEY));
		self::assertTrue($this->systemUnderTest->has(self::FIRST_KEY));

		self::assertNull($this->systemUnderTest->get(self::DUMMY_KEY));
		self::assertEquals(self::FIRST_VALUE, $this->systemUnderTest->get(self::FIRST_KEY));

		$defaultValue = 'default';
		self::assertEquals($defaultValue, $this->systemUnderTest->get(self::DUMMY_KEY, $defaultValue));
	}

	/**
	 * @test
	 */
	public function canAddItemToCollection() {
		self::assertNull($this->systemUnderTest->get(self::SECOND_KEY));

		$this->systemUnderTest->add(self::SECOND_KEY, self::SECOND_VALUE);

		self::assertEquals(self::SECOND_VALUE, $this->systemUnderTest->get(self::SECOND_KEY));
	}

	/**
	 * @test
	 */
	public function canBeCounted() {
		self::assertEquals(count($this->dummyArray), count($this->systemUnderTest));
	}

	/**
	 * @test
	 */
	public function implementsArrayIterator() {
		self::assertInstanceOf("\ArrayIterator", $this->systemUnderTest->getIterator());
		foreach ($this->systemUnderTest as $key => $value) {
			self::assertEquals(self::FIRST_KEY, $key);
			self::assertEquals(self::FIRST_VALUE, $value);
		}
	}

}
