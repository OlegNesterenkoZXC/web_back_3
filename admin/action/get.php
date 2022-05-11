<?php
if (
	empty($_SERVER['PHP_AUTH_USER']) ||
	empty($_SERVER['PHP_AUTH_PW']) ||
	$_SERVER['PHP_AUTH_USER'] != 'admin' ||
	$_SERVER['PHP_AUTH_PW'] != '1235'
) {
	header('HTTP/1.1 401 Unanthorized');
	header('WWW-Authenticate: Basic realm="My site"');
	print('<h1>401 Требуется авторизация</h1>');
	exit();
}

print('Вы успешно авторизовались и видите защищенные паролем данные.');
