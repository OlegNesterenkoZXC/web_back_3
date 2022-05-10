<?php

define("BASE_DIR", __DIR__ . DIRECTORY_SEPARATOR);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$req = $_GET['action'] ?? '';
	if ($req === "login") {
		require_once("login/action/get.php");
	} else {
		require_once("main/action/get.php");
	}
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$req = $_POST['action'] ?? '';
	if ($req === 'login') {
		require_once("login/action/post.php");
	} else {
		require_once("main/action/post.php");
	}
}
