<?php $this->set('title_for_layout', 'Manager your account'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Vocation</th>
					<th>Level</th>
					<th>Last login</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(empty($characters)) { // Se array vazio:
					echo '<tr><td colspan="5"><p class="text-muted">Ainda não criou seu jogador? '.$this->Html->link('Clique aqui', '/players/create').'</a> e crie agora!</p></td></tr>';
				} else { // Se não:
					foreach ($characters as $character) {
						echo '<tr>';
						echo '<td><a href="'.url.'character/'.$character['Player']['name'].'">'.$character['Player']['name'].'</a></td>';
						echo '<td>'.$vocation[$character['Player']['vocation']].'</td>';
						echo '<td>'.$character['Player']['level'].'</td>';
						echo '<td>'.((!$character['Player']['lastlogin']) ? 'Nunca logou' : $character['Player']['lastlogin']).'</td>';
						echo '<td class="text-center"><a href="'.url.'players/delete/'.$character['Player']['id'].'" type="button" class="btn btn-default btn-xs" title="Excluir"><span class="glyphicon glyphicon-trash"></span></a></td>';
						echo '</tr>';
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>