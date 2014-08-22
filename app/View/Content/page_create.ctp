<?php 
$this->set('title_for_layout', 'New post'); // Titulo da pagina 
?>
<div class="panel panel-default panel-body">
	<?php echo $this->Form->create(''); ?>
	<div class="form-group">
		<label>Title:</label>
		<?php echo $this->Form->input('title', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Maximum 20 characters')); ?>
	</div>
	<div class="form-group">
		<label>Content page:</label>
		<?php echo $this->Form->textarea('body', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Write your html page here', 'rows' => 15)); ?>
	</div>
	<div class="form-group text-right">
		<button type="submit" class="btn btn-success">Create</button>
		<a href="<?php echo url; ?>content/pages" type="button" class="btn btn-default">Back</a>
	</div>
	<?php echo $this->Form->end();?>
</div>