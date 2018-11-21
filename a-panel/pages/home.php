<div class="wrapper content">
	<div class="space-between">
		<h1>
			Oversigt over dive spots
		</h1>
		<?php
			if(isset($_POST['searchSubmit'])){
				echo '<a href="?page=home">Vis alle destinationer</a>';
			}
		?>
		<form class="searchForm" method="post" action="">
			<input type="text" name="search" required placeholder="Søg">
			
			<label for="searchSubmit" class="fa fa-search"></label>
			<input id="searchSubmit" type="submit" value="" name="searchSubmit">
		</form>
	</div>
	
	<?php
	
		$st = $objConnection->real_escape_string($_POST['search']);
	
		if(isset($_POST['searchSubmit'])){
			$sql = "
				SELECT * FROM drf_map_junction
				WHERE ref_title LIKE '%{$st}%'
			";
		}else {
			$sql = "SELECT * FROM drf_map_junction";
		}
	
		$result = $objConnection->query($sql);

		while($row = $result->fetch_object()){
			echo '<div class="item">';
			echo '<p>' . $row->id . ' - ' . $row->ref_title . '</p>';
			echo '<p class="button"><a href="?page=ds_edit&id=' . $row->id . '">Rediger</a></p>';
			echo '<p class="button"><a href="?page=ntk&id=' . $row->id . '">Se / Tilføj \'nyttig viden\'</a></p>';
			echo '<p class="button"><a href="?page=images&id=' . $row->id . '">Se / Tilføj billeder</a></p>';
			echo '<p class="button"><a href="?page=videos&id=' . $row->id . '">Se / Tilføj video</a></p>';
			echo '</div>';
		}
	
	?>
	
</div>