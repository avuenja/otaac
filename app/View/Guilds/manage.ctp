<?php $this->set('title_for_layout', 'Manage guild ['.$guild['Guild']['name'].']'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="col-md-6">
		<div class="panel panel-default panel-body">
			<table class="table">
				<thead>
					<tr><th colspan="3">Invitations players</th></tr>
				</thead>
				<tbody>
					<?php foreach($guildInvites as $invites) { ?>
					<tr>
						<td><strong><a href="<?php echo url; ?>character/<?php echo $invites['Player']['name']; ?>"><?php echo $invites['Player']['name']; ?></a></strong></td>
						<td>
						    <?php echo $this->Form->input('rank_id', array('label' => false, 'options' => $guildRanks, 'empty' => 'choose a rank', 'class' => 'form-control')); ?>
						</td>
						<td>
							<button class="btn btn-default btn-xs" title="Aceitar" onclick="Accept(<?php echo $invites['Player']['id'] . ", " . $invites['Guild']['id']; ?>)">
								<span class="glyphicon glyphicon-ok"></span>
							</button>
							<a href="<?php echo url; ?>guilds/delete_invite/<?php echo $invites['Player']['id']; ?>/<?php echo $invites['Guild']['id']; ?>" type="button" class="btn btn-default btn-xs" title="Excluir">
								<span class="glyphicon glyphicon-remove"></span>
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default panel-body">
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
		</div>
	</div>
</div>

<script>
	var rank = 0;

	function Accept(pid, gid) {
		window.location.href = "<?php echo url; ?>guilds/accept_invite/" + pid + "/" + gid + "/" + rank;
	}

	$("#rank_id").change(function() {
		rank = $(this).val();
	});
</script>