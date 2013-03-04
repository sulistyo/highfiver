<div class="container">
	<section id="typography">
	<br>
	<div class="span8 well">
		<h3>Top 5 Players in Indiana Basketball</h3>
		<ul>
			<?php foreach($top as $row){ ?>
			<li>#<?php echo $row['rank'];?> - <a href='/vnn/user/detail/<?php echo $row['id'];?>'><?php echo $row['name'];?></a></li>
			<?php }?>
		</ul>
	</div>
</section>
</div>

