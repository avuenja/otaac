<?php $this->set('title_for_layout', 'Character ['.$character['Player']['name'].']'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th colspan="2">Information player</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Name:</td>
					<td><?php echo $character['Player']['name']; ?></td>
				</tr>
				<tr>
					<td>Level:</td>
					<td><?php echo $character['Player']['level']; ?></td>
				</tr>
				<tr>
					<td>Vocation:</td>
					<td><?php echo $vocation[$character['Player']['vocation']]; ?></td>
				</tr>
				<tr>
					<td>Sex:</td>
					<td><?php echo (($character['Player']['sex'] == 1) ? 'Male' : 'Female'); ?></td>
				</tr>
				<!-- <tr>
					<td>World:</td>
					<td><?php //echo ; ?></td>
				</tr> -->
				<tr>
					<td>Last login:</td>
					<td><?php echo ((!$character['Player']['lastlogin']) ? 'Nunca logou' : $character['Player']['lastlogin']); ?></td>
				</tr>
				<tr>
					<td>Account status:</td>
					<td><?php echo (($character['Account']['premdays'] > 0) ? 'Premium account' : 'Free account'); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>