<?php $this->set('title_for_layout', 'Highscores'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<?php echo $this->Form->create('highscores',array('class' => 'form-inline')); ?>
		<div class="form-group">
			<?php 
			$options = array('Experience', 'Magic Level', 'Fist', 'Club', 'Sword', 'Axe', 'Distance', 'Shield', 'Fishing');
			echo $this->Form->input('sort', array('label' => false, 'class' => 'form-control', 'options' => $options,'empty' => '--Sort by--'));
			?>
		</div>
		<button type="submit" class="btn btn-default">Order</button>
	<?php echo $this->Form->end();?>
</div>
<?php if(isset($characters) && !empty($characters)) { ?>
<div class="panel panel-default panel-body">
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th colspan="13">Highscore by <?php echo $sortName; ?></th>
				</tr>
				<tr>
					<th>Name</th>
					<th>Vocation</th>
					<th>Level</th>
					<th>Experience</th>
					<th>Magic level</th>
					<th>Fist</th>
					<th>Club</th>
					<th>Sword</th>
					<th>Axe</th>
					<th>Distance</th>
					<th>Shield</th>
					<th>Fishing</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($characters as $character) { ?>
				<tr class="<?php echo (($character['Account']['premdays'] > 0) ? 'success' : ''); ?>">
					<td><?php echo $character['Player']['name']; ?></td>
					<td><?php echo $vocation[$character['Player']['vocation']]; ?></td>
					<td><?php echo $character['Player']['level']; ?></td>
					<td><?php echo $character['Player']['experience']; ?></td>
					<td><?php echo $character['Player']['maglevel']; ?></td>
					<td><?php echo $character['Player']['skill_fist']; ?></td>
					<td><?php echo $character['Player']['skill_club']; ?></td>
					<td><?php echo $character['Player']['skill_sword']; ?></td>
					<td><?php echo $character['Player']['skill_axe']; ?></td>
					<td><?php echo $character['Player']['skill_dist']; ?></td>
					<td><?php echo $character['Player']['skill_shielding']; ?></td>
					<td><?php echo $character['Player']['skill_fishing']; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table
	</div>
</div>
<?php } ?>