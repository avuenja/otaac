<?php $this->set('title_for_layout', 'Admin Panel ['.$this->Session->read('Account.name').']'); // Titulo da pagina ?>
<div class="panel panel-default panel-body">
	<div class="col-md-4">
		<div class="panel panel-default panel-body">
			<fieldset>
				<legend>Information players</legend>
				<p>Players recorded : <?php echo $recorded; ?></p>
				<p>Players deleted : <?php echo $deleted; ?></p>
			</fieldset>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="panel panel-default panel-body">
			<fieldset>
				<legend>Information accounts</legend>
				<p>Accounts recorded : <?php echo $recordedAccounts; ?></p>
				<p>Premium accounts : <?php echo $premium; ?></p>
				<p>Free accounts : <?php echo $free; ?></p>
			</fieldset>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="panel panel-default panel-body">
			<fieldset>
				<legend>Information posts</legend>
				<p>Posts created: <?php echo $posts; ?></p>
			</fieldset>
		</div>
	</div>
</div>