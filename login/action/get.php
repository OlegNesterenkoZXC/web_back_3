<?php

session_start();

if (!empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) {
	session_destroy();
	header("Location: index.php");
	exit();
}

require_once(BASE_DIR . "login/layout/start.php");

if (!empty($_COOKIE['login-request-error'])) {
	setcookie("login-request-error", '', time() - 60 * 60 * 24);

	require_once(BASE_DIR . "login/layout/header/error.php");
} elseif (!empty($_COOKIE['login-auth-error'])) {
	setcookie('login-auth-error', '', time() - 60 * 60 * 24);

	require_once(BASE_DIR . "login/layout/header/dataError.php");
} else {
	require_once(BASE_DIR . "login/layout/header/header.php");
}

$message = array('login-error' => '', 'password-error' => '');
if (!empty($_COOKIE['login-error'])) {
	setcookie('login-error', '', time() - 60 * 60 * 24);

	$message['login-error'] = $_COOKIE['login-error'];
}

if (!empty($_COOKIE['password-error'])) {
	setcookie('password-error', '', time() - 60 * 60 * 24);
	$message['password-error'] = $_COOKIE['password-error'];
}

require_once(BASE_DIR . "login/layout/form.php");
require_once(BASE_DIR . "login/layout/end.php");
