
	<?php if (!$player) { ?>
<div class="container">
	<section id="typography">
	<br>
	<div class="well">
			<h3>Sorry, something went wrong.</h3>
			<h5>We're getting our data from Varvee.com, if you're seeing this message, that means Varvee's html structure has changed. Please Let us know immediately at support@highfiver.com</h5>
	</div>
</section>
</div>

	<?php } else { ?>
<div class="container">
	<section id="typography">
	<h6><a href="/vnn/">Top Five</a> >> <?php echo $player['name'];?></h6>
  <div class="page-header">
    <h1><?php echo $player['name'];?> <small><?php echo $player['city'];?> - <?php echo $player['club'];?></small></h1>
  </div>
	<?php $jsData = array( array ('x','Player Score','Team Score')); ?>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
				<th></th>
        <th>Opponent</th>
        <th>Player Score</th>
        <th>Team Score</th>
        <th>W/L</th>
      </tr>
    </thead>
    <tbody>
			<?php $rowCount = 1; foreach ($player['data'] as $row){ $jsData[] = array('Game '.$rowCount,$row['player_score'],$row['team_score']); ?>
      <tr>
				<td>
					Game <?php echo $rowCount;?>
				</td>
				<td>
					<?php echo $row['opponent'];?>
				</td>
				<td>
					<?php echo $row['player_score'];?>
				</td>
				<td>
					<?php echo $row['team_score'];?>
				</td>
				<td>
					<?php echo $row['status'];?>
				</td>
      </tr>		
			<?php $rowCount++; } ?>
    </tbody>
  </table>

	<div id="visualization" style="width: 97%; height: 400px;" class="well"></div>
</section>
</div>

<!-- Javascript Files -->
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable(<?php echo json_encode($jsData,JSON_NUMERIC_CHECK);?>);

        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('visualization')).
            draw(data, {curveType: "none",
												chartArea: {top:50, left:100},
                        width: "100%", height: 400,
												animation: {duration: 1000},
												hAxis: {slantedText: true, slantedTextAngle: 60},
                        vAxis: {maxValue: 10}}
                );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
<!-- // -->
	<?php } ?>
