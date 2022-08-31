<?php
class Controller {
	use Filter;
	
	protected array $accessData = [];
	public object $model;
	public object $view;
	public array $before = [];

	public function __construct()
	{
		$_SESSION['csrf'] = isset($_SESSION['csrf']) ? $_SESSION['csrf'] : md5(uniqid(mt_rand().microtime())); // Уcтановливаем Token для Csrf
		
		// Проверяем доступ на вход
		if (!empty($this->before)) {
			foreach ($this->before as $access) {
				if (!$this->{'filter'.ucfirst($access)}()) {
					Start::error();
				}
				$this->accessData[$access] = $_SESSION[$access];
			}
		}
	
		// Определяем Вид
		$this->view = new View($this->accessData, strtolower(get_class($this)));
	}

	public function model(string $model_name): void
	{
		$model_name = ucfirst(strtolower($model_name));
		$model_path = DIR_MODEL . $model_name . '.php';
		if (file_exists($model_path)) {
			include_once $model_path;
		}

		$this->model = new $model_name;
	}

	// Очистка данных из запросов
	public function clear(int|string $data, bool $int = false): int|string
	{
		$data = trim($data);

		if ($int) {
			return abs((int) $data);
		} else {
			return htmlspecialchars(trim(strip_tags($data)));
		}
	}
	
	public function hash(string $str): string 
	{
		return md5(strrev(bin2hex($str)));
	}

	public function redirect(?string $url = null, ?string $flash = null): never
	{
		if (isset($flash)) {
			$_SESSION['flash'] = $flash;
		}
		
		header("Location: http://{$_SERVER['HTTP_HOST']}/${url}");
		exit(0);
	}
}