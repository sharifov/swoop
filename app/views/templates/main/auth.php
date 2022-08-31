<main role="main">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<form method="post">
					<?=$this->csrf()?>
					<div class="form-group">
						<label for="login">Логин</label>
						<input type="text" class="form-control" id="login" placeholder="Login">
					</div>
					<div class="form-group">
						<label for="pass">Пароль</label>
						<input type="password" class="form-control" id="pass" placeholder="Password">
					</div>
					<button name="auth" class="btn btn-primary">Войти</button>
				</form>
			</div>
		</div>
	</div>
</main>