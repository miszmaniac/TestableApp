<?php
namespace Tests\Misz\Http;
use InvalidArgumentException;
use Misz\Http\Response;
use PHPUnit_Framework_TestCase;

class ResponseTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	public function canRenderContent() {
		$content = "some text content";

		$systemUnderTest = new Response($content);
		ob_start();
		$systemUnderTest->renderContent();
		$actualString = ob_get_clean();
		self::assertContains($content, $actualString);
	}

	/**
	 * @test
	 */
	public function canSetHttpStatusCode() {
		new Response('', 200);
		new Response('', 303);
		new Response('', 404);
		try {
			new Response('', 600);
			self::fail('Should return InvalidArgumentException');
		} catch (InvalidArgumentException $expectedException) {
			self::assertInstanceOf('\InvalidArgumentException', $expectedException);
		}
	}

	/**
	 * @test
	 * @dataProvider statusCodes
	 */
	public function canSendHttpStatusCode($statusCode) {
		$response = new Response("", $statusCode);
		$response->sendHeaders();
		$currentStatusCode = http_response_code();
		self::assertEquals($statusCode, $currentStatusCode);
	}

	/**
	 * @return array
	 */
	public static function statusCodes() {
		return array(
			array(200),
			array(303),
			array(404)
		);
	}

	/**
	 * @test
	 * @runInSeparateProcess
	 */
	public function canSendHeaders() {
		$systemUnderTest = new Response('', 303, array("Location" => "http://www.google.pl"));
		$systemUnderTest->sendHeaders();
		$headersAfterResponse = xdebug_get_headers();
		self::assertContains("Location: http://www.google.pl", $headersAfterResponse);
	}

	/**
	 * @test
	 * @runInSeparateProcess
	 */
	public function staticRedirectFactory() {
		Response::redirect("http://www.google.pl");
		self::assertContains("Location: http://www.google.pl", xdebug_get_headers());
		self::assertEquals(303, http_response_code());
	}

}
