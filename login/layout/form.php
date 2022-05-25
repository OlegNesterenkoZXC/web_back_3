<form class="form__body" action="" method="post">
	<div class="form__item">
		<label class="form__label">
			<input class="form__input form__input_text" placeholder="Логин" type="text" name="login">
		</label>
		<?php echo $message['login-error']; ?>
	</div>
	<div class="form__item">
		<label class="form__label">
			<input class="form__input form__input_text" placeholder="Пароль" type="password" name="password">
		</label>
		<?php echo $message['password-error']; ?>
	</div>
	<div class="form__item form__item_submit">
		<label class="form__label">
			<input class="form__submit" type="submit" value="Войти">
		</label>
	</div>
	<div class='form__footer'>
		<p class='form__p'>
			Перейти на <a href='index.php' class='form__a'>главную</a> страницу!
		</p>
	</div>
</form>