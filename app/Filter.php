<?php

trait Filter {

	public function checkAJAX(): void
	{
		if ( 
			!(
		    	isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
				strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
		    )
		) {
			Start::error();
		}
	}

	public function isPost(): bool
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	public function filterCsrf(): bool
	{
		return !($this->isPost() && $_POST['csrf'] !== $_SESSION['csrf']);
	}
}