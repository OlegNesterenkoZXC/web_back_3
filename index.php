<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (!empty($_COOKIE['save'])) {
		setcookie("save", '', time() - 60 * 60 * 24);
		$fheader =  "<div class='form__container form__container_good'><span class='form__span'>Ваши данные отправленны!</span></div>";
	} elseif (!empty($_COOKIE['request-error'])) {
		setcookie("request-error", '', time() - 60 * 60 * 24);
		$fheader =  "<div class='form__container form__container_err'><span class='form__span'>Что-то пошло не так! =(</span></div> ";
	} else {
		$fheader =  "<div class='form__contaner'><span class='form__span form__span_header'>ЗАПОЛНИТЕ</span></div>";
	}

	$message = array();
	getCoookies('name', $message);
	getCoookies('email', $message);
	getCoookies('year', $message);
	getCoookies('gender', $message);
	getCoookies('numlimbs', $message);
	getCoookies('super-powers', $message);
	getCoookies('super-powers-1', $message);
	getCoookies('super-powers-2', $message);
	getCoookies('super-powers-3', $message);
	getCoookies('biography', $message);


	include_once("form.php");
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$requestError = false;
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
			$errors['year'] = "Выберите год!";
		} elseif (!preg_match("/^\s*[1]{1}9{1}\d{1}\d{1}.*$|^\s*200[0-8]{1}.*$/", $_POST["year"])) {
			$requestError = true;
		}

		if (!isset($_POST["gender"])) {
			$errors['gender'] = "Выберите пол!";
		} elseif (intval($_POST["gender"]) < 1 && 2 < intval($_POST["gender"])) {
			$requestError = true;
		}

		if (!isset($_POST["numlimbs"])) {
			$errors['numlimbs'] = "Выберите кол-во конечностей!";
		} elseif (intval($_POST["numlimbs"]) < 1 || 4 < intval($_POST["numlimbs"])) {
			$requestError = true;
		}

		if (!isset($_POST["super-powers"])) {
			$errors['super-powers'] = "Выберите хотя бы одну суперспособность!";
		} else {
			foreach ($_POST["super-powers"] as $value) {
				if (intval($value) < 1 || 3 < intval($value)) {
					$requestError = true;
					break;
				}
			}
		}

		if (empty($_POST["biography"])) {
			$errors['biography'] = "Расскажите что-нибудь о себе!";
		}
	} else {
		$requestError = true;
	}

	if ($requestError) {
		setcookie("request-error", '1', time() + 60 * 60 * 24);
		header("Location: index.php");
	} else {
		if (isset($errors['name'])) {
			setcookie('name-error', $errors['name'], time() + 60 * 60 * 24);
		} else {
			setcookie('name', $_POST['name'], time() + 60 * 60 * 24 * 365);
		}

		if (isset($errors['email'])) {
			setcookie('email-error', $errors['email'], time() + 60 * 60 * 24);
		} else {
			setcookie('email', $_POST['email'], time() + 60 * 60 * 24 * 365);
		}

		if (isset($errors['year'])) {
			setcookie('year-error', $errors['year'], time() + 60 * 60 * 24);
		} else {
			setcookie('year', $_POST['year'], time() + 60 * 60 * 24 * 365);
		}

		if (isset($errors['gender'])) {
			setcookie('gender-error', $errors['gender'], time() + 60 * 60 * 24);
		} else {
			setcookie('gender', $_POST['gender'], time() + 60 * 60 * 24 * 365);
		}

		if (isset($errors['numlimbs'])) {
			setcookie('numlimbs-error', $errors['numlimbs'], time() + 60 * 60 * 24);
		} else {
			setcookie('numlimbs', $_POST['numlimbs'], time() + 60 * 60 * 24 * 365);
		}

		if (isset($errors['super-powers'])) {
			setcookie('super-powers-error', $errors['super-powers'], time() + 60 * 60 * 24);
		} else {
			$supPowers = ['1' => '0', '2' => '0', '3' => 0];
			foreach ($_POST['super-powers'] as $key => $value) {
				$supPowers[$value] = '1';
			}
			foreach ($supPowers as $key => $value) {
				setcookie("super-powers-$key", $value,  time() + 60 * 60 * 24 * 365);
			}
		}

		if (isset($errors['biography'])) {
			setcookie('biography-error', $errors['biography'], time() + 60 * 60 * 24);
		} else {
			setcookie('biography', $_POST['biography'], time() + 60 * 60 * 24 * 365);
		}
	}

	if (isset($errors)) {
		header("Location: index.php");
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
	setcookie("save", '1', time() + 60 * 60 * 24);
	header("Location: index.php");
}
function getCoookies($name, &$message)
{
	if (!empty($_COOKIE[$name])) {
		$message[$name] = $_COOKIE[$name];
	} else {
		$message[$name] = '';
	}
	if (!empty($_COOKIE[$name . '-error'])) {
		$message[$name . '-error'] = "<div class='form__container form__container_err'><span class='form__span'>{$_COOKIE[$name . '-error']}</span></div>";
		setcookie($name . '-error', '', time() - 60 * 60 * 24);
	} else {
		$message[$name . '-error'] = '';
	}
}
