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

	$message['login-error'] =
		"<div class='form__container form__container_err'>
			<span class='form__span'>{$_COOKIE['login-error']}</span>
		</div>";
}

if (!empty($_COOKIE['password-error'])) {
	setcookie('password-error', '', time() - 60 * 60 * 24);
	$message['password-error'] =
		"<div class='form__container form__container_err'>
			<span class='form__span'>{$_COOKIE['password-error']}</span>
		</div>";
}

require_once(BASE_DIR . "login/layout/form.php");
require_once(BASE_DIR . "login/layout/end.php");
