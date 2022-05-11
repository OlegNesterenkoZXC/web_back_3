<?php
session_start();
require_once(BASE_DIR . "src/UserData.php");
require_once(BASE_DIR . "src/functions.php");
require_once(BASE_DIR . "src/db.php");
require_once(BASE_DIR . "src/formHandler.php");

$requestError = false;
if (!empty($_POST)) {

	$userData = new UserData(
		$_POST['name'] ?? '',
		$_POST['email'] ?? '',
		$_POST['year'] ?? '',
		$_POST['gender'] ?? '',
		$_POST['numlimbs'] ?? '',
		$_POST['super-powers'] ?? '',
		$_POST['biography'] ?? '',
	);

	$errors = formHandler::checkUserData($userData);
} else {
	$errors["requestError"] = true;
}

if ($errors["requestError"]) {
	setcookie("request-error", '1', time() + 60 * 60 * 24);
	header("Location: index.php");
	exit();
} else {
	writeCookies('name', $errors, $userData->getName());
	writeCookies('email', $errors, $userData->getEmail());
	writeCookies('year', $errors, $userData->getYear());
	writeCookies('gender', $errors, $userData->getGender());
	writeCookies('numlimbs', $errors, $userData->getNumlimbs());
	writeCookies('biography', $errors, $userData->getBiography());

	if (isset($errors['super-powers'])) {
		setcookie('super-powers-error', $errors['super-powers'], time() + 60 * 60 * 24);
	} else {
		$supPowers = array('1' => '0', '2' => '0', '3' => '0');
		foreach ($userData->getSuperPowers() as $value) {
			$supPowers[$value] = '1';
		}
		foreach ($supPowers as $key => $value) {
			setcookie("super-powers[$key]", $value, time() + 60 * 60 * 24 * 365);
		}
	}
}

if (count($errors) > 1) {
	header("Location:");
	exit();
}

$db = new PDO("mysql:host=$dbServerName;dbname=$dbName", $dbUser, $dbPassword, array(PDO::ATTR_PERSISTENT => true));

if (!empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) {
	$userId = intval($_SESSION['loginid']);

	try {
		$sql = "UPDATE user2 SET name = :name, email = :email, date = :date, gender = :gender, limbs = :limbs, biography = :biography WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->execute(array(
			'id' => $userId, 'name' => $userData->getName(), 'email' => $userData->getEmail(),
			'date' => intval($userData->getYear()), 'gender' => $userData->getGender(), 'limbs' => intval($userData->getNumlimbs()),
			'biography' => $userData->getBiography()
		));
	} catch (PDOException $e) {
		print('Error : ' . $e->getMessage());
		exit();
	}

	try {
		$sql = "DELETE FROM user_power2 WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->execute(array('id' => $userId));
	} catch (PDOException $e) {
		print('Error : ' . $e->getMessage());
		exit();
	}

	try {
		foreach ($userData->getSuperPowers() as $value) {
			$stmt = $db->prepare("INSERT INTO user_power2 (id, power) VALUES (:id, :power)");
			$stmt->execute(array('id' => $userId, 'power' => intval($value)));
		}
	} catch (PDOException $e) {
		print('Error : ' . $e->getMessage());
		exit();
	}
	setcookie("update", '1', time() + 60 * 60 * 24);
} else {
	$lastId = null;

	try {
		$stmt = $db->prepare("INSERT INTO user2	(name, email, date, gender, limbs, biography) 
				VALUES (:name, :email, :date, :gender, :limbs, :biography)");

		$stmt->execute(array(
			'name' => $userData->getName(), 'email' => $userData->getEmail(), 'date' => intval($userData->getYear()),
			'gender' => $userData->getGender(), 'limbs' => intval($userData->getNumlimbs()),
			'biography' => $userData->getBiography()
		));

		$lastId = $db->lastInsertId();
	} catch (PDOException $e) {
		print('Error : ' . $e->getMessage());
		exit();
	}

	try {
		if ($lastId === null) {
			exit();
		}
		foreach ($userData->getSuperPowers() as $value) {
			$stmt = $db->prepare("INSERT INTO user_power2 (id, power) VALUES (:id, :power)");
			$stmt->execute(array('id' => $lastId, 'power' => intval($value)));
		}
	} catch (PDOException $e) {
		print('Error : ' . $e->getMessage());
		exit();
	}

	$login =  "user$lastId";
	$password = gen_password();
	try {
		$stmt = $db->prepare("INSERT INTO user_authentication (id, login, password) VALUES (:id, :login, :password)");
		$stmt->execute(array('id' => $lastId, 'login' => $login, 'password' => password_hash($password, PASSWORD_DEFAULT)));
	} catch (PDOException $e) {
		print('Error : ' . $e->getMessage());
		exit();
	}

	setcookie('login', $login, time() + 60 * 60 * 24);
	setcookie('password', $password, time() + 60 * 60 * 24);
	setcookie("save", '1', time() + 60 * 60 * 24);
}

$db = null;

header("Location: ");
exit();
