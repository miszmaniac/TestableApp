<?
//Only for php5.4 development mode
$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
	return false;
}

require './vendor/autoload.php';

$request = Misz\Http\Request::createUsingGlobalArrays();


$response = new Misz\Http\Response($request->getMethod(), 404);
$response->sendHeaders();
$response->renderContent();
