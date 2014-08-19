<?php $this->set('title_for_layout', 'List of guilds'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th colspan="3">Guilds list</th>
					<?php if($this->Session->check('Account')) { ?>
						<th class="text-right">
							<a href="<?php echo url; ?>guilds/create" type="button" class="btn btn-success btn-xs">Create your Guild</a>
						</th>
					<?php } ?>
				</tr>
				<tr>
					<th>Guild</th>
					<th>Motd</th>
					<th>Owner</th>
					<?php if($this->Session->check('Account')) { ?>
						<th class="text-right">Action</th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($guilds as $guild) { ?>
					<tr>
						<td><?php echo $guild['Guild']['name']; ?></td>
						<td><?php echo $guild['Guild']['motd']; ?></td>
						<td><?php echo $guild['Player']['name']; ?></td>
						<?php if($this->Session->check('Account')) { ?>
							<td class="text-right">
								<?php if($this->Session->read('Account.name') == $guild['Player']['name']){ // Se quem estiver logado for o dono da guilda ?>
									<a href="" type="button" class="btn btn-default btn-xs" title="Gerenciar"><span class="glyphicon glyphicon-wrench"></span></a>
								<?php } if($this->Session->read('Account.name') != $guild['Player']['name']) { // Se quem estiver logado não for o dono da guilda ?>
									<a href="<?php echo url; ?>guilds/invite/<?php echo $guild['Guild']['id']; ?>" type="button" class="btn btn-default btn-xs" title="Invite"><span class="glyphicon glyphicon-share-alt"></span></a>
								<?php } ?>
							</td>
						<?php } ?>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>