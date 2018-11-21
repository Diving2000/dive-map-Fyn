<?php
	if(isset($_GET['id'])){
  	$id = $objConnection->real_escape_string($_GET['id']);
		
		$sql = "SELECT * FROM drf_map_images WHERE id = {$id}"; 
		$result = $objConnection->query($sql);
		while($row = $result->fetch_object()){
			$oldImage = $row->image;
		}

		if(!isset($_GET['confirm'])){
			$confirm = "Vil du slette billedet?";
		}
		else {
			$sql = "DELETE FROM drf_map_images WHERE id = {$id}";
			$objConnection->query($sql);
			
			unlink("../$oldImage");
			
      echo '<div class="modal"><p>Billedet blev slettet.</p></div>';
		  echo '<meta http-equiv="refresh" content="3;url=index.php?page=home" />';
		}
  }

?>
<div class="page content">
	<h1>
		Slet billede
	</h1>
	<div class="delete">
    <div class="button">
      <a href="index.php?page=image_delete&id=<?php echo $id; ?>&confirm=true">Ja</a>
    </div>
    <div class="button">
      <a href="index.php?page=home">Nej</a>
    </div>
	</div>
</div>