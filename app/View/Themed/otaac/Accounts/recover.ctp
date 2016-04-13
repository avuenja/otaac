<?php $this->set('title_for_layout', 'Recovery account'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<?php echo $this->Form->create('Account', array('class' => 'form-horizontal')); ?>
	<div class="form-group">
		<label class="col-sm-3 control-label">Recovery key:</label>
		<div class="col-sm-9">
			<?php echo $this->Form->input('recovery_key', array('label' => false, 'class' => 'form-control', 'placeholder' => '20 characters', 'autocomplete' => 'off')); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Password:</label>
		<div class="col-sm-9">
			<?php echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'placeholder' => '6 to 25 characters')); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Password repeat:</label>
		<div class="col-sm-9">
			<?php echo $this->Form->input('password_repeat', array('label' => false, 'class' => 'form-control', 'placeholder' => '6 to 25 characters', 'type' => 'password')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<button type="submit" class="btn btn-success">Recover</button>
		</div>
	</div>
	<?php echo $this->Form->end();?>
</div>