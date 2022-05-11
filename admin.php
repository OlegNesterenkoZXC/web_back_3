<?php
define("BASE_DIR", __DIR__ . DIRECTORY_SEPARATOR);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once("admin/action/get.php");
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once("admin/action/post.php");
}
