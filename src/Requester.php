<?php
class Requester
{
	public static function adminAuth($login, $password)
	{
		require_once(BASE_DIR . "src/db.php");

		$db = new PDO("mysql:host=$dbServerName;dbname=$dbName", $dbUser, $dbPassword, array(PDO::ATTR_PERSISTENT => true));
		try {
			$sql = "SELECT * FROM admin_auth
					WHERE login = :login";
			$stmt = $db->prepare($sql);
			$stmt->execute(array('login' => $login));
			$result = $stmt->fetch();
		} catch (PDOException $e) {
			print('Error : ' . $e->getMessage());
			exit();
		}
		if (password_verify($password, $result['password'])) {
			return true;
		}
		return false;
	}
}
