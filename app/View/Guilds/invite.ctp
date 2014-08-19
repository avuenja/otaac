<?php $this->set('title_for_layout', 'Invite a guild'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<?php echo $this->Form->create('Guild', array('class' => 'form-horizontal')); ?>
	<div class="form-group">
		<label class="col-sm-3 control-label">Player invite:</label>
		<div class="col-sm-9">
			<?php echo $this->Form->input('player_id', array('label' => false, 'options' => $characters, 'empty' => '--choose your character--', 'class' => 'form-control')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<button type="submit" class="btn btn-success">Create</button>
			<button type="reset" class="btn btn-default">Cancel</button>
		</div>
	</div>
	<?php echo $this->Form->end();?>
</div>