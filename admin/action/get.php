<?php

require_once(BASE_DIR . "src/Requester.php");

if (
	empty($_SERVER['PHP_AUTH_USER']) ||
	empty($_SERVER['PHP_AUTH_PW']) ||
	!Requester::adminAuth($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])
) {
	header('HTTP/1.1 401 Unanthorized');
	header('WWW-Authenticate: Basic realm="Test Authentication System"');
	print('<h1>401 Требуется авторизация</h1>');
	exit();
}

require_once(BASE_DIR . "admin/layout/start.php");
require_once(BASE_DIR . "admin/layout/tableUser.php");
require_once(BASE_DIR . "admin/layout/tableSPs.php");
require_once(BASE_DIR . "admin/layout/tableStat.php");
require_once(BASE_DIR . "admin/layout/end.php");
