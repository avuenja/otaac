<?php $this->set('title_for_layout', 'Highscores'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<?php echo $this->Form->create('highscores',array('class' => 'form-inline')); ?>
		<div class="form-group">
			<?php 
			$options = array('Level', 'Magic Level', 'Fist', 'Club', 'Sword', 'Axe', 'Distance', 'Shield', 'Fishing');
			echo $this->Form->input('sort', array('label' => false, 'class' => 'form-control', 'options' => $options,'empty' => '--Sort by--'));
			?>
		</div>
		<button type="submit" class="btn btn-default">Order</button>
	<?php echo $this->Form->end();?>
</div>