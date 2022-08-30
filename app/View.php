<?php
class View {

	private string $folder = 'main';
	private string $layout = 'main';
	
    // Значение по умольчанию
    public array $data = [
    	'title'=>'Swoop',
    	'flash'=>'',
    	'notice'=>'',
    	'desc' => ''
    ];

    // Получаем допольнительные параметри с помощью конструктора
    public function __construct(array $accessData, bool|string $folder = false)
    {
        // берем флеш Сообшения из сессии
        if (isset($_SESSION['flash'])) {
            $this->data['flash'] = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        if ($folder) {
        	$this->folder = $folder;
        }

        if (!empty($accessData)) {
            $this->data = array_merge($this->data, $accessData);
        }
    }

	public function setLayout(string $layout): void
	{
		$this->layout = $layout;
	}
	
    // Для вывода вида
	public function render(string $page = 'index', ?array $data = null): void
	{
		if ($page) {
			$this->page = $page;
		}
		
        //Если есть пользовательские данные добавляем их тож в наш Массив для страницы
		if (is_array($data)) {
			$this->data = array_merge($this->data, $data);
		}

		extract($this->data);

        // Подключаем определенный шаблон вида
		$layout = __DIR__ . '/views/layouts/' . $this->layout . '.php';
		
		if (file_exists($layout)) {
			include_once $layout;
		}
	}

    public function route(string $route): string
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/' . $route;
    }

	public function page(bool|string $partial = false , bool|string $widget = false): void
	{	
		$dir = 'templates/' . $this->folder . '/' . $this->page;

		if ($partial) {	
			$dir = $this->folder . '/' . 'partials/' . $partial;
			
			if ($widget) {
				$dir = 'widgets/' . $partial;
			}
		}

		$page = __DIR__ . '/views/' . $dir . '.php';

		extract($this->data);
		
		if (file_exists($page)) {
			include_once $page;
		}
	}
	
    public function csrf(): string
    {
        return '<input type="hidden" name="csrf" value="' . $_SESSION['csrf'] . '"/>';
    }

    public function __call(string $part, array $args): void
    {
    	$this->page($part, true);
    }
}