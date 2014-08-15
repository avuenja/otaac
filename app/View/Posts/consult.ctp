<?php $this->set('title_for_layout', 'Consult posts'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th colspan="4">Consult Posts</th>
					<th class="text-right">
						<a href="<?php echo url; ?>posts/create" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span> New Post</a>
					</th>
				</tr>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Posted in</th>
					<th>Author</th>
					<th class="text-right">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($posts as $post) { ?>
					<tr>
						<td><?php echo $post['Post']['id']; ?></td>
						<td><?php echo $post['Post']['title']; ?></td>
						<td><?php echo date('d/m/Y H:m', strtotime($post['Post']['created'])); ?></td>
						<td><?php echo $post['Account']['name']; ?></td>
						<td class="text-right">
							<a href="<?php echo url.'posts/edit/'.$post['Post']['id']; ?>" type="button" class="btn btn-default btn-xs" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="<?php echo url.'posts/delete/'.$post['Post']['id']; ?>" type="button" class="btn btn-default btn-xs" title="Excluir"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>