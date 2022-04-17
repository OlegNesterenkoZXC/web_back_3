<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<title>BackEnd3</title>
</head>

<body style="font-size: 20px;">
	<form action="form.php" method="post">
		<p>
			<label>Имя<br><br>
				<input placeholder="Имя" type="text" name="name">
			</label>
		<p>
			<label>E-mail<br><br>
				<input placeholder="E-mail" type="text" name="email">
			</label>
		</p>
		<p>
			<label>Год рождения<br><br>
				<select name="year">
					<option value="">Select...</option>
					<?php
					for ($i = 2008; $i >= 1900; --$i) {
						echo "<option value='$i'>$i</option>";
					}
					?>
				</select>
			</label>
		</p>
		<p>Пол<br><br>
			<label>
				<input type="radio" name="gender" value="1">Мужской
			</label>
			<label>
				<input type="radio" name="gender" value="2">Женский
			</label>
		</p>
		<p>Количество конечностей<br><br>
			<label>
				<input type="radio" name="numlimbs" value="1">1
			</label>
			<label>
				<input type="radio" name="numlimbs" value="2">2
			</label>
			<label>
				<input type="radio" name="numlimbs" value="3">3
			</label>
			<label>
				<input type="radio" name="numlimbs" value="4">4
			</label>
		</p>
		<p>
			<label>Сверхспособности<br><br>
				<select multiple name="super-powers[]">
					<option value="1">Бессмертие</option>
					<option value="2">Прохождение сквозь стены</option>
					<option value="3">Левитация</option>
				</select>
			</label>
		</p>
		<div>
			<p>
				<label>Биография<br><br>
					<textarea placeholder="Расскажите о себе" name="biography"></textarea>
				</label>
			</p>
		</div>
		<p>
			<label>
				<input type="checkbox" name="agree" required>Даю согласие на обработку данных
			</label>
		</p>
		<p>
			<input type="submit" value="Отправить">
		</p>
	</form>
</body>

</html>