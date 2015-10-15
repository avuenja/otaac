<?php $this->set('title_for_layout', 'Enter your account'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<?php echo $this->Form->create('Account', array('class' => 'form-horizontal')); ?>
	<div class="form-group">
		<label class="col-sm-3 control-label">Account name:</label>
		<div class="col-sm-9">
			<?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Account name')); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Password:</label>
		<div class="col-sm-9">
			<?php echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Password')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<button type="submit" class="btn btn-success">Log in</button>
			<a href="recover" class="btn btn-default">Forgot your password?</a>
		</div>
	</div>
	<?php echo $this->Form->end();?>
</div>