<table border="1" width="25%" cellpadding="5">
	<tr>
		<th>ID</th>
		<th>Суперспособность</th>
	</tr>
	<tr>
		<?php
		foreach ($dbRequester->getSupPowUsersData() as $key => $value) {
			echo "
			<tr>
				<td>" . htmlspecialchars($value['id']) . "</td>
				<td>" . htmlspecialchars($value['power']) . "</td>
			</tr>";
		}
		?>
	</tr>
</table>