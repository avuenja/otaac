<?php
$players = $this->requestAction('/players/top5');
$position = 1;
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseTop" class="collapsed">
				Top 5 level
			</a>
		</h4>
	</div>
	<div id="collapseTop" class="panel-collapse collapse" style="height: 0px;">
		<table class="table table-condensed table-content table-striped">
			<tbody>
				<?php foreach ($players as $name => $level) { ?>
					<tr>
						<td style="width: 80%"><strong><?php echo $position; ?>.</strong> <a href="<?php echo url; ?>character/<?php echo $name; ?>"><?php echo $name; ?></a></td>
						<td><span class="label label-info">Lvl. <?php echo $level; ?></span></td>
					</tr>
				<?php 
					$position++;
				} ?>
			</tbody>
		</table>
	</div>
</div>