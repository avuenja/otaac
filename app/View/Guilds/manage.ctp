<?php $this->set('title_for_layout', 'Manage guild ['.$guild['Guild']['name'].']'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="col-md-4">
		<div class="panel panel-default panel-body">
			<fieldset>
				<legend>Invitations players</legend>
				<?php foreach($guildInvites as $invites) { ?>
					<p>
						<a href="<?php echo url; ?>character/<?php echo $invites['Player']['name']; ?>"><?php echo $invites['Player']['name']; ?></a>
						<a href="<?php echo url; ?>guilds/accept_invite/<?php echo $invites['Player']['id']; ?>" type="button" class="btn btn-default btn-xs" title="Aceitar">
							<span class="glyphicon glyphicon-ok"></span>
						</a>
						<a href="<?php echo url; ?>guilds/delete_invite/<?php echo $invites['Player']['id']; ?>" type="button" class="btn btn-default btn-xs" title="Excluir">
							<span class="glyphicon glyphicon-remove"></span>
						</a>
					</p>
				<?php } ?>
			</fieldset>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-default panel-body">
			<fieldset>
				<table class="table">
					<thead>
						<tr><th colspan="4">Guild informations</th></tr>
					</thead>
					<tbody>
						<tr>
							<td><strong>Name guild:</strong></td>
							<td><?php echo $guildInfo['Guild']['name']; ?></td>
							<td><strong>Motd guild:</strong></td>
							<td><?php echo $guildInfo['Guild']['motd']; ?></td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</div>
	</div>
</div>