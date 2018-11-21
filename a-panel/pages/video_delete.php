<?php
	if(isset($_GET['id'])){
  	$id = $objConnection->real_escape_string($_GET['id']);

		if(!isset($_GET['confirm'])){
			$confirm = "Vil du slette videoen?";
		}
		else {
      // delete video
      $sql = "DELETE from drf_map_videos WHERE id = '$id'";
      $objConnection->query($sql);
			
			echo '<div class="modal"><p>Videoen blev slettet.</p></div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php?page=home" />';
		}
  }

?>
<div class="page content">
	<h1>
		Slet video
	</h1>
	<div class="delete">
    <div class="button">
      <a href="index.php?page=video_delete&id=<?php echo $id; ?>&confirm=true">Ja</a>
    </div>
    <div class="button">
      <a href="index.php?page=home">Nej</a>
    </div>
	</div>
</div>