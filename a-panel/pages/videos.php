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
			Videoer til dive spot '<?php echo $title; ?>'
		</h1>
		<div class="button">
			<a href="?page=video_add&id=<?php echo $id; ?>">Tilføj video</a>
		</div>
	</div>

	<?php
		$videoSql = "
			SELECT * from drf_map_videos
			WHERE junction_id = '$id'
		";
		$videoResult = $objConnection->query($videoSql);
		if($videoResult->num_rows != 0){
			while($videoRow = $videoResult->fetch_object()){
				echo '<div class="video-wrapper">';
				echo $videoRow->video;
				echo '</div>';
				echo '<div class="button"><a href="?page=video_delete&id=' . $videoRow->id . '">Slet video</a></div>';
			}
		}else {
			echo '<p class="warning">Der er endnu ikke tilføjet videoer til dette dive spot.</p>';
		}
	
	?>
  
</div>