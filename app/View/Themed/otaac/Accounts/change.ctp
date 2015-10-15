<?php $this->set('title_for_layout', 'Change your account'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<?php 
	echo $this->Form->create('Account', array('class' => 'form-horizontal'));
	echo $this->Form->input('id', array('type' => 'hidden'));  
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label">Email:</label>
		<div class="col-sm-9">
			<?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Enter your email address')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<button type="submit" class="btn btn-success">Save</button>
		</div>
	</div>
	<?php echo $this->Form->end();?>
</div>