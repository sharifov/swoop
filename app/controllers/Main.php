<?php
class Main extends Controller {

	public array $before = ['csrf'];

	public function index(): void
	{
		$this->model('employer');

        if ($this->isPost() && isset($_POST['auth'])) {

            $_POST['login'] = $this->clear($_POST['login']);
            $_POST['password'] = $this->clear($_POST['password']);

            Auth::login($_POST['login'], $_POST['password']);
            
            $this->redirect('', 'Вы успешно авторизовались!');
        }

        //$count = count($this->model->findAll());

        // Исполнение Вида - Главной странице
        $this->view->render(Auth::has() ? 'index' : 'auth');
	}

	public function departments(): void
	{
		$this->model('department');
		
		$departments = $this->model->findAll();

		$this->view->render('departments', compact('departments'));
	}
}