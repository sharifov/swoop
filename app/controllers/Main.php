<?php
class Main extends Controller {

	public array $before = ['csrf'];

	public function index(): void
	{
		$this->model('employer');

        if ($this->isPost() && isset($_POST['send'])) {

            $_POST['fio'] = $this->clear($_POST['fio']);
            $_POST['email'] = $this->clear($_POST['email']);

			$this->model->insert([
				'news_id' => $_POST['news_id'],
				'cat_id' => $_POST['cat_id']
			]);

            $this->redirect('', 'Новость успешно добавлен к рубрике!');
        }

        //$count = count($this->model->findAll());

        // Исполнение Вида - Главной странице
        $this->view->render('index', compact(''));
	}
}