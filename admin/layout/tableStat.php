<table border="1" width="25%" cellpadding="5">
	<tr>
		<th>Суперспособность</th>
		<th>Количество</th>
	</tr>
	<?php
	foreach ($dbRequester->getNamesSupPower() as $key => $value) {
		echo
		"<tr>
			<td>" . $value['power'] . "</td>
			<td>" . $dbRequester->getCountUsersSupPower($value['id']) . "</td>
		</tr>";
	}
	?>
</table>