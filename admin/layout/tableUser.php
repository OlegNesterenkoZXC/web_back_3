<table border="1" width="100%" cellpadding="5">
	<tr>
		<th>ID</th>
		<th>Имя</th>
		<th>e-mail</th>
		<th>Год</th>
		<th>Пол</th>
		<th>Конечности</th>
		<th>Биография</th>
		<th>Действие</th>
	</tr>
	<?php
	foreach ($dbRequester->getUsersData() as $key => $value) {
		echo "
			<tr>
				<td>" . htmlspecialchars($value['id']) . "</td>
				<td>" . htmlspecialchars($value['name']) . "</td>
				<td>" . htmlspecialchars($value['email']) . "</td>
				<td>" . htmlspecialchars($value['date']) . "</td>
				<td>" . htmlspecialchars($value['gender']) . "</td>
				<td>" . htmlspecialchars($value['limbs']) . "</td>
				<td>" . htmlspecialchars($value['biography']) . "</td>
			</tr>";
	}
	?>

</table>