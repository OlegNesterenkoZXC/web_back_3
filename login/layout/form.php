<form class="form__body" action="" method="post">
	<div class="form__item">
		<label class="form__label">
			<input class="form__input form__input_text" placeholder="Логин" type="text" name="login">
		</label>
		<?php
		if (!empty($message['login-error'])) {
			$temp = htmlspecialchars($message['login-error']);
			echo "<div class='form__container form__container_err'><span class='form__span'>$temp</span></div>";
		}
		?>
	</div>
	<div class="form__item">
		<label class="form__label">
			<input class="form__input form__input_text" placeholder="Пароль" type="password" name="password">
		</label>
		<?php
		if (!empty($message['password-error'])) {
			$temp = htmlspecialchars($message['password-error']);
			echo "<div class='form__container form__container_err'><span class='form__span'>$temp</span></div>";
		}
		?>
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