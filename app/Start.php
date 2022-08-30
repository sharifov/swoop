<?php

class Start {

	public static function bootstrap(Router $router): void
	{
		session_start();

		$router->register([__CLASS__, 'error']);
	}

	public static function error()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'abort');
		exit;
    }
}