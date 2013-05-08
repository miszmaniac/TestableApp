<?php
namespace Misz\Http;

interface CanReadServerParameters {

	const REQUEST_METHOD = "REQUEST_METHOD";
	const REQUEST_URI = "REQUEST_URI";
	const SCRIPT_NAME = "SCRIPT_NAME";

	/**
	 * @return string
	 */
	public function getMethod();

	/**
	 * @return string
	 */
	public function getRequestUri();

	/**
	 * @return string
	 */
	public function getScriptName();
}
