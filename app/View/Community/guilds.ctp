<?php $this->set('title_for_layout', 'List of guilds'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th colspan="3">Guilds list</th>
				</tr>
				<tr>
					<th>Guild</th>
					<th>Motd</th>
					<th>Owner</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($guilds as $guild) { ?>
					<tr>
						<td><?php echo $guild['Guild']['name']; ?></td>
						<td><?php echo $guild['Guild']['motd']; ?></td>
						<td><?php echo $guild['Player']['name']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>