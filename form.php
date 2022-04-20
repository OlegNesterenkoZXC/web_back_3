<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<title>BackEnd4</title>
</head>

<body>
	<?php
	if (!empty($_COOKIE['save'])) {
		setcookie("save", '', time() - 60 * 60 * 24 * 30);
		echo "Данные отправленны!";
	}
	if (!empty($_COOKIE['request-error'])) {
		setcookie("request-error", '', time() - 60 * 60 * 24 * 30);
		echo "{$_COOKIE['request-error']}";
	}
	?>
	<div class="form">
		<div class="form__header">
			<div class="form__contaner">
				<span class="form__span form__span_header">ЗАПОЛНИТЕ</span>
			</div>
			<div class="form__container form__container_good">
				<span class="form__span">Ваши данные отправленны!</span>
			</div>
			<div class="form__container form__container_err">
				<span class="form__span">Что-то пошло не так! =(</span>
			</div>
		</div>
		<form class="form__body" action="" method="post">
			<div class="form__item">
				<label class="form__label">
					<input class="form__input form__input_text" placeholder="Имя" type="text" name="name">
				</label>
				<div class="form__container form__container_err">
					<span class="form__span">Hello</span>
					<span class="form__span">bad</span>
					<span class="form__span">game</span>
				</div>
			</div>
			<div class="form__item">
				<label class="form__label">
					<input class="form__input form__input_text" placeholder="E-mail" type="text" name="email">
				</label>
				<div class="form__container form__container_err">
					<span class="form__span">Hello</span>
					<span class="form__span">bad</span>
					<span class="form__span">game</span>
				</div>
			</div>
			<div class="form__item">
				<label class="form__label">
					<select name="year" class="form__select">
						<option value="" class="form__option">Год</option>
						<?php
						for ($i = 2008; $i >= 1900; --$i) {
							echo "<option class='form__option' value='$i'>$i</option>";
						}
						?>
					</select>
				</label>
				<div class="form__container form__container_err">
					<span class="form__span">Hello</span>
					<span class="form__span">bad</span>
					<span class="form__span">game</span>
				</div>
			</div>
			<div class="form__item form__item_radio">
				<div class="form__container">
					<label class="form__label">
						<input class="form__radio" type="radio" name="gender" value="1">М
					</label>
					<label class="form__label">
						<input class="form__radio" type="radio" name="gender" value="2">Ж
					</label>
				</div>
				<div class="form__container form__container_err">
					<span class="form__span">Hello</span>
					<span class="form__span">bad</span>
					<span class="form__span">game</span>
				</div>
			</div>
			<div class="form__item form__item_numlimbs">
				<span class="form__span">Количество конечностей</span>
				<div class="form__container">
					<label class="form__label">
						<input class="form__radio" type="radio" name="numlimbs" value="1">1
					</label>
					<label class="form__label">
						<input class="form__radio" type="radio" name="numlimbs" value="2">2
					</label>
					<label class="form__label">
						<input class="form__radio" type="radio" name="numlimbs" value="3">3
					</label>
					<label class="form__label">
						<input class="form__radio" type="radio" name="numlimbs" value="4">4
					</label>
				</div>
				<div class="form__container form__container_err">
					<span class="form__span">Hello</span>
					<span class="form__span">bad</span>
					<span class="form__span">game</span>
				</div>
			</div>
			<div class="form__item form__item_sp">
				<label class="form__label">
					<span class="form__span">Сверхспособности</span>
					<select multiple name="super-powers[]" class="form__select">
						<option class="form__oprion" value="1">Бессмертие</option>
						<option class="form__oprion" value="2">Прохождение сквозь стены</option>
						<option class="form__oprion" value="3">Левитация</option>
					</select>
				</label>
				<div class="form__container form__container_err">
					<span class="form__span">Hello</span>
					<span class="form__span">bad</span>
					<span class="form__span">game</span>
				</div>
			</div>
			<div class="form__item">
				<label class="form__label">
					<textarea class="form__textarea" placeholder="Расскажите о себе" name="biography"></textarea>
				</label>
				<div class="form__container form__container_err">
					<span class="form__span">Hello</span>
					<span class="form__span">bad</span>
					<span class="form__span">game</span>
				</div>
			</div>
			<div class="form__item form__item_agreement">
				<label class="form__label">
					<input class="form__input" type="checkbox" name="agree" required>Согласие на обработку данных
				</label>
			</div>
			<div class="form__item form__item_submit">
				<label class="form__label">
					<input class="form__submit" type="submit" value="Отправить">
				</label>
			</div>
		</form>
	</div>
</body>

</html>