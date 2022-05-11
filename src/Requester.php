<?php
class Requester
{
	public static function adminAuth($login, $password)
	{
		require_once(BASE_DIR . "src/db.php");

		$db = new PDO("mysql:host=$dbServerName;dbname=$dbName", $dbUser, $dbPassword, array(PDO::ATTR_PERSISTENT => true));
		try {
			$sql = "SELECT password FROM admin_auth
					WHERE login = :login";
			$stmt = $db->prepare($sql);
			$stmt->execute(array('login' => $login));
			$result = $stmt->fetch();
		} catch (PDOException $e) {
			print('Error : ' . $e->getMessage());
			exit();
		}
		if (empty($result)) {
			return false;
		}
		return password_verify($password, $result['password']);
	}

	public static function getUsersData(): array
	{
		require_once(BASE_DIR . "src/db.php");

		$db = new PDO("mysql:host=$dbServerName;dbname=$dbName", $dbUser, $dbPassword, array(PDO::ATTR_PERSISTENT => true));

		$result = array();

		try {
			$sql = "SELECT * FROM user2";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			print('Error : ' . $e->getMessage());
			exit();
		}
		return $result;
	}
	public static function getSupPowUsersData(): array
	{
		require_once(BASE_DIR . "src/db.php");

		$db = new PDO("mysql:host=$dbServerName;dbname=$dbName", $dbUser, $dbPassword, array(PDO::ATTR_PERSISTENT => true));

		$result = array();

		try {
			$sql = "SELECT * FROM user_power2";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			print('Error : ' . $e->getMessage());
			exit();
		}
		return $result;
	}
}
