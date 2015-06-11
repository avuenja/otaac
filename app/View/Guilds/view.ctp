<?php $this->set('title_for_layout', 'Manage guild ['.$guild['Guild']['name'].']'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="col-md-12">
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
                        <td><?php echo $guildMember['Player']['name']; ?></td>
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