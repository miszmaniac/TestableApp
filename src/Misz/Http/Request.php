<?
namespace Misz\Http;
use Misz\Collection;
use Misz\Object;

class Request extends Object implements CanReadServerParameters {

	/**
	 * @var Collection
	 */
	private $query;

	/**
	 * @var Collection
	 */
	private $request;

	/**
	 * @var Collection
	 */
	private $cookies;

	/**
	 * @var Collection
	 */
	private $server;

	public static function createUsingGlobalArrays() {
		return new Request($_GET, $_POST, $_COOKIE, $_SERVER);
	}

	public function __construct(array $get, array $post, array $cookies, array $server) {
		$this->query = new Collection($get);
		$this->request = new Collection($post);
		$this->cookies = new Collection($cookies);
		$this->server = new Collection($server);
	}

	/**
	 * @return Collection
	 */
	public function getQuery() {
		return $this->query;
	}

	/**
	 * @return Collection
	 */
	public function getRequest() {
		return $this->request;
	}

	/**
	 * @return Collection
	 */
	public function getCookies() {
		return $this->cookies;
	}

	/**
	 * @return Collection
	 */
	public function getServer() {
		return $this->server;
	}

	public function getMethod() {
		return $this->getServer()->get(self::REQUEST_METHOD);
	}

	public function getRequestUri() {
		return $this->getServer()->get(self::REQUEST_URI);
	}

	public function getScriptName() {
		return $this->getServer()->get(self::SCRIPT_NAME);
	}

}
