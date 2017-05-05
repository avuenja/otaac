<?php $this->set('title_for_layout', 'Pages'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Pages</th>
					<th class="text-right">
						<a href="<?php echo url; ?>content/create_page" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span> New Page</a>
					</th>
				</tr>
				<tr>
					<th>Title</th>
					<th class="text-right">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pages as $page) { ?>
					<tr>
						<td><?php echo $page; ?></td>
						<td class="text-right">
							<a href="<?php echo url.'content/edit_page/'.$page; ?>" type="button" class="btn btn-default btn-xs" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="<?php echo url.'content/delete_page/'.$page; ?>" type="button" class="btn btn-default btn-xs" title="Excluir"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>