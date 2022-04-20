<?php

//header('Content-Type: text/html; charset=UTF-8');

if (!empty($_POST)) {
	if (empty($_POST["name"])) {
		$errors['name'] = "Введите имя!";
	} elseif (!preg_match("/^\s*[a-zA-Zа-яА-Я'][a-zA-Zа-яА-Я-' ]+[a-zA-Zа-яА-Я']?\s*$/u", $_POST["name"])) {
		$errors['name'] = "Несуществующее имя!";
	}

	if (empty($_POST["email"])) {
		$errors['email'] = "Введите e-mail!";
	} elseif (!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $_POST["email"])) {
		$errors['email'] = "Несуществующий e-mail!";
	}

	if (empty($_POST["year"])) {
		$errors['year'] = "Выберите год рождения!";
	} elseif (!preg_match("/^\s*[1]{1}9{1}\d{1}\d{1}.*$|^\s*200[0-8]{1}.*$/", $_POST["year"])) {
		$errors["request-error"] = "Ошибка запроса!";
	}

	if (!isset($_POST["gender"])) {
		$errors['gender'] = "Выберите пол!";
	} elseif (intval($_POST["gender"]) < 1 && 2 < intval($_POST["gender"])) {
		$errors["request-error"] = "Ошибка запроса!";
	}

	if (!isset($_POST["numlimbs"])) {
		$errors['numlimbs'] = "Выберите кол-во конечностей!";
	} elseif (intval($_POST["numlimbs"]) < 1 || 4 < intval($_POST["numlimbs"])) {
		$errors["request-error"] = "Ошибка запроса!";
	}

	if (!isset($_POST["super-powers"])) {
		$errors['super-powers'] = "Выберите хотя бы одну суперспособность!";
	} else {
		foreach ($_POST["super-powers"] as $value) {
			if (intval($value) < 1 || 3 < intval($value)) {
				$errors["request-error"] = "Ошибка запроса!";
				break;
			}
		}
	}

	if (empty($_POST["biography"])) {
		$errors['biography'] = "Расскажите что-нибудь о себе!";
	}
} else {
	$errors["request-error"] = "Ошибка запроса!";
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
	$agree = 0;
} else {
	$agree = 1;
}

$serverName = 'localhost';
$user = "u47565";
$pass = "7165854";
$dbName = $user;

$db = new PDO("mysql:host=$serverName;dbname=$dbName", $user, $pass, array(PDO::ATTR_PERSISTENT => true));

$lastId = null;
try {
	$stmt = $db->prepare("INSERT INTO user (name, email, date, gender, limbs, biography, agreement) VALUES (:name, :email, :date, :gender, :limbs, :biography, :agreement)");
	$stmt->execute(array('name' => $name, 'email' => $email, 'date' => $year, 'gender' => $gender, 'limbs' => $limbs, 'biography' => $biography, 'agreement' => $agree));
	$lastId = $db->lastInsertId();
} catch (PDOException $e) {
	print('Error : ' . $e->getMessage());
	exit();
}

try {
	if ($lastId === null) {
		exit();
	}
	foreach ($superPowers as $value) {
		$stmt = $db->prepare("INSERT INTO user_power (id, power) VALUES (:id, :power)");
		$stmt->execute(array('id' => $lastId, 'power' => $value));
	}
} catch (PDOException $e) {
	print('Error : ' . $e->getMessage());
	exit();
}
$db = null;
echo "Данные отправлены!";
