<?
namespace Misz;
use ArrayIterator;
use Countable;
use IteratorAggregate;

class Collection extends Object implements IteratorAggregate, Countable {

	/**
	 * @var array
	 */
	private $items;

	public static function createEmptyCollection() {
		return new static(array());
	}

	public function __construct(array $items) {
		$this->items = $items;
	}

	/**
	 * @return array
	 */
	public function getAll() {
		return $this->items;
	}

	public function has($key) {
		return array_key_exists($key, $this->items);
	}

	/**
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function get($key, $default = null) {
		if (!$this->has($key)) {
			return $default;
		}
		return $this->items[$key];
	}

	public function add($key, $value) {
		$this->items[$key] = $value;
	}

	public function count() {
		return count($this->items);
	}

	public function getIterator() {
		return new ArrayIterator($this->items);
	}

}

