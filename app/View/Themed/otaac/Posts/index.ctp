<?php $this->set('title_for_layout', 'Home'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<?php foreach ($posts as $post) { ?>
	<fieldset>
		<legend><?php echo $post['Post']['title']; ?></legend>
		<div class="text-justify"><?php echo $post['Post']['body']; ?></div>
		<div class="text-right text-muted">Posted in <?php echo date('d/m/Y H:m', strtotime($post['Post']['created'])); ?> by <?php echo $post['Account']['name']; ?></div>
	</fieldset>
	<?php } ?>
	<div class="text-center">
		<ul class="pagination">
			<?php echo $this->Paginator->numbers(); ?>
		</ul>
	</div>
</div>