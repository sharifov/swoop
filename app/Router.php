<?php

class Router {

	public string $controllerName = DEFAULT_CONTROLLER;
	public string $actionName = DEFAULT_ACTION;
	public array $params = [];
	public object $controller;

	public function register(Callable $callback): void
	{
		
		$routes = explode('/', str_replace(['?', $_SERVER['QUERY_STRING']], '', trim($_SERVER['REQUEST_URI'], '/')));

		if (!empty($routes[0])) {
			$this->controllerName = $routes[0];
		}

		$this->controllerName = ucfirst(strtolower($this->controllerName));
		
		if (!empty($routes[1])) {
			$this->actionName = $routes[1];
		}

		if (count($routes) > 2) {
			$this->params = array_slice($routes, 2);
		}
	
		// Сформируем Имя Контроллера
		$controllerPath = DIR_CONTROLLER . $this->controllerName . '.php';

		if (file_exists($controllerPath)) {
			require_once $controllerPath;
		} else {
			$callback();
		}
	
		//Подключаем Контроллер
		$this->controller = new $this->controllerName;

		if (method_exists($this->controller, $this->actionName)) {
			call_user_func_array([$this->controller, $this->actionName], $this->params);
		} else {
			$callback();
		}
	}
}