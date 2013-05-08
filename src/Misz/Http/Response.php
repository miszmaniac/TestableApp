<?php
namespace Misz\Http;
use InvalidArgumentException;
use Misz\Collection;
use Misz\Object;

class Response extends Object {

	/**
	 * @var string
	 */
	private $content;

	/**
	 * @var integer
	 */
	private $httpStatusCode;

	/**
	 * @var array
	 */
	private $knownStatusCodes = array(200, 300, 301, 302, 303, 404, 500);

	/**
	 * @var Collection
	 */
	private $headers;

	/**
	 * @param string $location
	 * @return \Misz\Http\Response
	 */
	public static function redirect($location) {
		$response = new Response("", 303, array('Location' => $location));
		$response->sendHeaders();
		return $response;
	}

	public function __construct($content, $httpStatusCode = 200, $headers = array()) {
		$this->content = $content;
		$this->setStatusCode($httpStatusCode);
		$this->headers = new Collection($headers);
	}

	private function setStatusCode($httpStatusCode) {
		if (!in_array($httpStatusCode, $this->knownStatusCodes)) {
			throw new InvalidArgumentException("Unknown httpStatusCode: $httpStatusCode");
		}
		$this->httpStatusCode = $httpStatusCode;
	}

	public function renderContent() {
		echo $this->content;
	}

	public function sendHeaders() {
		http_response_code($this->httpStatusCode);

		foreach ($this->headers as $name => $value) {
			header("$name: $value");
		}
	}

}

