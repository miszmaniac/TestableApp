<?php
namespace Tests\Misz\Http;
use Misz\Collection;
use Misz\Http\Request;
use PHPUnit_Framework_TestCase;

class RequestTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	public function canReturnCollections() {
		$systemUnderTest = new Request(array(), array(), array(), array());
		self::assertInstanceOf(Collection::getClass(), $systemUnderTest->getQuery());
		self::assertInstanceOf(Collection::getClass(), $systemUnderTest->getRequest());
		self::assertInstanceOf(Collection::getClass(), $systemUnderTest->getCookies());
		self::assertInstanceOf(Collection::getClass(), $systemUnderTest->getServer());
	}

	/**
	 * @test
	 */
	public function canGetServerParameters() {
		$get = "GET";
		$scriptName = 'test.html';
		$uri = 'test.html?test=123';
		$mockedServerArray = array(
			Request::REQUEST_METHOD => $get,
			Request::SCRIPT_NAME => $scriptName,
			Request::REQUEST_URI => $uri,
		);
		$systemUnderTest = new Request(array(), array(), array(), $mockedServerArray);

		self::assertEquals($get, $systemUnderTest->getMethod());
		self::assertEquals($scriptName, $systemUnderTest->getScriptName());
		self::assertEquals($uri, $systemUnderTest->getRequestUri());
	}

	/**
	 * @test
	 */
	public function globalArraysFactoryMethod() {
		$_GET = $_POST = $_COOKIE = $_SERVER = $dummyArray = array("foo" => "bar");
		$systemUnderTest = Request::createUsingGlobalArrays();
		self::assertEquals($dummyArray, $systemUnderTest->getQuery()->getAll());
		self::assertEquals($dummyArray, $systemUnderTest->getRequest()->getAll());
		self::assertEquals($dummyArray, $systemUnderTest->getCookies()->getAll());
		self::assertEquals($dummyArray, $systemUnderTest->getServer()->getAll());
	}

}
