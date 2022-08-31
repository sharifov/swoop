<?php

class Auth {
	
	public static function login(string $login, string $pass): void
	{
	}

	public static function has(): bool
	{
		return isset($_SESSION['admin']);
	}
}