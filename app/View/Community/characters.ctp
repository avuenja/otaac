<?php $this->set('title_for_layout', 'Characters search'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<?php echo $this->Form->create('',array('class' => 'form-inline')); ?>
		<div class="form-group">
			<?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Enter name player')); ?>
		</div>
		<button type="submit" class="btn btn-default">Search</button>
	<?php echo $this->Form->end();?>
</div>