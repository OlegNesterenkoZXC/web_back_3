<?php
class UserDB
{
	private string $serverName;
	private string $user;
	private string $password;
	private string $dbName;

	public function __construct(string $servername, string $user, string $password, string $dbname)
	{
		$this->serverName = $servername;
		$this->user = $user;
		$this->password = $password;
		$this->dbName = $dbname;
	}

	public function getServerName(): string
	{
		return $this->serverName;
	}
	public function getUser(): string
	{
		return $this->user;
	}
	public function getPassword(): string
	{
		return $this->password;
	}
	public function getDBName(): string
	{
		return $this->dbName;
	}
}
