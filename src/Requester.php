<?php

require_once(BASE_DIR . "src/UserDB.php");

class Requester
{
	private $dbUser;

	public function __construct(UserDB $dbUser)
	{
		$this->dbUser = $dbUser;
	}

	public function adminAuth($login, $password)
	{
		$db = new PDO(
			"mysql:host={$this->dbUser->getServerName()};dbname={$this->dbUser->getDBName()}",
			$this->dbUser->getUser(),
			$this->dbUser->getPassword(),
			array(PDO::ATTR_PERSISTENT => true)
		);

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

		$db = null;

		if (empty($result)) {
			return false;
		}
		return password_verify($password, $result['password']);
	}

	public function getUsersData(): array
	{
		$db = new PDO(
			"mysql:host={$this->dbUser->getServerName()};dbname={$this->dbUser->getDBName()}",
			$this->dbUser->getUser(),
			$this->dbUser->getPassword(),
			array(PDO::ATTR_PERSISTENT => true)
		);

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

		$db = null;

		return $result;
	}
	public function getSupPowUsersData(): array
	{
		$db = new PDO(
			"mysql:host={$this->dbUser->getServerName()};dbname={$this->dbUser->getDBName()}",
			$this->dbUser->getUser(),
			$this->dbUser->getPassword(),
			array(PDO::ATTR_PERSISTENT => true)
		);

		$result = array();

		try {
			$sql =
				"SELECT u.id, p.power 
				FROM user_power2 u 
				JOIN power p 
				ON u.power = p.id";

			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			print('Error : ' . $e->getMessage());
			exit();
		}

		$db = null;

		return $result;
	}
}
