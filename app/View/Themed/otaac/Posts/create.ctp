<?php 
$this->set('title_for_layout', 'New post'); // Titulo da pagina 
echo $this->Html->script('ckeditor/ckeditor');
?>
<div class="panel panel-default panel-body">
	<?php echo $this->Form->create('Post'); ?>
	<div class="form-group">
		<label>Title:</label>
		<?php echo $this->Form->input('title', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Maximum 80 characters')); ?>
	</div>
	<div class="form-group">
		<label>Body:</label>
		<?php echo $this->Form->input('body', array('label' => false, 'class' => 'form-control ckeditor', 'placeholder' => '')); ?>
	</div>
	<div class="form-group text-right">
		<button type="submit" class="btn btn-success">Create</button>
		<a href="<?php echo url; ?>posts/consult" type="button" class="btn btn-default">Back</a>
	</div>
	<?php echo $this->Form->end();?>
</div>