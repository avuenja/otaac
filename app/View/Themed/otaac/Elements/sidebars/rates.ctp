<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseRates" class="collapsed">
				Rates
			</a>
		</h4>
	</div>
	<div id="collapseRates" class="panel-collapse collapse in" style="height: auto;">
		<table class="table table-condensed table-content table-striped">
			<tbody>
				<tr>
					<td><strong>Experience:</strong></td>
					<td><a href="<?php echo url; ?>library/stages"><?php echo rateExp ?>x</a></td>
				</tr>
				<tr>
					<td><strong>Magic:</strong></td>
					<td><?php echo rateMagic ?>x</td>
				</tr>
				<tr>
					<td><strong>Skill:</strong></td>
					<td><?php echo rateSkill ?>x</td>
				</tr>
				<tr>
					<td><strong>Loot:</strong></td>
					<td><?php echo rateLoot ?>x</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>