<?php $this->set('title_for_layout', 'Admin Panel'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="col-md-3">
		<div class="panel panel-default panel-body">
			<table class="table">
				<thead>
					<th>Page list</th>
					<th class="text-right">
						<a href="<?php echo url; ?>admin/page_create" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span> New page</a>
					</th>
				</thead>
				<tbody>
					<?php foreach ($pages['pages'] as $key => $page) { ?>
					<tr>
						<td><?php echo ucfirst($page); ?></td>
						<td class="text-right">
							<a href="<?php echo url; ?>admin/page_edit/<?php echo $page; ?>" type="button" class="btn btn-default btn-xs" title="Editar">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>
							<a href="<?php echo url; ?>admin/page_delete/<?php echo $page; ?>" type="button" class="btn btn-default btn-xs" title="Excluir">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
					</tr>	
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-9">
		<div class="well">
		</div>
	</div>
</div>