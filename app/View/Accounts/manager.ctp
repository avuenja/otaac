<?php $this->set('title_for_layout', 'Manager your account'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Vocation</th>
				<th>Level</th>
				<th>Last login</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(empty($characters)) { // Se array vazio:
				echo '<tr><td colspan="5"><p class="text-muted">Ainda não criou seu jogador? '.$this->Html->link('Clique aqui', '/players/create').'</a> e crie agora!</p></td></tr>';
			} else { // Se não:
				foreach ($characters as $character) {
					echo '<tr>';
					echo '<td><a href="'.url.'players/'.$character['Player']['name'].'">'.$character['Player']['name'].'</a></td>';
					echo '<td>'.$vocation[$character['Player']['vocation']].'</td>';
					echo '<td>'.$character['Player']['level'].'</td>';
					echo '<td>'.((!$character['Player']['lastlogin']) ? 'Nunca logou' : $character['Player']['lastlogin']).'</td>';
					echo '<td><button type="button" class="btn btn-default btn-xs" title="Editar"><span class="glyphicon glyphicon-pencil"></span></button><button type="button" class="btn btn-default btn-xs" title="Excluir"><span class="glyphicon glyphicon-trash"></span></button></td>';
					echo '</tr>';
				}
			}
			?>
		</tbody>
	</table>
</div>