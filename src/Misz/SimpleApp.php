<?php
namespace Misz;
use Misz\Http\Request;

class SimpleApp extends Object {

	const SAMPLE_RESPONSE_OK = "Here would be application logic";
	const SAMPLE_RESPONSE_ERROR = "Not known page";
	const SAMPLE_KNOWN_SCRIPT_NAME = '/test.html';
	/**
	 * @var Request
	 */
	private $request;

	/**
	 * @param Request $request
	 */
	public function __construct(Http\Request $request) {
		$this->request = $request;
	}

	public function run() {
		if ($this->request->getScriptName() == self::SAMPLE_KNOWN_SCRIPT_NAME) {
			return new Http\Response(self::SAMPLE_RESPONSE_OK);
		} else {
			return new Http\Response(self::SAMPLE_RESPONSE_ERROR, 404);
		}
	}

	public function runAndRender() {
		$response = $this->run();
		$response->sendHeaders();
		$response->renderContent();
	}

}

