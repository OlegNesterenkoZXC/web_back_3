<?php

header('Content-Type: text/html; charset=UTF-8');

echo "<pre>";
print_r($_POST);
echo "</pre>";

if (!empty($_POST)) {
	if (empty($_POST["name"])) {
		$errors[] = "Поле 'имя' пустое!";
	}
	if (empty($_POST["email"])) {
		$errors[] = "Поле 'e-mail' пустое!";
	}
	if (empty($_POST["year"])) {
		$errors[] = "Выберите год рождения!";
	}
	if (!isset($_POST["gender"])) {
		$errors[] = "Выберите пол!";
	}
	if (!isset($_POST["numlimbs"])) {
		$errors[] = "Выберите кол-во конечностей!";
	}
	if (!isset($_POST["super-powers"])) {
		$errors[] = "Выберите хотя бы одну суперспособность!";
	}
} else {
	$errors[] = "Неверные данные формы!";
}

if (isset($errors)) {
	foreach ($errors as $value) {
		echo "$value<br>";
	}
}
