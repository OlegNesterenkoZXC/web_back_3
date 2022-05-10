<?php
session_start();

require_once(BASE_DIR . "src/functions.php");

if (!empty($_COOKIE['save'])) {
	setcookie("save", '', time() - 60 * 60 * 24);
	setcookie("login", '', time() - 60 * 60 * 24);
	setcookie("password", '', time() - 60 * 60 * 24);

	$fheader = "<div class='form__container form__container_good'>
	<span class='form__span'>Ваши данные отправленны!</span>
	</div>
	<div class='form__container'>
		<p class='form__p'>Вы можете <a href='login.php' class='form__a'>войти</a>!</p>
		<p class='form__p'>По логину: <strong>{$_COOKIE['login']}</strong></p>
		<p class='form__p'>И паролю: <strong>{$_COOKIE['password']}</strong></p>
	</div>";
} elseif (!empty($_COOKIE['request-error'])) {
	setcookie("request-error", '', time() - 60 * 60 * 24);
	$fheader = "<div class='form__container form__container_err'><span class='form__span'>Что-то пошло не так! =(</span></div>";
} elseif (!empty($_COOKIE['update'])) {
	setcookie("update", '0', time() - 60 * 60 * 24);
	$fheader =
		"<div class='form__container form__container_good'>
			<span class='form__span'>Ваши данные обновленны!</span>
		</div>";
} else {
	$fheader = "<div class='form__contaner'><span class='form__span form__span_header'>ЗАПОЛНИТЕ</span></div>";
}

if (!empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) {
	$ffooter =
		"<div class='form__footer'>
			<p class='form__p'>
				Вы авторизованы, ваш логин: <strong>{$_SESSION['login']}</strong>
			</p>
			<p class='form__p'>
				Вы можете <a href='/web_back_5/index.php?action=login' class='form__a'>выйти</a>!
			</p>
		</div>";
} else {
	$ffooter =
		"<div class='form__footer'>
			<p class='form__p'>
				У вас уже есть аккаунт?
			</p>
			<p class='form__p'>
				Вы можете <a href='/web_back_5/index.php?action=login' class='form__a'> войти</a>!
			</p>
		</div>";
}

$message = array();
checkCookies('name', $message);
checkCookies('email', $message);
checkCookies('year', $message);
checkCookies('gender', $message);
checkCookies('numlimbs', $message);
checkCookies('super-powers', $message);
checkCookies('biography', $message);

require_once(BASE_DIR . "main/layout/form.php");
