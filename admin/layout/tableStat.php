<table border="1" width="25%" cellpadding="5">
	<tr>
		<th>Суперспособность</th>
		<th>Количество</th>
	</tr>
	<?php
	foreach ($dbRequester->getNamesSupPower() as $key => $value) {
		echo
		"<tr>
			<td>" . htmlspecialchars($value['power']) . "</td>
			<td>" . intval($dbRequester->getCountUsersSupPower($value['id'])) . "</td>
		</tr>";
	}
	?>
</table>