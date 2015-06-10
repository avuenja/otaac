<?php
$guilds = $this->requestAction('/guilds/top5');
$position = 1;
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseGuilda" class="collapsed">
				Top 5 guildas
			</a>
		</h4>
	</div>
	<div id="collapseGuilda" class="panel-collapse collapse in" style="height: auto;">
		<table class="table table-condensed table-content table-striped">
			<tbody>
				<?php foreach($guilds as $key => $name) { ?>
					<tr>
						<td style="width: 80%"><strong><?php echo $position; ?>.</strong> <a href="<?php echo url; ?>guild/<?php echo $name; ?>"><?php echo $name; ?></a></td>
						<td><span class="label label-info">Kill. 109</span></td>
					</tr>
				<?php 
					$position++;
				} ?>
			</tbody>
		</table>
	</div>
</div>
