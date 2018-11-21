<?php
  $id = $objConnection->real_escape_string($_GET['id']);

	$sql = "
		SELECT * FROM drf_map_junction WHERE id = '$id'
	";
	$result = $objConnection->query($sql);

	while($row = $result->fetch_object()){
		$title = $row->ref_title;
	}
?>
<div class="page content">
	<div class="space-between">
		<h1>
			Billeder til dive spot '<?php echo $title; ?>'
		</h1>
		<div class="button">
			<a href="?page=image_add&id=<?php echo $id; ?>">Upload nyt billede</a>
		</div>
	</div>

	<?php
		$imgSql = "
			SELECT * from drf_map_images
			WHERE junction_id = '$id'
		";
		$imgResult = $objConnection->query($imgSql);
		if($imgResult->num_rows != 0){
			echo '<div class="img-gallery">';
			while($imgRow = $imgResult->fetch_object()){
				echo '<div>';
				echo '<div class="img-thumb">';
				echo '<img src="../' . $imgRow->image . '">';
				echo '</div>';
				echo '<div class="button"><a href="?page=image_delete&id=' . $imgRow->id . '">Slet billede</a></div>';
				echo '</div>';
			}
			echo '</div>';
		}else {
			echo '<p class="warning">Der er endnu ikke tilføjet billeder til dette dive spot.</p>';
		}
	
	?>
  
</div>