<?php
  $id = $objConnection->real_escape_string($_GET['id']);

  $sql = "
    SELECT * FROM drf_map_junction WHERE id = '$id'
  ";
  $result = $objConnection->query($sql);
  while($row = $result->fetch_object()){
    $title = $row->ref_title;
  }

  if(isset($_POST['submit'])){
    
    if(isset($_POST['video'])){
      
      $video = htmlentities($_POST['video']);
      
      $videoSql = "INSERT INTO drf_map_videos (id, video, junction_id) VALUES ('', '{$video}', $id)";
      $objConnection->query($videoSql);
      
      echo '<div class="modal"><p>Videoen blev tilføjet.</p></div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php?page=home" />';
      
    }else {
      $error = '<p class="error">Du skal udfylde feltet med en embed-kode for at kunne indsende.</p>';
    }
    
  }

?>
<div class="page content">
	<h1>
		Tilføj video til dive spot '<?php echo $title; ?>'
	</h1>
  <main>
    <?php echo $error; ?>
    <form action="" method="post">
      <div class="form-row">
        <label for="video">Embed-kode</label>
        <textarea id="video" name="video" required></textarea>
      </div>
      <div class="form-row">
        <input type="submit" name="submit" value="Tilføj">
      </div>
    </form>
    
  </main>
</div>