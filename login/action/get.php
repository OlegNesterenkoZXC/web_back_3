<?php

session_start();

if (!empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) {
	session_destroy();
	header("Location: index.php");
	exit();
}

if (!empty($_COOKIE['login-request-error'])) {
	setcookie("login-request-error", '', time() - 60 * 60 * 24);
	$loginHeader =
		"<div class='form__header'>
				<div class='form__contaner form__container_err'>
					<span class='form__span'>Что-то пошло не так! =(</span>
				</div>
			</div>";
} elseif (!empty($_COOKIE['login-auth-error'])) {
	setcookie('login-auth-error', '', time() - 60 * 60 * 24);
	$loginHeader =
		"<div class='form__header'>
				<div class='form__contaner form__container_err'>
					<span class='form__span'>Неверный логин и/или пароль!</span>
				</div>
			</div>";
} else {
	$loginHeader =
		"<div class='form__header'>
				<div class='form__contaner'>
					<span class='form__span form__span_header'>Авторизируйтесь</span>
				</div>
			</div>";
}

$message = array('login-error' => '', 'password-error' => '');
if (!empty($_COOKIE['login-error'])) {
	$message['login-error'] =
		"<div class='form__container form__container_err'>
				<span class='form__span'>{$_COOKIE['login-error']}</span>
			</div>";
	setcookie('login-error', '', time() - 60 * 60 * 24);
}

if (!empty($_COOKIE['password-error'])) {
	$message['password-error'] =
		"<div class='form__container form__container_err'>
				<span class='form__span'>{$_COOKIE['password-error']}</span>
			</div>";
	setcookie('password-error', '', time() - 60 * 60 * 24);
}

require_once(BASE_DIR . "login/layout/form.php");
