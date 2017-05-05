<?php
$this->set('title_for_layout', 'Admin Panel ['.$this->Session->read('Account.name').']');
?>
<div class="panel panel-default panel-body">
	<?php echo $this->Form->create('Page'); ?>
	<div class="form-group">
		<label>Title:</label>
		<?php echo $this->Form->input('title', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Maximum 80 characters')); ?>
	</div>
	<div class="form-group">
		<label>Body:</label>
		<?php echo $this->Form->textarea('body', array('label' => false, 'class' => 'form-control', 'rows' => '12')); ?>
	</div>
	<div class="form-group text-right">
		<button type="submit" class="btn btn-success">Save</button>
		<a href="<?php echo url; ?>/content/pages" type="button" class="btn btn-default">Back</a>
	</div>
	<?php echo $this->Form->end();?>
</div>