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
	if (empty($_POST["biography"])) {
		$errors[] = "Расскажите что-нибудь о себе!";
	}
} else {
	$errors[] = "Неверные данные формы!";
}

if (isset($errors)) {
	foreach ($errors as $value) {
		echo "$value<br>";
	}
	exit();
}
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$year = intval(htmlspecialchars($_POST["year"]));
$gender = htmlspecialchars($_POST["gender"]);
$limbs = intval(htmlspecialchars($_POST["numlimbs"]));
$superPowers = $_POST["super-powers"];
$biography = htmlspecialchars($_POST["biography"]);
if (!isset($_POST["agree"])) {
	$agree = false;
} else {
	$agree = true;
}
$serverName = 'localhost';
$user = "u47565";
$pass = "7165854";
$dbName = $user;

$dbUser = new PDO("mysql:host=$serverName;dbname=$dbName", $user, $pass, array(PDO::ATTR_PERSISTENT => true));

try {
	$stmt = $dbUser->prepare("INSERT INTO user (name, email, date, gender, limbs, biography, agreement) VALUES (:name, :email, :date, :gender, :limbs, :biography, :agreement)");

	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':date', $year);
	$stmt->bindParam(':limbs', $limbs);
	$stmt->bindParam(':biography', $biography);
	$stmt->bindParam(':agreement', $agree);

	$stmt->execute();
} catch (PDOException $e) {
	print('Error : ' . $e->getMessage());
	exit();
}
