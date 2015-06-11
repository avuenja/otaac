<?php $this->set('title_for_layout', 'Guild ['.$guild['Guild']['name'].']'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="col-md-12">
		<div class="panel panel-default panel-body">
			<table class="table">
				<thead>
					<tr>
					    <th colspan="3">Guild informations</th>
					    <th class="text-right">
					    <?php if($this->Session->check('Account')) { ?>
					        <?php if($this->Session->read('Account.name') == $guildInfo['Player']['name']){ // Se quem estiver logado for o dono da guilda ?>
                                <a href="<?php echo url; ?>guilds/manage/<?php echo $guildInfo['Guild']['id']; ?>" type="button" class="btn btn-default btn-xs" title="Gerenciar"><span class="glyphicon glyphicon-wrench"></span></a>
                            <?php } if($this->Session->read('Account.name') != $guildInfo['Player']['name']) { // Se quem estiver logado não for o dono da guilda ?>
                                <a href="<?php echo url; ?>guilds/invite/<?php echo $guildInfo['Guild']['id']; ?>" type="button" class="btn btn-default btn-xs" title="Invite"><span class="glyphicon glyphicon-share-alt"></span></a>
                            <?php } ?>
                        <?php } ?>
                        </th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><strong>Name guild:</strong></td>
						<td><?php echo $guildInfo['Guild']['name']; ?></td>
						<td><strong>Owner guild:</strong></td>
						<td><a href="<?php echo url; ?>character/<?php echo $guildInfo['Player']['name']; ?>"><?php echo $guildInfo['Player']['name']; ?></a></td>
					</tr>
					<tr>
					    <td><strong>Motd guild:</strong></td>
                        <td colspan="3"><?php echo $guildInfo['Guild']['motd']; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-12">
        <div class="panel panel-default panel-body">
            <table class="table">
                <thead>
                    <tr><th colspan="4">Guild members</th></tr>
                    <tr>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Vocation</th>
                        <th>Rank</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($guildMembers as $guildMember) { ?>
                    <tr>
                        <td><a href="<?php echo url; ?>character/<?php echo $guildMember['Player']['name']; ?>"><?php echo $guildMember['Player']['name']; ?></a></td>
                        <td><?php echo $guildMember['Player']['level']; ?></td>
                        <td><?php echo $vocation[$guildMember['Player']['vocation']]; ?></td>
                        <td><?php echo $guildMember['GuildRank']['name']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>