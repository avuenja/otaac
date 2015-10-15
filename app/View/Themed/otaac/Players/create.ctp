<?php $this->set('title_for_layout', 'Create new character'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<?php echo $this->Form->create('Player', array('class' => 'form-horizontal')); ?>
	<div class="form-group">
		<label class="col-sm-3 control-label">Character name:</label>
		<div class="col-sm-9">
			<?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control', 'placeholder' => '3 to 20 characters')); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Sex:</label>
		<div class="col-sm-9">
			<?php
			echo $this->Form->input('sex', array('label' => false, 'options' => array(1 => 'Male', 0 => 'Female'), 'empty' => '--choose your sex--', 'class' => 'form-control'));
			?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Vocation:</label>
		<div class="col-sm-9">
			<?php echo $this->Form->input('vocation', array('label' => false, 'options' => Configure::read('Vocations'), 'empty' => '--choose your vocation--', 'class' => 'form-control')); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">City:</label>
		<div class="col-sm-9">
			<?php echo $this->Form->input('town_id', array('label' => false, 'options' => $towns, 'empty' => '--choose your town--', 'class' => 'form-control')); ?>
		</div>
	</div>
	<?php if(tfs === '0.3.6') { ?>
	<div class="form-group">
		<label class="col-sm-3 control-label">World:</label>
		<div class="col-sm-9">
			<?php echo $this->Form->input('world_id', array('label' => false, 'options' => Configure::read('Worlds'), 'empty' => '--choose your world--', 'class' => 'form-control')); ?>
		</div>
	</div>
	<?php } ?>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<button type="submit" class="btn btn-success">Create</button>
			<button type="reset" class="btn btn-default">Cancel</button>
		</div>
	</div>
	<?php echo $this->Form->end();?>
</div>