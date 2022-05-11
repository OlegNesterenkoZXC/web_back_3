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

print('Вы успешно авторизовались и видите защищенные паролем данные.');
