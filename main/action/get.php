<?php
session_start();

require_once(BASE_DIR . "src/functions.php");

if (!empty($_COOKIE['save'])) {
	setcookie("save", '', time() - 60 * 60 * 24);
	setcookie("login", '', time() - 60 * 60 * 24);
	setcookie("password", '', time() - 60 * 60 * 24);

	require_once(BASE_DIR . "main/layout/start.php");
	require_once(BASE_DIR . "main/layout/header/succes.php");
} elseif (!empty($_COOKIE['request-error'])) {
	setcookie("request-error", '', time() - 60 * 60 * 24);

	require_once(BASE_DIR . "main/layout/start.php");
	require_once(BASE_DIR . "main/layout/header/error.php");
} elseif (!empty($_COOKIE['update'])) {
	setcookie("update", '', time() - 60 * 60 * 24);

	require_once(BASE_DIR . "main/layout/start.php");
	require_once(BASE_DIR . "main/layout/header/update.php");
} else {
	require_once(BASE_DIR . "main/layout/start.php");
	require_once(BASE_DIR . "main/layout/header/header.php");
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

if (!empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) {
	require_once(BASE_DIR . "main/layout/footer/authorized.php");
} else {
	require_once(BASE_DIR . "main/layout/footer/footer.php");
}

require_once(BASE_DIR . "main/layout/end.php");
