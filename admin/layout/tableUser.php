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
				<td>" . intval($value['id']) . "</td>
				<td>" . htmlspecialchars($value['name']) . "</td>
				<td>" . htmlspecialchars($value['email']) . "</td>
				<td>" . intval($value['date']) . "</td>
				<td>" . (intval($value['gender']) == 1 ? 'M' : 'W') . "</td>
				<td>" . intval($value['limbs']) . "</td>
				<td>" . htmlspecialchars($value['biography']) . "</td>
				<td><a href='?action=delete&id=" . intval($value['id']) . "'>delete user</a></td>
			</tr>";
	}
	?>

</table>