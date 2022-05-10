<?php
session_start();
require_once(BASE_DIR . "src/db.php");

$requestError = false;
if (!empty($_POST)) {
	if (empty($_POST["login"])) {
		$errors['login'] = "Введите логин";
	}

	if (empty($_POST["password"])) {
		$errors['password'] = "Введите пароль";
	}
} else {
	$requestError = true;
}

if ($requestError) {
	setcookie("login-request-error", '1', time() + 60 * 60 * 24);
	header("Location: login.php");
} else {
	if (isset($errors['login'])) {
		setcookie('login-error', $errors['login'], time() + 60 * 60 * 24);
	}
	if (isset($errors['password'])) {
		setcookie('password-error', $errors['password'], time() + 60 * 60 * 24);
	}
}

if (isset($errors)) {
	header("Location: login.php");
	exit();
}

$userLogin = $_POST["login"];
$userPassword = $_POST["password"];

require_once("src/db.php");
$db = new PDO("mysql:host=$dbServerName;dbname=$dbName", $dbUser, $dbPassword, array(PDO::ATTR_PERSISTENT => true));

$success = false;
try {
	$sql =
		"SELECT * FROM user_authentication
			WHERE login = :login";
	$stmt = $db->prepare($sql);
	$stmt->execute(array('login' => $userLogin));
	$result = $stmt->fetch();

	if (!empty($result)) {
		$success = password_verify($userPassword, $result['password']);
		$userId = $result['id'];
	}
} catch (PDOException $e) {
	print('Error : ' . $e->getMessage());
	exit();
}

if ($success) {
	$_SESSION['login'] = $userLogin;
	$_SESSION['loginid'] = $userId;
} else {
	setcookie('login-auth-error', '1', time() + 60 * 60 * 24);
	header("Location: login.php");
	exit();
}
header("Location: index.php");
