<?php $this->set('title_for_layout', 'Admin Panel'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="col-md-3">
		<div class="panel panel-default panel-body">
			<table class="table">
				<thead>
					<th colspan="2">Page list</th>
				</thead>
				<tbody>
					<?php foreach ($pages['pages'] as $key => $page) { ?>
					<tr>
						<td><?php echo ucfirst($page); ?></td>
						<td></td>
					</tr>	
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>