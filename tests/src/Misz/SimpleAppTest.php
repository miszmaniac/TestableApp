<?php
namespace Tests\Misz;
use Misz\Http\Request;
use Misz\Http\Response;
use Misz\SimpleApp;
use Phake;
use PHPUnit_Framework_TestCase;

class SimpleAppTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var Request
	 */
	private $request;

	public function setUp() {
		$this->request = Phake::mock(Request::getClass());
	}

	/**
	 * @return Request
	 */
	private function getRequestMock() {
		return $this->request;
	}

	/**
	 * @test
	 */
	public function canRunAndReturnResponse() {
		$systemUnderTest = new SimpleApp($this->getRequestMock());
		$response = $systemUnderTest->run();
		self::assertInstanceOf(Response::getClass(), $response);
	}

	/**
	 * @test
	 */
	public function return404ResponseForUnknownPage() {
		$responseContent = $this->createSimpleAppAndReturnResponseContent();
		self::assertEquals(SimpleApp::SAMPLE_RESPONSE_ERROR, $responseContent);
	}

	/**
	 * @return string
	 */
	private function createSimpleAppAndReturnResponseContent() {
		$systemUnderTest = new SimpleApp($this->getRequestMock());
		ob_start();
		$systemUnderTest->runAndRender();
		return ob_get_clean();
	}

	/**
	 * @test
	 */
	public function returnsCorrectResponseForKnownPage() {
		Phake::when($this->getRequestMock())->getScriptName()->thenReturn(SimpleApp::SAMPLE_KNOWN_SCRIPT_NAME);
		$responseContent = $this->createSimpleAppAndReturnResponseContent();

		self::assertEquals(SimpleApp::SAMPLE_RESPONSE_OK, $responseContent);
	}

}
