<?php
class Abort extends Controller {
	
	public function index(): void
	{
        // Исполнение Вида - Ошибок
		$this->view->render('index', ['title' => 'My Site'] );
	}
}